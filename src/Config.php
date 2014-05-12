<?php

namespace SummerOrm;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class Config
{

    /**
     * @var array
     */
    private static $db = [];

    /**
     * Connection parameters
     * @var array
     */
    private static $options = [];

    /**
     * Only static method init
     */
    private function __construct()
    {
    }

    /**
     * Set database configurations (PDO style)
     * @param $options array|Connection
     */
    public static function init($options)
    {
        if ($options instanceof Connection) {
            self::$db['default'] = $options;
        } else {
            self::$options['default'] = $options;
        }
    }

    /**
     * @param string $name
     * @return Connection
     */
    public static function getDb($name = 'default')
    {
        if (empty(self::$db[$name])) {
            if (isset(self::$options['default'])) {
                return self::$db['default'] = DriverManager::getConnection(self::$options['default']);
            } else {
                throw new \Exception('No connection');
            }

        }

        return self::$db['default'];
    }


    public static function getCharset($db = 'default')
    {
        $params = self::getDb($db)->getParams();
        if (!empty($params['charset'])) {
            return $params['charset'];
        } else {
            return 'utf8';
        }

    }

} 