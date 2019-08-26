<?php


namespace Tests\Unit;


use PHPUnit\Framework\TestCase;
use Tests\TestClasses\XMLExample\Book;
use Tests\TestClasses\XMLExample\DVD;
use Tests\TestClasses\XMLExample\Magazine;
use Tests\TestClasses\XMLExample\XMLVisitor;


class XMLExampleTest extends TestCase
{
    /** @test */
    public function it_generates_correct_results()
    {
        $xmlCatalog = new XMLVisitor([
            new Book('The Lord of the Rings', 'J.R.R. Tolkien', 'hardcover', 521),
            new DVD('Empire strikes back', 'blue-ray', 2, 15),
            new Magazine('The art of woodworking', 'August', 2019)
        ]);

        $xmlCatalog->execute();

        $this->assertEquals(
            '<book title="The Lord of the Rings" author="J.R.R. Tolkien" format="hardcover" pages="521"></book>' . PHP_EOL .
                '<dvd title="Empire strikes back" format="blue-ray" duration="2:15"></dvd>' . PHP_EOL .
                '<magazine title="The art of woodworking" issue="August 2019"></magazine>' . PHP_EOL,
            $xmlCatalog->getResult()
        );
    }
}