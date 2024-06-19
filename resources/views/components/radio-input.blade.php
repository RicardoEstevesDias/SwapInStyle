@php
    $name ??= "";
    $label ??= "";
    $radios ??= [];
    $edit ??= "";
@endphp

<fieldset class="mb-3">
    <legend class="block text-gray-700 text-sm font-bold mb-2">{{$label}}</legend>
        @foreach ($radios as $radio)
        @php
        $value = $radio["value"];
        $label = $radio["label"];
        @endphp
        <div class="form-control">
            <label class="label cursor-pointer">
                <span class="label-text">{{$label}}</span>
                <input
                class="radio @error($name) radio-error @enderror"
                type="radio"
                name="{{$name}}"
                id="{{$name}}"
                value="{{$value}}"
                required
                @if ($edit)
                    {{ $edit=="$value" ? 'checked='.'"'.'checked'.'"' : '' }}
                @else
                    {{ old($name)=="$value" ? 'checked='.'"'.'checked'.'"' : '' }}
                @endif
                >
            </label>
        </div>
        @endforeach
</fieldset>

@error($name)
    @include('components.error-alert', ['message' => $message])
@enderror
