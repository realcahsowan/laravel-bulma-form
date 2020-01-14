@php
    $extra_class = $errors->has($name) ? ' is-danger' : '';
    $choices = Arr::get($options, 'choices');
    $selected = old($name, Arr::get($options, 'selected'));

    $is_multiple = Arr::get($options, 'multiple', false) ? 'multiple' : '';
    $is_disabled = Arr::get($options, 'disabled', false) ? 'disabled' : '';

    $first_option = Arr::get($options, 'empty_value', ' -- Pilih ' . title_case($name) . ' -- ');

    $normalized_name = str_replace('[]', '', $name);

    if (Arr::get($options, 'multiple')) {
        $extra_class .= ' is-multiple';
        $extra_class .= $errors->has($name . '.0') ? ' is-danger' : '';
        $name .= '[]';
    }
@endphp

@if($orientation == 'horizontal')
    <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label">{{ title_case(str_replace('_', ' ', $normalized_name)) }}</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <div class="select{{ $extra_class }}">
                        <select name="{{ $name }}" id="{{ $name }}" {{ $is_multiple . ' ' . $is_disabled }}>
                            <option value="none">{{ $first_option }}</option>
                            @foreach($choices as $value => $label)
                                @if(isAssoc($choices))
                                    <option value="{{ $value }}" {{ selected_status($value, $selected) }}>
                                        {{ $label }}
                                    </option>
                                @else
                                    <option value="{{ $label }}" {{ selected_status($label, $selected) }}>
                                        {{ title_case(str_replace('_', ' ', $label)) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
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
        <label class="label">{{ title_case(str_replace('_', ' ', $normalized_name)) }}</label>
        <div class="control">
            <div class="select{{ $extra_class }}">
                <select name="{{ $name }}" id="{{ $name }}" {{ $is_multiple . ' ' . $is_disabled }}>
                    <option value="none">{{ $first_option }}</option>
                    @foreach($choices as $value => $label)
                        @if(isAssoc($choices))
                            <option value="{{ $value }}" {{ selected_status($value, $selected) }}>
                                {{ $label }}
                            </option>
                        @else
                            <option value="{{ $label }}" {{ selected_status($label, $selected) }}>
                                {{ title_case(str_replace('_', ' ', $label)) }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        @if($errors->has($name))
            <p class="help is-danger">
               {{ $errors->first($name) }}
            </p>
        @endif
    </div>
@endif