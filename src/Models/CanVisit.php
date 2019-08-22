<?php


namespace robertogallea\LaravelVisitor\Models;


trait CanVisit
{
    protected $visitees;

    public function __construct(array $visitees = [])
    {
        $this->visitees = $visitees;
    }

    public function addVisitee($visitee)
    {
        $this->visitees[] = $visitee;
    }

    public function execute()
    {
        foreach ($this->visitees as $visitee) {
            $visitee->accept($this);
        }
    }

    public function getVisitees()
    {
        return $this->visitees;
    }
}