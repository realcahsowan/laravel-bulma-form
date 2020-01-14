@if($type == 'hidden')
    <input type="hidden" name="{{ $name }}" value="{{ Arr::get($options, 'value') }}">
@else
    @php
        $placeholder = Arr::has($options, 'placeholder') ? Arr::get($options, 'placeholder') : title_case(Str::replace('_', ' ', $name));
        $value = old($name, Arr::get($options, 'value'));
        $extra_class = $errors->has($name) ? ' is-danger' : '';
        $custom_class = Arr::get($options, 'custom_class');
        $input_id = Arr::get($options, 'id');

        $is_narrow = Arr::get($options, 'narrow') ? ' is-narrow' : '';
        $label = Arr::get($options, 'label', $name);
    @endphp

    @if($orientation == 'horizontal')
        <div id="{{ $input_id }}" class="field is-horizontal {{ $custom_class }}">
            <div class="field-label is-normal">
                @if(Arr::has($options, 'label_uppercase'))
                    <label class="label">{{ strtoupper(Str::replace('_', ' ', $label)) }}</label>
                @else
                    <label class="label">{{ title_case(Str::replace('_', ' ', $label)) }}</label>
                @endif
            </div>
            <div class="field-body">
                <div class="field{{ $is_narrow }}">
                    <div class="control">
                        <input id="{{ $input_id }}" class="input{{ $extra_class }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ extra_attribute($options) }}>
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
        <div id="{{ $input_id }}" class="field {{ $custom_class }}">
            @if(Arr::has($options, 'label_uppercase'))
                <label class="label">{{ strtoupper(Str::replace('_', ' ', $label)) }}</label>
            @else
                <label class="label">{{ title_case(Str::replace('_', ' ', $label)) }}</label>
            @endif
            <div class="control">
                <input class="input{{ $extra_class }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" {{ extra_attribute($options) }}>
            </div>
            @if($errors->has($name))
                <p class="help is-danger">
                   {{ $errors->first($name) }}
                </p>
            @endif
        </div>
    @endif
@endif