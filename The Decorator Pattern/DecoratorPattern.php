<?php

interface Pizza
{
    /**
     * Return the cost of the pizza
     *
     * @return float|int
     */
    public function getCost();

    /**
     * Return pizza description
     *
     * @return string
     */
    public function description();
}

class NYStylePizza implements Pizza
{
    private $cost = 100;

    /**
     * Return the cost of the pizza
     *
     * @return float|int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Return pizza description
     *
     * @return string
     */
    public function description()
    {
        return 'New york style pizza';
    }
}

class ItalianPizza implements Pizza
{
    private $cost = 150;

    /**
     * Return the cost of the pizza
     *
     * @return float|int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Return pizza description
     *
     * @return string
     */
    public function description()
    {
        return 'Italian style pizza';
    }
}

abstract class PizzaDecorator implements Pizza
{
}

class Cheese extends PizzaDecorator
{
    private $pizza;
    private $cost = 50;

    /**
     * Assign instance of a pizza type to class property
     *
     * @param Pizza $pizza
     */
    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    /**
     * Return cost of toppings
     *
     * @return float|int
     */
    public function getCost()
    {
        return $this->pizza->getcost() + $this->cost;
    }

    /**
     * Return topping description
     *
     * @return string
     */
    public function description()
    {
        return $this->pizza->description() . ', with cheese';
    }
}

class Oregano extends PizzaDecorator
{
    private $pizza;
    private $cost = 10;

    /**
     * Assign instance of a pizza type to class property
     *
     * @param Pizza $pizza
     */
    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    /**
     * Return cost of toppings
     *
     * @return float|int
     */
    public function getCost()
    {
        return $this->pizza->getcost() + $this->cost;
    }

    /**
     * Return topping description
     *
     * @return string
     */
    public function description()
    {
        return $this->pizza->description() . ', with oregano';
    }
}

class Avocado extends PizzaDecorator
{
    private $pizza;
    private $cost = 20;

    /**
     * Assign instance of a pizza type to class property
     *
     * @param Pizza $pizza
     */
    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    /**
     * Return cost of toppings
     *
     * @return float|int
     */
    public function getCost()
    {
        return $this->pizza->getcost() + $this->cost;
    }

    /**
     * Return topping description
     *
     * @return string
     */
    public function description()
    {
        return $this->pizza->description() . ', with avocado';
    }
}

$pizza = new Oregano(new Cheese(new ItalianPizza()));

echo $pizza->getCost();
echo "\n \n";
echo $pizza->description();
echo "\n \n";