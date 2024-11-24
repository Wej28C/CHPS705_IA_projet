@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-200 border-k_black focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
