<?php
namespace SummerOrmTests\Examples\Models;

use SummerOrm\Model;

/**
 * @property String(max_length=20) $name Book name
 * @property Integer() $year Year
 * @property String(max_length=20, default="O'relly") $publisher Year
 */
class Book extends Model
{

    protected static $db_table = 'books';
}

