<?php

declare(strict_types=1);

namespace Stl\DatePicker;

use Stl\DatePicker\Support\Html;

final class Assets
{
    public function __construct(
        private readonly string $baseUrl = '/vendor/stl-date-picker',
    ) {
    }

    public function styles(): string
    {
        return '<link rel="stylesheet" href="'
            . Html::escape(rtrim($this->baseUrl, '/') . '/stl-date-picker.css')
            . '">';
    }

    public function scripts(): string
    {
        return '<script src="' . Html::escape(rtrim($this->baseUrl, '/') . '/stl-date-picker.js')
            . '" defer></script>';
    }
}
