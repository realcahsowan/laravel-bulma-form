@php
    $placeholder = Arr::has($options, 'placeholder') ? Arr::get($options, 'placeholder') : title_case(str_replace('_', ' ', $name));
    $value = old($name, Arr::get($options, 'value'));
    $extra_class = $errors->has($name) ? ' is-danger' : '';

    $is_narrow = Arr::get($options, 'narrow') ? ' is-narrow' : '';
@endphp

@if($orientation == 'horizontal')
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label">{{ title_case(str_replace('_', ' ', $name)) }}</label>
        </div>
        <div class="field-body">
            <div class="field{{ $is_narrow }}">
                <div class="control">
                    <textarea class="textarea{{ $extra_class }}" name="{{ $name }}" id="{{ $name }}" cols="30" rows="{{ Arr::get($options, 'rows') }}" placeholder="{{ $placeholder }}" {{ Arr::has($options, 'disabled') ? 'disabled' : '' }}>{{ $value }}</textarea>
                </div>
                @if($errors->has($name))
                    <p class="help is-danger">
                       {{ $errors->first($name) }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="field">
        <label class="label">{{ title_case(str_replace('_', ' ', $name)) }}</label>
        <div class="control">
            <textarea class="textarea{{ $extra_class }}" name="{{ $name }}" id="{{ $name }}" cols="30" rows="{{ Arr::get($options, 'rows') }}" placeholder="{{ $placeholder }}" {{ Arr::has($options, 'disabled') ? 'disabled' : '' }}>{{ $value }}</textarea>
        </div>
        @if($errors->has($name))
            <p class="help is-danger">
               {{ $errors->first($name) }}
            </p>
        @endif
    </div>
@endif
