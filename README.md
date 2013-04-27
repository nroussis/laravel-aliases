# Laravel Aliases

Adds an `artisan aliases` command to [Laravel 4][1] that lists registered
aliases and the classes they map to, including resolving facades.

This saves you having to [look them up][2], and also works with custom aliases
and [facades][3].

## Installation

### 1. Install with Composer
```bash
composer require davejamesmiller/laravel-aliases dev-master
```

This will update `composer.json` and install it into the `vendor/` directory.

**Note:** `dev-master` is the latest development version.
See the [Packagist website][4] for a list of other versions.

### 2. Add to `app/config/app.php`
```php
    'providers' => array(
        // ...
        'DaveJamesMiller\Aliases\AliasesServiceProvider',
    ),
```

This registers the Artisan task with Laravel.

## Usage
### Show all aliases
```bash
$ php artisan aliases
```

e.g.

```
App
-> Illuminate\Support\Facades\App
-> Illuminate\Foundation\Application
-> Illuminate\Container\Container

Artisan
-> Illuminate\Support\Facades\Artisan
-> Illuminate\Console\Application
-> Symfony\Component\Console\Application

...
```

### Show alisases starting with "re"
```bash
$ php artisan aliases re
```

e.g.

```
Redirect
-> Illuminate\Support\Facades\Redirect
-> Illuminate\Routing\Redirector

Redis
-> Illuminate\Support\Facades\Redis
-> Illuminate\Redis\Database

Request
-> CustomRequest
-> Illuminate\Support\Facades\Request
-> Illuminate\Http\Request
-> Symfony\Component\HttpFoundation\Request

Response
-> Illuminate\Support\Facades\Response
```

### Verbose option shows how classes are resolved
```bash
$ php artisan aliases -v re
```

e.g.

```
Redirect
alias  > Illuminate\Support\Facades\Redirect
facade > Illuminate\Routing\Redirector

Redis
alias  > Illuminate\Support\Facades\Redis
facade > Illuminate\Redis\Database

Request
alias  > CustomRequest
parent > Illuminate\Support\Facades\Request
facade > Illuminate\Http\Request
parent > Symfony\Component\HttpFoundation\Request

Response
alias  > Illuminate\Support\Facades\Response
```

## License
MIT License. See [LICENSE.txt][5].

[1]: http://four.laravel.com/
[2]: http://forums.laravel.io/viewtopic.php?id=4998
[3]: http://fideloper.com/create-facade-laravel-4
[4]: https://packagist.org/packages/davejamesmiller/laravel-aliases
[5]: LICENSE.txt
