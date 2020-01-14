# laravel-bulma-form
Laravel form builder using Bulma css


## Installation

```sh
composer require realcahsowan/laravel-bulma-form
```

## Usage

### Form Class File

```sh
php artisan make:form BookForm
```

above command will generate `BookForm` class file in `app/Http/Forms` directory

### Inside Controller
```php
// Don't forget to import
use App\Http\Forms\BookForm;


public function create(BookForm $form)
{
	return view('books.create')->with('form', $form->generate('POST', route('books.store')));
}
```

### Insde View
To render the form simply do `{{ $form }}`

### NOTE: Handle disabled inputs
Add below lines insde the body tag of your layout blade file:
```html
<!-- resources/views/layouts/master.blade.php -->

@yield('extra_script')
```
