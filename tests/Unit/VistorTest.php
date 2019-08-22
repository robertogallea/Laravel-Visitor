<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use robertogallea\LaravelVisitor\Exceptions\VisitorMethodNotDefinedException;
use Tests\TestClasses\TestVisitee;
use Tests\TestClasses\TestVisitor;
use Tests\TestClasses\TestVisitorWithoutMethods;

class VistorTest extends TestCase
{
    /** @test */
    public function it_has_visitees()
    {
        $visitee = new TestVisitee();

        $visitor = new TestVisitor([$visitee]);

        $this->assertCount(1, $visitor->getVisitees());
    }

    /** @test */
    public function it_can_add_visitees()
    {
        $visitee = new TestVisitee();

        $visitor = new TestVisitor();

        $visitor->addVisitee($visitee);

        $this->assertCount(1, $visitor->getVisitees());
    }

    /** @test */
    public function it_can_be_accepted_by_visitees()
    {
        $visiteeMock = \Mockery::spy('Tests\TestClasses\TestVisitee[accept]');

        $visitor = new TestVisitor([$visiteeMock]);

        $visitor->execute();

        $visiteeMock->shouldHaveReceived()
            ->accept($visitor)
            ->once();

        // Required not to make the test without assertions
        $this->assertEquals(1,1);
    }

    /** @test */
    public function it_performs_double_dispatch()
    {
        $visitorMock = \Mockery::spy('Tests\TestClasses\TestVisitor[visitTestVisitee]');
        $visitorMock->addVisitee($visitee = new TestVisitee());

        $visitorMock->execute();

        $visitorMock->shouldHaveReceived()
            ->visitTestVisitee($visitee)
            ->once();

        // Required not to make the test without assertions
        $this->assertEquals(1,1);
    }

    /** @test */
    public function it_performs_true_visits()
    {
        $visitee = new TestVisitee();
        $visitor = new TestVisitor([$visitee]);

        $this->assertFalse($visitor->getResult());

        $visitor->execute();

        $this->assertTrue($visitor->getResult());
    }

    /** @test */
    public function visitee_launches_exception_if_method_does_not_exist_in_visitor()
    {
        $visitee = new TestVisitee();
        $visitor = new TestVisitorWithoutMethods([$visitee]);

        $this->expectException(VisitorMethodNotDefinedException::class);

        $visitor->execute();
    }
}