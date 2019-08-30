# LaravelVisitor

## 1. Introduction 
LaravelVisitor is a [Visitor Design Pattern](https://it.wikipedia.org/wiki/Visitor) implementation for Laravel. It allows to easily execute processing of collections of arbitrary elements, without requiring to use repeated conditionals, thus improving code abstraction.

Without Visitor:
```php
public function process() 
{
  $result = '';
  foreach ($this->elements as $element) {
    if ($element instanceof FooClass) {
      $result .= ((FooClass)$element)->getData();
    } elseif ($element instanceof BarClass) {
      $result .= ((BarClass)$element)->getData();
    } elseif ($element instanceof BazClass) {
      $result .= ((BazClass)$element)->getData();
    }
  }
}
```

With Visitor:
```php
public function process() 
{
  $visitor = new MyVisitor([
    new FooClass(),
    new BarClass(),
    new BazClass(),
  ]);
  
  $visitor->execute();
  
  $result = $visitor->getResult();
}
```

All of the complexity is hidden in the `MyVisitor` class, which must define methods for processing classes. In the previous example, `MyVisitor` would be implemented as:

```php
class MyVisitor extends Visitor
{
  private $result;
  
  public function getResult()
  {
    return $this->result();
  }
  
  public function visitFooClass(FooClass $fooClass) 
  {
    $this->result .= ... ;
  }
  
  public function visitBarClass(BarClass $fooClass) 
  {
    $this->result .= ... ;
  }
  
  public function visitBazClass(BazClass $fooClass) 
  {
    $this->result .= ... ;
  }
}
```

Additionally this enforces SRP principle, since Domain Objects don't have to implement representational methods, which are only responsibility of the Visitor classes implementation (especially if several are required).

## 2. Installation

Install the package via composer:

`composer require robertogallea/laravel-visitor`

## 3. Usage

For using the package, you need to define at least one `Visitor` and some `Visitee` classes.


### 3.1. `Visitee`s implementation

The only requirement for `Visitee`s is to use the `Visitable` trait, so you can make any class visitable.

### 3.2. `Visitor`s implementation

A `Visitor` class must impelemnt the `CanVisit` interface and subclass the `Visitor` abstract class, by defining the `getResult()` method.

Additionally, for each defined `Visitee`'s you have to implement a processing method of your choice. For example, if you have a `Book` Visitee, you must define the method:

```php
public function visitBook(Book $book) {
  ...
}
```

### 3.3. `Visitor`s generation

To generate `Visitor`, you can launch the following artisan commands:

`php artisan make:visitor MyVisitor`

which by default creates classes in the `Visitors` folder.

## 4. Example usage:

### 4.1. `Visitee` implementation

Magazine.php
```php
use robertogallea\LaravelVisitor\Models\Visitable;

class Magazine
{
    use Visitable;

    private $title;
    private $month;
    private $year;

    public function __construct($title, $month, $year)
    {
        $this->title = $title;
        $this->month = $month;
        $this->year = $year;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getYear()
    {
        return $this->year;
    }

}

```

### 4.2. `Visitor` implementation

XMLVisitor.php
```php
use robertogallea\LaravelVisitor\Models\Visitor;

class XMLVisitor extends Visitor
{
    private $xml = '';    

    public function visitMagazine(Magazine $magazine)
    {
        $this->xml .= '<magazine title="' . $magazine->getTitle() . '" ' .
            'issue="' . $magazine->getMonth() . ' ' . $magazine->getYear() . '"></magazine>' . PHP_EOL;
    }

    public function getResult()
    {
        return $this->xml;
    }
}
```

### 4.3. Client code

```php

  $xmlCatalog = new XMLVisitor([
    new Magazine('PHP programming', 'July', 2019)
    new Magazine('The art of woodworking', 'August', 2019)
  ]);

  $xmlCatalog->process();
  
  echo($xmlCatalog->getResult());        
```

will produce the following output:

```html
<magazine title="PHP programming" issue="July 2019"></magazine>
<magazine title="The art of woodworking" issue="August 2019"></magazine>
```

## 5. Issues, Questions and Pull Requests

You can report issues and ask questions in the [issues section](https://github.com/robertogallea/laravel-visitor/issues). Please start your issue with `ISSUE: ` and your question with `QUESTION: `

If you have a question, check the closed issues first.

To submit a Pull Request, please fork this repository, create a new branch and commit your new/updated code in there. Then open a Pull Request from your new branch. Refer to [this guide](https://help.github.com/articles/about-pull-requests/) for more info.
