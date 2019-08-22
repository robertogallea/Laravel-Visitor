<?php


namespace robertogallea\LaravelVisitor\Console;


use Illuminate\Console\GeneratorCommand;

class MakeVisitorCommand extends GeneratorCommand
{
    protected $name = 'make:visitor';

    protected $description = 'Create a new visitor';

    protected $type = 'Visitor';


    public function getStub()
    {
        return __DIR__.'/../../stubs/visitor.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Visitors';
    }

}