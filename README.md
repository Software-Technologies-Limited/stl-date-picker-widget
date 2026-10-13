# STL Date Picker Widget

STL Date Picker Widget is a framework-agnostic PHP renderer for date-picker and
date-range controls. It works in raw PHP, Laravel Blade, Yii views, Symfony
Twig integrations, and other PHP applications without depending on a framework.

The browser layer is implemented by STL with native date semantics, vanilla
JavaScript, and themeable CSS. It has no jQuery, Bootstrap, or CDN dependency.

This project is an independently maintained continuation inspired by
[`2amigos/yii2-date-picker-widget`](https://github.com/2amigos/yii2-date-picker-widget).
It preserves the original Git history and BSD-3-Clause license. It is not
affiliated with or endorsed by the original maintainers.

## Requirements

- PHP 8.1 through 8.5
- A modern browser with native date-input support

There are no required PHP framework packages.

## Installation

```bash
composer require software-technologies-limited/stl-date-picker-widget
```

## Assets

Publish `src/assets` to a public directory, then render the stylesheet once in
your page `<head>` and the script near the end of the document:

```php
<?php

use Stl\DatePicker\Assets;

$assets = new Assets();
?>

<?= $assets->styles() ?>
<?= $assets->scripts() ?>
```

The default public URL is `/vendor/stl-date-picker`. Pass a different base URL
when your application publishes the files elsewhere:

```php
$assets = new Assets('/assets/stl-date-picker');
```

Laravel users can publish both assets and configuration with
`php artisan vendor:publish --tag=stl-date-picker-assets` and
`php artisan vendor:publish --tag=stl-date-picker-config`.

## Raw PHP

```php
<?php

use Stl\DatePicker\DatePicker;

$picker = new DatePicker(
    name: 'appointment_date',
    value: $_POST['appointment_date'] ?? null,
    options: [
        'locale' => 'en',
        'theme' => 'light',
        'min' => '2026-01-01',
    ],
    attributes: ['class' => 'form-control'],
);
?>

<?= $picker->render() ?>
<?= $picker->script() ?>
```

All names, values, IDs, and attributes are HTML-escaped. Options are encoded as
JSON rather than interpolated into JavaScript.

## Date range

```php
<?php

use Stl\DatePicker\DateRangePicker;

$range = new DateRangePicker(
    fromName: 'date_from',
    toName: 'date_to',
    fromValue: '2026-10-13',
    toValue: '2026-10-20',
    options: [
        'locale' => 'en',
        'theme' => 'light',
    ],
    fromAttributes: ['class' => 'form-control'],
    toAttributes: ['class' => 'form-control'],
);
?>

<?= $range->render() ?>
<?= $range->script() ?>
```

## Laravel Blade

Create the picker in a controller, view model, component, or directly in the
template. Because the output is already escaped by the package, render it as
intentional HTML:

```blade
{!! $picker->render() !!}

@push('scripts')
    {!! $picker->script() !!}
@endpush
```

Render `Assets::styles()` and `Assets::scripts()` once from your layout or asset
pipeline.

## Yii

The framework-neutral renderer can be used directly in a Yii view:

```php
<?php

use Stl\DatePicker\DatePicker;

$picker = new DatePicker(
    name: \yii\helpers\Html::getInputName($model, 'date'),
    value: (string) $model->date,
    attributes: ['class' => 'form-control'],
    options: ['locale' => 'en', 'theme' => 'light'],
);
?>

<?= $picker->render() ?>
<?= $picker->script() ?>
```

Yii is not installed or required by this package.

## Other template engines

Use the same `render()` and `script()` results as trusted component output in
Twig or another template engine. The package does not access globals, sessions,
requests, containers, or framework lifecycle hooks.

## Development checks

```bash
composer validate --strict
composer audit
find src -name '*.php' -print0 | xargs -0 -n1 php -l
```

GitHub Actions validates the package, audits its dependencies, and checks PHP
syntax on PHP 8.1, 8.2, 8.3, 8.4, and 8.5.

## Credits

- [Antonio Ramirez](https://github.com/tonydspaniard) and
  [2amigOS! Consulting Group](https://github.com/2amigos) for the original Yii
  widget and project history
- Contributors to the original project
- Software Technologies Limited, current maintainer

## License

BSD-3-Clause. See [LICENSE.md](LICENSE.md). The original copyright and license
notice are retained as required by the license.
