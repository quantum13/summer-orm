<?php
namespace SummerOrm;

use PHPUnit_Framework_TestCase;
use SummerOrmTests\Examples\Models\Book;

class ModelTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $book = new Book([
            'name' => 'Super Book 2014',
            'year' => '2014'
        ]);
        $this->assertEquals($book->name, 'Super Book 2014');

        //max_length strip
        $book->name = 'Super Book 2014, rev2';
        $this->assertEquals($book->name, 'Super Book 2014, rev');

        $this->assertTrue(is_int($book->year));
        $this->assertEquals($book->year, 2014);

        $book->year++;
        $this->assertEquals($book->year, 2015);

        $book->custom_prop = 1;
        $this->assertEquals($book->custom_prop, 1);

        //default values
        $this->assertEquals($book->publisher, "O'relly");
    }

    public function testGetManager()
    {
        $this->assertInstanceOf('\SummerOrm\Manager', Book::objects());
    }
}
