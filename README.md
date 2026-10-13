# STL Date Picker Widget

STL Date Picker Widget is a framework-agnostic PHP renderer for date-picker and
date-range controls. It works in raw PHP, Laravel Blade, Yii views, Symfony
Twig integrations, and other PHP applications without depending on a framework.

The browser behavior is provided by
[bootstrap-datepicker](https://github.com/uxsolutions/bootstrap-datepicker).
The PHP package safely renders the controls and their initialization scripts.

This project is an independently maintained continuation inspired by
[`2amigos/yii2-date-picker-widget`](https://github.com/2amigos/yii2-date-picker-widget).
It preserves the original Git history and BSD-3-Clause license. It is not
affiliated with or endorsed by the original maintainers.

## Requirements

- PHP 8.1 through 8.5
- jQuery in the browser
- Bootstrap CSS if you want the default Bootstrap appearance

There are no required PHP framework packages.

## Installation

```bash
composer require software-technologies-limited/stl-date-picker-widget
```

## Assets

Render the stylesheet once in your page `<head>` and the scripts after jQuery:

```php
<?php

use Stl\DatePicker\Assets;

$assets = new Assets();
?>

<?= $assets->styles() ?>
<?= $assets->scripts() ?>
```

The default assets are pinned to bootstrap-datepicker 1.10.1 on jsDelivr. Pass
a different base URL to `Assets` to use a self-hosted copy:

```php
$assets = new Assets('/assets/bootstrap-datepicker');
```

For a locale, load its script once:

```php
<?= $assets->scripts('sw') ?>
```

Your application remains responsible for loading jQuery and any Bootstrap CSS
it uses.

## Raw PHP

```php
<?php

use Stl\DatePicker\DatePicker;

$picker = new DatePicker(
    name: 'appointment_date',
    value: $_POST['appointment_date'] ?? null,
    options: [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
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
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
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
    options: ['format' => 'yyyy-mm-dd', 'autoclose' => true],
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
