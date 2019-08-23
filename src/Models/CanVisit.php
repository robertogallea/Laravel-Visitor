<?php


namespace robertogallea\LaravelVisitor\Models;


trait CanVisit
{
    protected $visitees;

    public function __construct(array $visitees = [])
    {
        $this->visitees = collect($visitees);
    }

    public function addVisitee($visitee)
    {
        $this->visitees->add($visitee);
    }

    public function execute()
    {
        $this->visitees->each->accept($this);
    }

    public function getVisitees()
    {
        return $this->visitees;
    }
}