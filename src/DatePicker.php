<?php

declare(strict_types=1);

namespace Stl\DatePicker;

use Stl\DatePicker\Support\Html;

final class DatePicker implements \Stringable
{
    /**
     * @param array<string, mixed> $options STL date picker options
     * @param array<string, scalar|null> $attributes HTML input attributes
     */
    public function __construct(
        private readonly string $name,
        private readonly ?string $value = null,
        private readonly array $options = [],
        private readonly array $attributes = [],
        private readonly ?string $id = null,
    ) {
        if ($name === '') {
            throw new \InvalidArgumentException('The input name cannot be empty.');
        }
    }

    public function id(): string
    {
        return $this->id ?? self::idFromName($this->name);
    }

    public function render(): string
    {
        $attributes = array_merge($this->attributes, [
            'type' => 'date',
            'id' => $this->id(),
            'name' => $this->name,
            'value' => $this->value,
            'data-stl-date-picker' => true,
            'autocomplete' => $this->attributes['autocomplete'] ?? 'off',
            'class' => trim(($this->attributes['class'] ?? '') . ' stl-date-picker'),
        ]);

        return '<input' . Html::attributes($attributes) . '>';
    }

    public function script(): string
    {
        $id = Html::json(['id' => $this->id()]);
        $options = Html::json($this->options);

        return '<script>(function(init){if(document.readyState==="loading")'
            . '{document.addEventListener("DOMContentLoaded",init);}else{init();}})(function(){var c=' . $id
            . ';if(window.StlDatePicker){window.StlDatePicker.create(c.id,' . $options . ');}});</script>';
    }

    public function __toString(): string
    {
        return $this->render();
    }

    private static function idFromName(string $name): string
    {
        $id = strtolower(trim((string) preg_replace('/[^A-Za-z0-9_-]+/', '-', $name), '-'));

        return $id !== '' ? $id : 'stl-date-picker';
    }
}
