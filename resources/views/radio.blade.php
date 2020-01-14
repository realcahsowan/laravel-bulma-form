@php
    $choices = Arr::get($options, 'choices', []);
    $checked = old($name, Arr::get($options, 'checked'));
@endphp

@if($orientation == 'horizontal')
    <div class="field is-horizontal">
        <div class="field-label">
            <label class="label">{{ title_case(str_replace('_', ' ', $name)) }}</label>
        </div>
        <div class="field-body">
            <div class="field is-narrow">
                <div class="control">
                    @foreach($choices as $value => $label)
                        <label class="radio">
                            <input type="radio" name="{{ $name }}" value="{{ $value }}" {{ checked_radio_status($value, $checked) }}>
                            {{ $label }}
                        </label>
                    @endforeach
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
            <div class="field">
                <div class="control">
                    @foreach($choices as $value => $label)
                        <label class="radio">
                            <input type="radio" name="{{ $name }}" value="{{ $value }}" {{ checked_radio_status($value, $checked) }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        @if($errors->has($name))
            <p class="help is-danger">
               {{ $errors->first($name) }}
            </p>
        @endif
    </div>
@endif