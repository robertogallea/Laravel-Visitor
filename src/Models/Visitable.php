<?php

namespace robertogallea\LaravelVisitor\Models;

use robertogallea\LaravelVisitor\Exceptions\VisitorMethodNotDefinedException;

trait Visitable
{
    public function accept(Visitor $visitor)
    {
        $methodName = 'visit' . (new \ReflectionClass($this))->getShortName();

        if (!method_exists($visitor, $methodName)) {
            throw new VisitorMethodNotDefinedException('Method ' . $methodName . ' is undefined');
        }

        $visitor->{$methodName}($this);
    }
}