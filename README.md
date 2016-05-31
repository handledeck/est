# handledeck/est-tools



This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require handledeck/est-tools
```

## Usage

``` php
Add line to file config/app
  // Facade
 'Est'=>Handledeck\EstTools\EstFacade::class,
 //Service provider
  Handledeck\EstTools\EstToolsServiceProvider::class
```
## Console Artisan

    Update artisan command in settings->commands
    Ctrl+x digit est:install

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

