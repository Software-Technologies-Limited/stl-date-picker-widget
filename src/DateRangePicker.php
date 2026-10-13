<?php

declare(strict_types=1);

namespace Stl\DatePicker;

use Stl\DatePicker\Support\Html;

final class DateRangePicker implements \Stringable
{
    /**
     * @param array<string, mixed> $options bootstrap-datepicker options
     * @param array<string, scalar|null> $fromAttributes
     * @param array<string, scalar|null> $toAttributes
     */
    public function __construct(
        private readonly string $fromName,
        private readonly string $toName,
        private readonly ?string $fromValue = null,
        private readonly ?string $toValue = null,
        private readonly array $options = [],
        private readonly array $fromAttributes = [],
        private readonly array $toAttributes = [],
        private readonly string $separator = 'to',
        private readonly ?string $id = null,
    ) {
        if ($fromName === '' || $toName === '') {
            throw new \InvalidArgumentException('Both date range input names are required.');
        }
    }

    public function id(): string
    {
        if ($this->id !== null) {
            return $this->id;
        }

        $base = strtolower(trim((string) preg_replace('/[^A-Za-z0-9_-]+/', '-', $this->fromName), '-'));

        return ($base !== '' ? $base : 'stl-date') . '-range';
    }

    public function render(): string
    {
        $from = new DatePicker($this->fromName, $this->fromValue, [], $this->fromAttributes);
        $to = new DatePicker($this->toName, $this->toValue, [], $this->toAttributes);

        return '<div' . Html::attributes([
            'id' => $this->id(),
            'class' => 'input-daterange input-group',
            'data-stl-date-range' => true,
        ]) . '>'
            . $from->render()
            . '<span class="input-group-addon">' . Html::escape($this->separator) . '</span>'
            . $to->render()
            . '</div>';
    }

    public function script(): string
    {
        $id = Html::json(['id' => $this->id()]);
        $options = Html::json($this->options);

        return '<script>(function(init){if(document.readyState==="loading")'
            . '{document.addEventListener("DOMContentLoaded",init);}else{init();}})(function(){var c=' . $id
            . ';var e=document.getElementById(c.id);if(e&&window.jQuery&&jQuery.fn.datepicker)'
            . '{jQuery(e).datepicker(' . $options . ');}});</script>';
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
