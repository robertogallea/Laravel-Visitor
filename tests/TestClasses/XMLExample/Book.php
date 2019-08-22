<?php


namespace Tests\TestClasses\XMLExample;


use robertogallea\LaravelVisitor\Models\Visitable;

class Book
{
    use Visitable;

    private $title;
    private $author;
    private $format;
    private $pages;

    /**
     * Book constructor.
     * @param $title
     * @param $author
     * @param $format
     * @param $pages
     */
    public function __construct($title, $author, $format, $pages)
    {
        $this->title = $title;
        $this->author = $author;
        $this->format = $format;
        $this->pages = $pages;
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
    public function getAuthor()
    {
        return $this->author;
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
    public function getPages()
    {
        return $this->pages;
    }


}