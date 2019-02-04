<?php

namespace Orgo\TailwindPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class Tailwind extends Preset
{
    public static function install($command, $auth = false)
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateStyles();
        static::updateJavaScript();
        static::updateTemplates();
        static::removeNodeModules();
        static::updateConfigurations();

        if ($auth) {
            static::addAuthTemplates();
            static::addAuthRoutes();
        }
        if (\in_array('errors', $command->option('option'), true)) {
            static::addErrorTemplates();
        }
    }

    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix-purgecss' => '^2.2.0',
            'tailwindcss' => 'latest',
            'browser-sync' => '^2.26.0',
            'browser-sync-webpack-plugin' => '^2.2.2',
            'stylelint' => '^9.5.0',
            'stylelint-config-prettier' => '^4.0.0',
            'stylelint-config-sass-guidelines' => '^5.2.0',
            'stylelint-scss' => '^3.3.1',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'jquery',
            'popper.js',
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem(), function ($files) {
            $files->deleteDirectory(resource_path('sass'));
            $files->delete(public_path('js/app.js'));
            $files->delete(public_path('css/app.css'));
            $files->copyDirectory(__DIR__.'/stubs/sass', resource_path('sass'));
        });
    }

    protected static function updateJavaScript()
    {
        tap(new Filesystem(), function ($files) {
            $files->copyDirectory(__DIR__.'/stubs/js', resource_path('js'));
        });
    }

    protected static function updateTemplates()
    {
        tap(new Filesystem(), function ($files) {
            $files->delete(resource_path('views/home.blade.php'));
            $files->delete(resource_path('views/welcome.blade.php'));
        });
        copy(__DIR__.'/stubs/views/layouts/base.blade.php', resource_path('views/layouts/base.blade.php'));
        copy(__DIR__.'/stubs/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
    }

    protected static function updateConfigurations()
    {
        copy(__DIR__.'/stubs/gitignore.stub', base_path('.gitignore'));
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/stubs/editorconfig.stub', base_path('.editorconfig'));
    }

    protected static function addAuthTemplates()
    {
        tap(new Filesystem(), function ($files) {
            $files->copyDirectory(__DIR__.'/stubs/views/auth', resource_path('views/auth'));
            $files->copyDirectory(__DIR__.'/stubs/views/components', resource_path('views/components'));
            $files->copyDirectory(__DIR__.'/stubs/views/layouts', resource_path('views/layouts'));
        });
        copy(__DIR__.'/stubs/views/home.blade.php', resource_path('views/home.blade.php'));
        file_put_contents(app_path('Http/Controllers/HomeController.php'), static::compileControllerStub());
    }

    protected static function addAuthRoutes()
    {
        if (str_contains(file_get_contents(base_path('routes/web.php')), 'Auth::routes();')) {
            return;
        }

        file_put_contents(
            base_path('routes/web.php'),
            "\nAuth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n",
            FILE_APPEND
        );
    }

    protected static function addErrorTemplates()
    {
        tap(new Filesystem(), function ($files) {
            $files->copyDirectory(__DIR__.'/stubs/views/errors', resource_path('views/errors'));
        });
    }

    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/stubs/controllers/HomeController.stub')
        );
    }
}
