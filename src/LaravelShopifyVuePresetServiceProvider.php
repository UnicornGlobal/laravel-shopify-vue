<?php

namespace UnicornGlobal\LaravelShopifyVuePreset;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;

class LaravelShopifyVuePresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        UiCommand::macro('laravel-shopify-vue', function ($command) {
            LaravelShopifyVuePreset::install();

            $command->info('Laravel Shopify Vue scaffolding installed successfully.');

            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }
}
