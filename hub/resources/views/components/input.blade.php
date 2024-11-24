@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge([
        'class' => 'bg-gray-700 border-gray-600 text-gray-200 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm',
    ]) !!}
>
