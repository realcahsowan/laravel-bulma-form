@php
/* OLD FUNCTIONS HERE ARE MOVED TO HELPERS */

$submit_or_button = Arr::first($fields, function ($field) {
    return in_array(Arr::get($field, 'type'), ['submit', 'button']);
});

$formId = $id ?? Str::random();
@endphp

@if($errors->any())
    <div class="notification is-danger">
        <i class="fas fa-info-circle fa-lg"></i>
        <span>Silahkan isi formulir dengan benar.</span>
    </div>
@endif

<form id="{{ $formId }}" action="{{ $url }}" method="{{ strtolower($method) == 'get' ? 'GET' : 'POST' }}" {{ count(hasInputFile($fields)) ? 'enctype=multipart/form-data' : '' }}>
    @csrf()

    @if(strtolower($method) !== 'get')
        @method($method)
    @endif

    @foreach($fields as $field)
        @php
            $view = '';
            $type = Arr::get($field, 'type');

            if (in_array($type, ['text', 'email', 'password', 'number', 'hidden', 'file', 'date', 'time'])) {
                $view = 'form_builder::input';
            }

            if (in_array($type, ['submit', 'button'])) {
                $view = 'form_builder::button';
            }

            if (in_array($type, ['select', 'textarea', 'radio', 'checkbox'])) {
                $view = 'form_builder::' . $type;
            }
        @endphp

        @if(in_array($type, ['submit', 'button']))
            @php
                break;
            @endphp
        @endif

        @if(strlen($view) > 0)
            @include($view, [
                'orientation' => $orientation,
                'type' => $type,
                'name' => Arr::get($field, 'name'),
                'options' => Arr::get($field, 'options'),
            ])
        @endif
    @endforeach

    @if(isset($injected) && ! is_null($injected))
        {!! $injected !!}
    @endif

    @if(! is_null($submit_or_button))
        @include('form_builder::button', [
            'orientation' => $orientation,
            'type' => Arr::get($submit_or_button, 'type'),
            'name' => Arr::get($submit_or_button, 'name'),
            'options' => Arr::get($submit_or_button, 'options'),
        ])
    @endif
</form>

@section('extra_script')
    @parent
    <script>
        var formId = '#{{ $formId }}';
        var form = document.querySelector(formId);
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var lfb__all_inputs = document.querySelectorAll(formId + ' input');
            lfb__all_inputs.forEach(function (input) {
                input.disabled = false;
            });

            var lfb__all_textareas = document.querySelectorAll(formId + ' textarea');
            lfb__all_textareas.forEach(function (textarea) {
                textarea.disabled = false;
            });

            var lfb__all_selects = document.querySelectorAll(formId + ' select');
            lfb__all_selects.forEach(function (select) {
                select.disabled = false;
            });

            form.submit();
        });
    </script>
@endsection