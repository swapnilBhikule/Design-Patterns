# The Observer Pattern

## Definition
Define a one-to-many dependency between objects so that when one object changes state, all its dependents are notified and updated automatically.

# Problem
We have a secret client who wants us to make some kind of alarm system whenever there is a security breach. We got a class ``SecurityBreach`` which gets run after every 10 sec may be via the cron job. But for the sake of simplicity, we will write our own client code.

Now our secret client wants us to write a code which will check for the security breach and notify their admin(s) via different modes(Email or SMS may be). But he already has warned us that he might add new modes like firing an API to their system.

So we want to make sure that the code should execute predefined modes like ``Send an Email`` and ``SMS``. But it should also be flexible enough to add new mode at any time without modifying the existing code. Which is ``Open for extension but closed for modification``

# Solution
we can think of is creating a class which can notify all different modes(observers as they will observe for the security breach and execute their code) by executing different mode objects. Also, the class should be flexible enough to allow developers to add(register) or remove observers in future.

As per the current requirement, we will create ``SecurityBreach`` class which will have the functionality to add(register)/remove observers and to notify added(registered) observers. As of now, we will create two observers ``EmailObserver`` and ``SMSObserver``.

The ``SecurityBreach``'s addObserver will register the new observer to its list. So later on other developers can create new observers like ``APIObserver`` and register it with the ``SecurityBreach`` object.

The ``SecurityBreach``'s removeObserver will remove given registered observer from its list. So later on if a client decides to stop sending SMS alerts then they can simply remove it by passing the ``SMSObserver`` object to the ``removeObserver`` method.

The ``breach`` is a method which will check for any security breach and if it founds one then it will execute ``notify`` method.

The ``notify`` method will loop through its registered list of observers and execute their ``update`` method which will update admin(s) via email or SMS or any mode which is registered with ``SecurityBreach`` class.