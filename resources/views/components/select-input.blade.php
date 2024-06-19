@php
    $name ??= '';
    $label ??= '';
    $options ??= [];
    $edit ??= '';
@endphp

<label class="form-control w-full max-w-xs" for="{{ $name }}">
    <div class="label">
        <span class="label-text block text-gray-700 text-sm font-bold">{{ $label }}</span>
    </div>
    <select id="{{ $name }}" name="{{ $name }}" class="select select-bordered">
        <option disabled selected>--Selectionnez une option--</option>

        @foreach ($options as $option)

            @php
                $value = $option['value'];
                $label = $option['label'];
            @endphp

            @if ($edit)
                <option value="{{ $option->id }}" {{ $edit == "$option->id" ? 'selected=' . '"' . 'selected' . '"' : '' }}>
                    {{ $option->name }}</option>
            @else
                <option value="{{ $option->id }}" {{ old($name) == "$option->id" ? 'selected=' . '"' . 'selected' . '"' : '' }}>
                    {{ $option->name }}</option>
            @endif

        @endforeach
    </select>
</label>

@error($name)
    @include('components.error-alert', ['message' => $message])
@enderror
