<?php

declare(strict_types=1);

namespace Stl\DatePicker;

use Stl\DatePicker\Support\Html;

final class Assets
{
    public const VERSION = '1.10.1';

    public function __construct(
        private readonly string $baseUrl = 'https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.1/dist',
    ) {
    }

    public function styles(): string
    {
        return '<link rel="stylesheet" href="'
            . Html::escape($this->baseUrl . '/css/bootstrap-datepicker3.min.css')
            . '">';
    }

    public function scripts(?string $language = null): string
    {
        $tags = [
            '<script src="' . Html::escape($this->baseUrl . '/js/bootstrap-datepicker.min.js') . '"></script>',
        ];

        if ($language !== null && $language !== '' && $language !== 'en') {
            if (!preg_match('/^[A-Za-z][A-Za-z0-9-]*$/', $language)) {
                throw new \InvalidArgumentException('Language must be a valid locale identifier.');
            }

            $tags[] = '<script src="'
                . Html::escape($this->baseUrl . '/locales/bootstrap-datepicker.' . $language . '.min.js')
                . '"></script>';
        }

        return implode("\n", $tags);
    }
}
