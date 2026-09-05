@props(['field', 'label' => null, 'class' => ''])

<div class="form__control {{ $class }} {{ $errors->has($field) ? 'has-error' : '' }}">
    @if ($label)
        <label for="{{ $field }}">{{ $label }}</label>
    @endif

    {{ $slot }}

    @error($field)
        <small class="field-error">{{ $message }}</small>
    @enderror
</div>