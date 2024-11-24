@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-500 italic']) }}>
        {{ $message }}
    </p>
@enderror
