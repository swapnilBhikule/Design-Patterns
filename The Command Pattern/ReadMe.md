# The Command Pattern

## Definition
The Command Pattern encapsulates a request as an object, thereby letting you parameterize other objects with different requests, queue or log requests, and support undoable operations.

# Problem
John is a CEO of, letsmeet.com, an online social netowrking site made for couples. John's old developer have made few event classes for common events like user logged in, user logged out and user registered. All these classes having their own set of methods. Whenever John want to use these classes, he have to import them(concrete classes) as they are compleletely different from each other so they do not have common interface, which is a big issue as it's voilating the OO principle, "code to the interface not to the implementation"! Even for his new developers, it's difficult as their new classes need to keep the knowledge of these concrete event classes(their properties, methods etc).

So, John want us to create a design, where all the information of these concrete classes will be encapsulated. His developer should be able to use these event classes wherever they want without having their knowledge.