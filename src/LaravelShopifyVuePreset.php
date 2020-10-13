<?php

namespace UnicornGlobal\LaravelShopifyVuePreset;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\Preset;
use Symfony\Component\Finder\SplFileInfo;

class LaravelShopifyVuePreset extends Preset
{
    public static function install()
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapping();
        static::updateWelcomePage();
        static::removeNodeModules();
    }

    /**
     * Update the "package.json" file.
     *
     * @return void
     */
    protected static function updatePackages()
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages['dependencies'] = static::updatePackageArray(
            array_key_exists('dependencies', $packages) ? $packages['dependencies'] : [],
            'dependencies'
        );

        $packages['devDependencies'] = static::updatePackageArrayDev(
            array_key_exists('devDependencies', $packages) ? $packages['devDependencies'] : [],
            'devDependencies'
        );

        ksort($packages['dependencies']);
        ksort($packages['devDependencies']);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            '@shopify/app-bridge' => '^1.27.2',
            '@shopify/app-bridge-utils' => '^1.27.2',
            '@unicorns/polaris-vue' => 'github:UnicornGlobal/polaris-vue#master',
            'axios' => '^0.19.2',
            'vue' => '^2.6.12',
            'vue-axios' => '^2.1.5',
            'vue-router' => '^3.4.5',
            'vuex' => '^3.5.1'
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'lodash',
            'popper.js',
            'laravel-mix',
            'jquery',
        ]));
    }

    protected static function updatePackageArrayDev(array $packages)
    {
        return array_merge([
            'autoprefixer' => '^9.6',
            'laravel-mix' => '^5.0.1',
            'postcss-import' => '^12.0',
            'postcss-nested' => '^4.2',
            'resolve-url-loader' => '^2.3.1',
            'sass' => '^1.20.1',
            'sass-loader' => '^8.0.0',
            'vue-template-compiler' => '^2.6.12',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'lodash',
            'popper.js',
            'laravel-mix',
            'jquery',
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(public_path('js/app.js'));
            $filesystem->delete(public_path('sass/app.scss'));

            if (! $filesystem->isDirectory($directory = resource_path('sass'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/sass/app.scss', resource_path('sass/app.scss'));
    }

    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/laravel-shopify-vue-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        // Remove existing
        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(resource_path('js'));

            // Make the directories
            $filesystem->makeDirectory(resource_path('js'), 0755, true);
            $filesystem->makeDirectory(resource_path('js/actions'), 0755, true);
            $filesystem->makeDirectory(resource_path('js/api'), 0755, true);
            $filesystem->makeDirectory(resource_path('js/components'), 0755, true);
            $filesystem->makeDirectory(resource_path('js/pages'), 0755, true);
            $filesystem->makeDirectory(resource_path('js/router'), 0755, true);
            $filesystem->makeDirectory(resource_path('js/store'), 0755, true);
        });

        // Root level files
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/config.js', resource_path('js/config.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/Base.vue', resource_path('js/Base.vue'));

        // Actions
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/actions/error.js', resource_path('js/actions/error.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/actions/index.js', resource_path('js/actions/index.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/actions/loading.js', resource_path('js/actions/loading.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/actions/modal.js', resource_path('js/actions/modal.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/actions/titlebar.js', resource_path('js/actions/titlebar.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/actions/toast.js', resource_path('js/actions/toast.js'));

        // API
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/api/plans.js', resource_path('js/api/plans.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/api/user.js', resource_path('js/api/user.js'));

        // Components
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/components/ExampleComponent.vue', resource_path('js/components/ExampleComponent.vue'));

        // Pages
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/pages/Example.vue', resource_path('js/pages/Example.vue'));

        // Router
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/router/index.js', resource_path('js/router/index.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/router/routes.js', resource_path('js/router/routes.js'));

        // Store
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/store/app.js', resource_path('js/store/app.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/store/index.js', resource_path('js/store/index.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/store/shop.js', resource_path('js/store/shop.js'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/js/store/token.js', resource_path('js/store/token.js'));
    }

    protected static function updateWelcomePage()
    {
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));

        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/views/splash.blade.php', resource_path('views/splash.blade.php'));
        copy(__DIR__.'/laravel-shopify-vue-stubs/resources/views/pre-loader.blade.php', resource_path('views/pre-loader.blade.php'));
    }

    protected static function compileControllerStub()
    {
        str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/laravel-shopify-vue-stubs/controllers/HomeController.stub')
        );

        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/laravel-shopify-vue-stubs/controllers/ApiController.stub')
        );
    }
}
