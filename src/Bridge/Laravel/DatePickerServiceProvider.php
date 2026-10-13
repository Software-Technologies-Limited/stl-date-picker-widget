<?php

declare(strict_types=1);

namespace Stl\DatePicker\Bridge\Laravel;

use Illuminate\Support\ServiceProvider;

final class DatePickerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../../config/stl-date-picker.php', 'stl-date-picker');
    }

    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../../../config/stl-date-picker.php' => config_path('stl-date-picker.php')], 'stl-date-picker-config');
        $this->publishes([__DIR__ . '/../../assets' => public_path('vendor/stl-date-picker')], 'stl-date-picker-assets');
    }
}
