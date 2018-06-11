# The Singleton Pattern

## Definition
The Singleton Pattern ensures a class ahs only one instance, and provides a global point of access to it.

# Problem
Mac is a CEO of digital banking system solutions. His one of the client want him to build a system where they can store important(might not be credientials) data. The data is same for all branches of Bank. That means it will be same for all branches and at any time any branch manager should be able to access it, and if he make any changes to that data then it should stored such that when other bank managers try to retrive the same data they will get the updated value.

In object point of view, think about an object which is avaliable to any branch but it should be the only instance of it's class, there should not be more than one instance available to all branch managers. By this way, whenever we store any value in the object, then it will be available to everyone having an access to that object.