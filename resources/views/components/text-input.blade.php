@php
    $type ??= 'text';
    $label ??= '';
    $name ??= '';
    $placeholder ??= '';
    $value ??= '';

    //For "number" inputs
    $min ??= "";
    $max ??= "";
    $step ??= "";
@endphp

@if ($label)
<label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $name }}">
    {{ $label }}
</label>
@endif


@if($type === "textarea")
    <textarea
        class="textarea textarea-bordered w-full max-w-xs mb-2 @error($name) textarea-error @enderror"
        name="{{$name}}"
        id="{{$name}}"
        placeholder="{{ $placeholder }}"
    >{{$value}}</textarea>
@else
    <input
        class="input input-bordered w-full max-w-xs mb-2 @error($name) input-error @enderror"
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{$min ?  "min=".$min : ""}}
        {{$max ?  "max=".$max : ""}}
        {{$step ?  "step=".$step : ""}}
        />
@endif

@error($name)
    @include('components.error-alert', ['message' => $message])
@enderror
