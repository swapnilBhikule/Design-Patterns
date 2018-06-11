<?php

/**
 * This is a class specifically designed for the singleton pattern.
 * Meaning there will be always one and only one instance of the
 * class available to all the clients.
 */
class Configurations
{
    /**
     * This property is declared static as only static properties can be
     * accessed in a static method
     *
     * @var Configuration
     */
    private static $instance;

    /**
     * Making a constructor private prevent clients from making a direct
     * object/instance of a class.
     */
    private function __construct() {}

    /**
     * This method is declared as a static method as we can access this method
     * without creating an instance of a class(which is impossible due to private
     * constructor). This is a class method.
     * It creates an instance of a class only if new instance is not yet created
     * else it return back the old created instance
     *
     * @return Configuration
     */
    public static function getInstance()
    {
        if (isset(self::$instance)) {

            return self::$instance;
        }

        self::$instance = new Configurations;

        return self::$instance;
    }

    /**
     * This is an additional method(which you can skip). We're using this method
     * to set any value(s) in a class's object. It can be anything which you want
     * to be a global value. Meaning, you don't want clients to have different
     * values of a given key. As it's a singleton class so everytime client will
     * get the same object which will have same key-value pair.
     *
     * @param   mixed $key
     * @param   mixed $value
     * @return  void
     */
    public function setValue($key, $value)
    {
        self::$instance->{$key} = $value;
    }
}

// client

/**
 * Let's get the object of a Configurations class. Since this is the first time we are calling
 * getInstance method so we will get the fresh object.
 */
$obj = Configurations::getInstance();

/**
 * Let's set dummy ket-value pair to $obj
 */
$obj->setValue('password', 'haha!!');

/**
 * Let's check if that key-value pair is set
 */
var_dump($obj);

/**
 * We'll try getting new instance of a Configuration class
 */
$new_obj = Configurations::getInstance();

/**
 * If it's an old instance we used few lines before, then we should get 'password' => 'haha!!'
 * key-value pair on the new object.
 */
var_dump($obj);