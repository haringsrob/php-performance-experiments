## Objects vs arrays

NOTE: This test runs its own set of iterations
and is not using the number from the make file.

It would run out of memory pretty
quickly with that amount of iterations.

### Explanation

To identify if a php object is more or less memory heavy than an array.

To do this we make a small function.

We instantiate a array or object, take a specific value from it and assign it to another part of the object or array.

Then we return that and assign it to $$i to keep it in memory for all the iterations.
