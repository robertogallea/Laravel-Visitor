<?php


namespace Tests\TestClasses\XMLExample;


use robertogallea\LaravelVisitor\Models\Visitable;

class Magazine
{
    use Visitable;

    private $title;
    private $month;
    private $year;

    /**
     * Magazine constructor.
     * @param $title
     * @param $month
     * @param $year
     */
    public function __construct($title, $month, $year)
    {
        $this->title = $title;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }


}