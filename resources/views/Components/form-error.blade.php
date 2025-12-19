@props(['name'])

@error($name)
    <p class='text-xs text-red-500 font-semiboldmt-1'> {{ $message }}</p>
@enderror
