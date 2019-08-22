<?php


namespace Tests\TestClasses\XMLExample;


use robertogallea\LaravelVisitor\Models\Visitable;

class DVD
{
    use Visitable;

    private $title;
    private $format;
    private $hour;
    private $minutes;

    /**
     * Book constructor.
     * @param $title
     * @param $format
     * @param $hour
     * @param $minutes
     */
    public function __construct($title, $format, $hour, $minutes)
    {
        $this->title = $title;
        $this->format = $format;
        $this->hour = $hour;
        $this->minutes = $minutes;
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
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @return mixed
     */
    public function getMinutes()
    {
        return $this->minutes;
    }


}