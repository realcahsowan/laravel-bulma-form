@if($orientation == 'horizontal')
    <div class="field is-horizontal">
        <div class="field-label">
            <!-- Left empty for spacing -->
            <label for="" class="label"></label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <button type="{{ $type }}" class="button {{ Arr::get($options, 'class') }}">
                        {{ title_case($name) }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="field">
        <div class="control">
            <button type="{{ $type }}" class="button {{ Arr::get($options, 'class') }}">
                {{ title_case($name) }}
            </button>
        </div>
    </div>
@endif