<?php

namespace robertogallea\LaravelVisitor\Models;

abstract class Visitor
{
    use CanVisit;

    abstract public function getResult();
}