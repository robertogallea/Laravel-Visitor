<?php

namespace robertogallea\LaravelVisitor;

use Illuminate\Support\ServiceProvider;
use robertogallea\LaravelVisitor\Console\MakeVisitorCommand;

class VisitorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->bindCommands();
    }

    private function bindCommands()
    {
        $this->app->bind('command.make:visitor', MakeVisitorCommand::class);
        $this->commands([
            'command.make:visitor',
        ]);
    }
}