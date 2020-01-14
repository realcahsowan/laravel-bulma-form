@php
    $choices = Arr::get($options, 'choices', []);
    $input_name = count($choices) > 1 ? $name . '[]' : $name;

    $selected = old($name, Arr::get($options, 'selected'));

    // when user does not choose any of choices
    if ($errors->has($name)) {
        $selected = null;
    }
@endphp

@if($orientation == 'horizontal')
    <div class="field is-horizontal">
        <div class="field-label">
            @if(! Arr::has($options, 'no_label'))
                <label class="label">{{ title_case(Str::replace('_', ' ', $name)) }}</label>
            @endif
        </div>
        <div class="field-body">
            <div class="field is-narrow">
                @foreach($choices as $value => $label)
                    <div class="control">
                        <label class="checkbox">
                            @if(Arr::has($options, 'no_value'))
                                <input type="checkbox" name="{{ $input_name }}">
                            @else
                                <input type="checkbox" name="{{ $input_name }}" value="{{ $value }}" {{ checked_status($value, $selected) }}>
                            @endif
                            {{ $label }}
                        </label>
                    </div>
                @endforeach

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
        @if(! Arr::has($options, 'no_label'))
            <label class="label">{{ title_case(Str::replace('_', ' ', $name)) }}</label>
        @endif
        <div class="control">
            <div class="field">
                @foreach($choices as $value => $label)
                    <div class="control">
                        <label class="checkbox">
                            @if(Arr::has($options, 'no_value'))
                                <input type="checkbox" name="{{ $input_name }}">
                            @else
                                <input type="checkbox" name="{{ $input_name }}" value="{{ $value }}" {{ checked_status($value, $selected) }}>
                            @endif
                            {{ $label }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @if($errors->has($name))
            <p class="help is-danger">
               {{ $errors->first($name) }}
            </p>
        @endif
    </div>
@endif