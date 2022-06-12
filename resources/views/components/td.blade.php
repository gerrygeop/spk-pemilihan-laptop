@props(['text' => 'text-slate-700'])
<td {!! $attributes->merge(['class' => 'px-6 py-2 text-sm '. $text .' whitespace-nowrap capitalize']) !!}>
    {{ $slot }}
</td>