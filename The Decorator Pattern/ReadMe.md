# The Decorator Pattern

## Definition
In object-oriented programming, the decorator pattern is a design pattern that allows the behavior to be added to an individual object, either statically or dynamically, without affecting the behavior of other objects from the same class.

# Problem
John is one of the modern pizza owners. He already owns an application which takes orders online. But he is facing few problems.

As we all love pizza, we know that pizza comes with great varieties with different toppings. Now you might think of inheritance by having ``Pizza`` as an interface or abstract class and different types of pizzas as child classes to follow `code to the interface` principle. But that's not it!

If we got with this approach then we might have to build different classes for different pizzas. Like If we have New York Style pizza with topping just with cheese then we might have a class NYPizzaWithCheese. If we decide to add a new topping like onions then we have to create new class NYPizzaWithCheeseAndOnions and so on. Sooner we will have dozens of classes just for NY style pizza same goes with Italian, Chicago style pizzas. That what we call a class explosion. Also if we want to calculate the cost of pizza as per it's added toppings we have to declare it statically inside ``NYPizzaWithCheeseAndOnions`` class. But if later on the price of cheese goes higher and we want to increase the price of pizzas having extra cheese, then we have to hunt down all the classes having cheese as a topping and make changes over there.

Even if we decide to have toppings as an option inside NYPizza like

```
if (toppings.cheese) {
    // add cheese
}

if (toppings.onions) {
    // add onions
}
```
and so on.

# Solution
We can decorate our concrete pizza class with its toppings at runtime with any number of toppings and any combination.

We will create an interface ``Pizza`` which will be inherited by ``NYStylePizza`` and ``ItalianPizza`` and so on. the interface have two methods ``getCost()`` and ``description()``. Since ``Pizza`` is an interface so we need to implement these methods in it child classes.

``NYStylePizza``'s ``getCost()`` method will return base price of that pizza. Say without extra toppings. Same goes for ``ItalianPizza``.

As we discussed earlier we are going to decorate concrete pizza classes with toppings. To achieve that we will create different classes for different toppings which will extend from ``PizzaDecorator`` abstract class with itself will be of type ``Pizza``. Since we want to use ``Pizza``'s ``getCost()`` and ``description()`` methods and also wants to make sure that our toppings will be of type ``Pizza``. So all toppings will be of type ``PizzaDecorator`` and ``Pizza``. That force them to implement both ``getCost()`` and ``description()`` methods.

One important thing will be, we will pass an object of type ``Pizza`` to toppings class's constructor which will give them the access to ``getCost()`` and ``description()`` methods of type ``Pizza``.

the ``getCost()`` methods will calculate the cost by taking the price of pizza passed inside its constructor and adding it to ingredient's price.

Like

```
class Onions extends PizzaDecorator
{
    protected $cost = 10;
    protected $pizza;

    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    public function getCost()
    {
        return $this->pizza->getCost() + $cost;
    }
}
```

Since all the concrete Pizza and Toppings classes are of type ``Pizza`` it will be easy to decorate any pizza with any number of toppings.

How can we do that? Something like this -

NYStylePizzaWithCheeseAndOnions will be
```
$pizza = new Onions(new Cheese(new NYStylePizza()));
```
Now rather than creating class for NYStyleCheesePizza we can have -
```
$pizza = new Cheese(new NYStylePizza());
```