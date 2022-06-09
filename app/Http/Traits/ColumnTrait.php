<?php

namespace App\Http\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait ColumnTrait {

    public function checkIfNameExists($columnName)
    {
        $columnName = Str::of($columnName)->slug('_');
        if ( $this->columnExists($columnName) ) { 
            return back()->with('name_exists', 'Nama kriteria sudah ada'); 
        }
    }

    public function columnExists($columnName)
    {
        if ( Schema::hasColumn('alternatifs', $columnName) ) {
            return true;
        }
        return false;
    }

    public function addAlternatifColumn($columnName, $typeInputan = null)
    {
        $columnName = Str::of($columnName)->slug('_');
        Schema::table('alternatifs', function (Blueprint $table) use ($columnName, $typeInputan) {
            switch ($typeInputan) {
                case 'string':
                    $table->string($columnName)->nullable();
                    break;
                case 'integer':
                    $table->integer($columnName)->nullable();
                    break;
                case 'float':
                    $table->float($columnName, 0)->nullable();
                    break;
                default:
                    $table->string($columnName)->nullable();
            }
        });
    }

    public function addAlternatifMaxBobotColumn($columnName)
    {
        $columnName = Str::of($columnName)->slug('_');
        Schema::table('alternatif_max_bobot', function (Blueprint $table) use ($columnName) {
            $table->float($columnName, 0)->nullable();
        });
    }

    public function updateAlternatifMaxBobotColumnName($newName, $oldName)
    {
        $newName = $this->toSlug($newName);
        $oldName = $this->toSlug($oldName);
        Schema::table('alternatif_max_bobot', function (Blueprint $table) use ($newName, $oldName) {
            $table->renameColumn($oldName, $newName);
        });
    }

    public function updateAlternatifColumnName($newName, $oldName)
    {
        $newName = $this->toSlug($newName);
        $oldName = $this->toSlug($oldName);
        Schema::table('alternatifs', function (Blueprint $table) use ($newName, $oldName) {
            $table->renameColumn($oldName, $newName);
        });
    }

    public function updateAlternatifColumnType($columnName, $typeInputan) 
    {
        $columnName = Str::of($columnName)->slug('_');
        Schema::table('alternatifs', function (Blueprint $table) use ($columnName, $typeInputan) {
            switch ($typeInputan) {
                case 'string':
                    $table->string($columnName)->nullable()->change();
                    break;
                case 'integer':
                    $table->integer($columnName)->nullable()->change();
                    break;
                case 'float':
                    $table->float($columnName, 0)->nullable()->change();
                    break;
                default:
                    $table->string($columnName)->nullable()->change();
            }
        });
    }

    public function dropAlternatifColumn($columnName)
    {
        Schema::table('alternatifs', function (Blueprint $table) use ($columnName) {
            $table->dropColumn($columnName);
        });
        Schema::table('alternatif_max_bobot', function (Blueprint $table) use ($columnName) {
            $table->dropColumn($columnName);
        });
    }

    public function toSlug($text)
    {
        $text = trim($text);
        $text = strtolower($text);
        $text = str_replace(" ","_", $text);
        return $text;
    }

}