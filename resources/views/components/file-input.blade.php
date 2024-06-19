@php
    $name ??= '';
    $label ??= '';
    $value ??= '';
@endphp


<label for="{{ $name }} class="form-control w-full max-w-xs">
    <div class="label">
        <span class="label-text block text-gray-700 text-sm font-bold">{{ $label }}</span>
    </div>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="file"
        class="file-input file-input-bordered w-full max-w-sm"
        value="{{$value}}"/>
</label>

@error($name)
    @include('components.error-alert', ['message' => $message])
@enderror
