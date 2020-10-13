# Vue Frontend Preset for Laravel Shopify

A Vue front-end scaffolding preset for [Laravel Shopify](https://github.com/osiset/laravel-shopify).

## Usage

1. Fresh install Laravel Shopify >= 14.0 on Laravel >= 8.0 and `cd` to your app.
2. Install this preset via `composer require UnicornGlobal/laravel-shopify-vue --dev`. Laravel will automatically discover this package. No need to register the service provider.

### Install the Preset

1. Use `php artisan ui laravel-shopify-vue` for the preset
2. `npm install && npm run dev`
3. `php artisan serve` (or equivalent) to run server and test preset.

### Setup

Add a `MIX_SHOPIFY_APP_STORE_PAGE` env variable pointing to your app
store listing. This is where users who load the app directly into their
URL bar get sent to install the application.

Update `resources/js/config.js` with the name of your application.

### Usage

You can make API endpoints in the new ApiController.

See the files in the `resources/js` folder for more info.

### Actions

There is basic support for some actions. They will be available on
`this.$actions` or `Vue.prototype.$actions`.

Not all actions are included. Other examples exist in `pages/Example.vue`.

### Polaris Components

This installs a custom fork of `@eastsideco/polaris-vue`

## Warning

This is only a proof of concept and should not be used in production.
