---
title: Using interfaces in third-party packages
date: 2024-01-09
excerpt: How to effectively use interfaces to make your PHP package easier to work with and more customizable than ever before.
extends: _layouts.post
section: body
---

I was recently working a PR to make [The OG](https://github.com/simonhamp/the-og) more customizable, and I had some
thoughts on using interfaces instead of concrete classes or enums in third-party packages.

Say you expose a `ColorOption` enum so that others can change the color of a UI element.

```php
enum ColorOption: string 
{
    case Red = 'red';
    case Green = 'green';
    case Blue = 'blue';
}

function setColor(ColorOption $color) 
{
    // ...
}

setColor(ColorOption::Red);
```

By definition, enums ([introduced all the way back in PHP 8.1](https://php.watch/versions/8.1)) are not extensible and
make your code quite _rigid_. This is fine and likely desired when options are inherently limited[^1], but breaks down
when you use them for something the consumer of your package might want to customize.

So what would happen if someone wants to set the color to yellow? They can't, because your API typehints your
`ColorOption` enum! You can solve this by depending on an interface instead. Let's dive in.

## Introducing the interface
You'd start by defining a minimal interface your `setColor` function needs to work. For now, just a `name()` function
will do for demonstration purposes. But even an empty interface might suffice.

```php
interface Color
{
    public function name(): string;
}
```

You'll also need to update the `setColor` function to accept this new `Color` interface instead of the `ColorOption` enum:

```php
function setColor(Color $color)
{
    // ...
}
```

You can then extract each of the enum's cases into their own classes that implement the new interface:

```php
class Red implements Color
{
    public function name(): string
    {
        return 'red';
    }
}

class Green implements Color 
{
    public function name(): string
    {
        return 'green';
    }
}

class Blue implements Color 
{
    public function name(): string
    {
        return 'blue';
    }
}
```

Now you and consumers of the package can pass an instance of any class that implements that interface into the function:

```php
setColor(new Red());
setColor(new Green());
setColor(new Blue());
```

Whoever uses your package can then write their own `Yellow` class to use in their code:

```php
class Yellow implements Color
{
    public function name(): string
    {
        return 'yellow';
    }
}

setColor(new Yellow());
```

A big benefit of this approach is that you can construct each of the options however you want. If one of our options
needed some extra dependencies to work, we could inject them into the constructor:

```php
$blue = new Blue($opacity);

setColor($blue);
```

(I will admit, this is where the "color" example falls apart. I promise this would make a lot more sense in the real world!)

## Keeping the enum
There's even a way you can continue using an enum to make it easier for consumers to pick from built-in options without
sacrificing customizability. You can let your enum implement the `Color` interface. I didn't even know that was possible
until recently! Consider we have the same `Color` interface from above:

```php
enum ColorOption: string implements Color
{
    case Red = 'red';
    case Blue = 'blue';
    case Green = 'green';

    public function name(): string 
    {
        return $this->value;
    }
}
```

Users can then use your options like they would before:

```php
setColor(ColorOption::Red);
setColor(ColorOption::Green);
setColor(ColorOption::Blue);
```

This allows you to still use the interface and for your package to provide the user with a predefined set of values
under your control — centralized in an enum — and allows the consumer to still customize to their heart's content:

```php
// With their own "yellow" class:
class Yellow implements Color 
{
    public function name(): string
    {
        return 'yellow';
    }
}

setColor(new Yellow());

// Or their own enum:
enum CustomColor: string implements Color 
{
    case Cyan = 'cyan';
    case Magenta = 'magenta';
    case Yellow = 'yellow';

    public function name(): string 
    {
        return $this->value;
    }
}

setColor(CustomColor::Cyan);
setColor(CustomColor::Magenta);
setColor(CustomColor::Yellow);
```

One drawback with this is that enums in PHP can't have state. This means they don't allow properties and otherwise
dynamic values. This makes sense, but is worth keeping in mind if going for this approach.

## Conclusion
I find code like this easier to build upon and more ergonomic to work with. Adding a new option is as simple as adding a
class and implementing an interface. This applies both to the package author (you) and the consumer (other developers).

In the end, depending on an _interface_ instead of a concrete class or enum is always preferred because it keeps the
coupling between components loose while still allowing for others to extend the functionality.

[^1]: Like "north", "east", "south", and "west". We're unlikely to see any new cardinal directions in our lifetime.
