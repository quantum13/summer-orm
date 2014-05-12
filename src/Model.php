<?php
namespace SummerOrm;


use SummerOrm\Fields\AutoField;

/**
 * Class Model
 * @property AutoField() $id
 */
class Model
{

    protected $properties = [];

    /** @var Manager */
    protected static $objects = null;

    /** @var string */
    protected static $db_table = '';

    /** @var array */
    protected static $ordering = [];

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        //TODO cache
        $refl = new \ReflectionClass($this);
        $docblock_lines = explode("\n", $refl->getDocComment());
        foreach ($docblock_lines as $line) {

            if (!preg_match('/@property\s+(\w+)\((.*)\)\s+\$(\w+)/', $line, $prop_match)) continue;

            $property_name = trim($prop_match[3]);
            if (!$property_name) continue;

            $class_name = "\\SummerOrm\\Fields\\{$prop_match[1]}";
            if (!class_exists($class_name)) continue;

            $field_params = [];
            if ($prop_match[2] && preg_match_all('/(\w+)\s*=\s*(\'.*\'|".*"|[\d\.]+)/', $prop_match[2], $params_matches)) {
                foreach ($params_matches[1] as $key => $param_name) {
                    $field_params[$param_name] = trim($params_matches[2][$key], '\'"');
                }
            }

            $this->properties[$property_name] = new $class_name($field_params);
            if (isset($params[$property_name])) {
                $this->properties[$property_name]->setValue($params[$property_name]);
            }
        }

        $this->properties['id'] = new AutoField(['primary_key' => true]);
    }

    public function __set($property, $val)
    {
        if (isset($this->properties[$property]) && $this->properties[$property] instanceof Fields\Base) {
            $this->properties[$property]->setValue($val);
        } else {
            $this->{$property} = $val;
        }
    }

    public function __get($property)
    {
        if (isset($this->properties[$property]) && $this->properties[$property] instanceof Fields\Base) {
            return $this->properties[$property]->getValue();
        } else {
            return null;
        }
    }


    public function save()
    {
        if (empty(self::$db_table)) {
            return false;
        }

        if ($this->id) {
            Config::getDb()->update(self::$db_table, $this->properties, [
                'id' => $this->id
            ]);
        } else {
            Config::getDb()->insert(self::$db_table, $this->properties);
            $this->id = Config::getDb()->lastInsertId();
        }
        return $this;
    }

    /******************** Static methods *****************************/

    /**
     * @return Manager
     */
    public static function objects()
    {
        if (empty(self::$objects)) {
            self::$objects = new Manager(get_class());
        }
        return self::$objects;
    }
}