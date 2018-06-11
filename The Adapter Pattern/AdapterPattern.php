<?php


// The Restaurent's Pizza process
// 1. Prepare the dough
// 2. Add toppings as per pizza type
// 3. Bake the pizza in over as per the requirement
interface Pizza
{
    public function prepareDough();

    public function addToppings();

    public function bake();
}

/**
 * The Basic NY Style Pizza
 */
class NYPizza implements Pizza
{
    /**
     * Prepare the dough for NY Style pizza
     *
     * @return void
     */
    public function prepareDough()
    {
        echo "Preparing dough for pizza \n";
    }

    /**
     * Add basic NY style toppings
     *
     * @return void
     */
    public function addToppings()
    {
        echo "Adding onions, tomatos and cheese \n";
    }

    /**
     * Bake the pizza in over at 350 deg
     *
     * @return void
     */
    public function bake()
    {
        echo "Baking pizza at 350 deg \n";
    }
}

// The Restaurent's Burger Process
// 1. Prepare patty as per burger type
// 2. Add ingredients inside patty
// 3. If needed bake the burger(we will see about that!)
interface Burger
{
    public function preparePatty();

    public function addIngredients();

    public function bake();
}

/**
 * A completely new type of burger built for pizza lovers.
 */
class BurgerPizza implements Burger
{
    /**
     * Prepare the patty specially made for burger pizza
     *
     * @return void
     */
    public function preparePatty()
    {
        echo "Preparing patty for burger pizza \n";
    }

    /**
     * Add pizza ingredients or any custom ingredients
     *
     * @return void
     */
    public function addIngredients()
    {
        echo "Adding spanish, onions and cheese in burger \n";
    }

    /**
     * Bake the burger may be at differnt temperature as we are using patty not dough
     * and our ingredients might be different.
     *
     * @return void
     */
    public function bake()
    {
        echo "Baking burger at 150 deg \n";
    }
}

/**
 * Now the restaurent decided to come up with a completely new receipe. They wanted to
 * attract users and to give them a new experience of pizza but by keep the eating
 * process same as burger. So that, those who love the pizza but don't want to buy a
 * big 18' pizza can have burger pizza which is small but enough for a single person.
 *
 * But the problem is, the process of making pizza and burger is completely different.
 * Their types are different, functions are of course different. But if we decide to
 * make a burger by following pizza process, our client code will be in trouble.
 * Since, our pizza client code is specifically written to support only pizza process
 * and to deal with classes having "Pizza" type, we obviously cannot simple add our
 * BurgerPizza in the pizza process.
 * Here, we have two options:
 * 1. A simple but still painful option is to rewrite the client code to support
 * BurgerPizza type which definitely breaks the Open-Closed principle. But think
 * about it, what if a restaurent decide to have new SandwitchPizza.
 * Well, Sandwitch is a completely different type, and in future well will find
 * ourself editing the same client code by adding support for new Class type.
 * We don't want to do that again and again, do we?
 * 2. A bit difficult but intelligent option is to use Adapter Pattern. Well,
 * the pattern is exactly like normal adapter which we use in our electronics.
 * What we have to do is, to create a new "Adapter" class which will have the
 * "Pizza" type but we will delegate it with Burger object. So, whenever a client
 * calls any pizza process method on an Adapter class, we will run respective Burger
 * method(s) behind it and return back it's result.
 * By this way, we don't have to change our client code as the Adapter will be of type
 * "Pizza" and we will encapsulate Burger class from our client code. The client
 * code will never come to know about our Burger class, what it know is, it is dealing
 * with a class of type "Pizza".
 * So, the next time when restaurent comes to us to add SandwitchPizza, we will simply
 * create it's Adapter class.
 */
class BurgerPizzaAdapter implements Pizza
{
    protected $burger;

    /**
     * Deligate the object of type Burger
     *
     * @param Burger $burger
     */
    public function __construct(Burger $burger)
    {
        $this->burger = $burger;
    }

    /**
     * Whenver client call for prepateDough process this will run burger's
     * preparePatty method
     *
     * @return void
     */
    public function prepareDough()
    {
        $this->burger->preparePatty();
    }

    /**
     * Whenver client call for addToppings process this will run burger's
     * addIngredients method
     *
     * @return void
     */
    public function addToppings()
    {
        $this->burger->addIngredients();
    }

    /**
     * Whenver client call for bake process this will run burger's
     * bake method but may be at differnt temperature
     *
     * @return void
     */
    public function bake()
    {
        $this->burger->bake();
    }
}

// client

echo "----------------------- Basic NY Style Pizza ----------------------- \n";

/**
 * The restaurent's customer ordered a NY Pizza so the client will prepare it.
 */
$ny_pizza = new NYPizza;

$ny_pizza->prepareDough();
$ny_pizza->addToppings();
$ny_pizza->bake();


echo "----------------------- The All New Burger Pizza ----------------------- \n";
/**
 * Now, when the customer will order a Burger Pizza, we will use it's Adapter to make
 * sure that the Burger should be able to Pizza methods as client knows the details of
 * a class of type "Pizza" and not aware of a type "Burger"
 */

// These two lines might be at different place.
// May be in a class which is responsible for processing orders.
// But for the sake of simplicity we will create these objects here itself.
$burger_pizza = new BurgerPizza;
$burger_pizza_adapter = new BurgerPizzaAdapter($burger_pizza);

$burger_pizza_adapter->prepareDough();
$burger_pizza_adapter->addToppings();
$burger_pizza_adapter->bake();