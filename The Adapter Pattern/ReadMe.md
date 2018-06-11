# The Command Pattern

## Definition
The Adapter Pattern converts the interface of a class into another interface the client expects. Adapter lets classes work together that couldn't otherwise because of incompatible interfaces.

# Problem
A very fast food restaurent service Pizzas and Burgers. But their chef came up with a billion dollar idea(at least he thinks) of combining pizza experience with burger. So, they decided to add Burger Pizza in their menu. It's besically a burger but can also be ordered from Pizza section to improve it's visibility in their menu card.

But we noticed one thing that their food processing classes(clients) are different form Pizza and Burger as these two dishes need different processing. But, they have decided to add Burger Pizza inside pizza menu so the Pizza Processing class needs to support Burger Processing.

One of the simplest thing we can do it, reading their pizza processing client code and making changes directly over there to support "Burger" type but which breaks the "Open-Closed Principle".

The other solution can be of using the Adapter Design Patten. Take a look inside the code to know more about its implementation.