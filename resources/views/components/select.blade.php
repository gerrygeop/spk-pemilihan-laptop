<select {!! $attributes->merge(['class' => 'bg-slate-50 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    {{ $slot }}
</select>
