<?php


namespace Tests\TestClasses;


use robertogallea\LaravelVisitor\Models\Visitor;

class TestVisitor extends Visitor
{
    private $called = false;

    public function visitTestVisitee(TestVisitee $testVisitee)
    {
        $this->called = true;
    }

    public function wasCalled()
    {
        return $this->called;
    }

    public function getResult()
    {
        return $this->wasCalled();
    }
}