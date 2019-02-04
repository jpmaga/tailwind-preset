<?php

namespace Orgo\TailwindPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class TailwindServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        PresetCommand::macro('tailwind', function ($command) {
            if ($command->confirm('This action will overwrite your existing views and assets, are you sure you want to proceed?', true)) {
                Tailwind::install($command);
                $this->installMessage($command);
            }
        });

        PresetCommand::macro('tailwind:auth', function ($command) {
            if ($command->confirm('This action will overwrite your existing views and assets, are you sure you want to proceed?', true)) {
                Tailwind::install($command, true);
                $this->installMessage($command);
            }
        });
    }

    /**
     * Print message after successful installation.
     *
     * @param \Illuminate\Console\Command $command
     */
    protected function installMessage($command)
    {
        $command->info('Tailwind scaffolding installed successfully.');
        $command->comment('Please run "yarn && yarn tailwind init && yarn dev" or "npm install && npm run tailwind init && npm run dev" to compile your fresh scaffolding.');
    }
}
