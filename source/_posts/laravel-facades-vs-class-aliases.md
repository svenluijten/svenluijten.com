---
title: Laravel facades vs class aliases
date: 2024-04-22
excerpt: Diving into the difference between Laravel's facades and class aliases.
extends: _layouts.post
section: body
---

There's a difference between what Laravel calls facades and class aliases. Let's
take a look at both, and how they became so intertwined with each other in the
public eye.

## Facades
Facades are nothing but _proxies_ to an object in the service container. In
other words, if an object is bound to the service container as `'my-service'`,
you can call methods on that object by using static methods on the following
facade:

```php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyServiceFacade extends Facade
{
    public function getFacadeAccessor()
    {
	    return 'my-service';
    }
}
```

Notice the `'my-service'` string by which the service is bound to the container.
When _any_ static method is called on this facade, 
[the facade's `__callStatic()`magic method](https://github.com/laravel/framework/blob/428f86d2734d7ce4a40b3826bf78500c395b419d/src/Illuminate/Support/Facades/Facade.php#L349-L358) is invoked, the `'my-service'`
service is retrieved from the container, and your call is forwarded to that
instance.

You still have to reference the full namespace to this facade (`App\Facades\MyServiceFacade`) 
when you use it in your application. At least, if you don't also add a class alias.

## Class Aliases
PHP allows developers to alias _any_ class to _any other name_ using 
[the `class_alias` function](https://www.php.net/manual/en/function.class-alias.php). For example, say I have a class named `Aang`,
I could alias it to`BonzuPippinpaddleopsicopolisTheThird` and use it like normal:

```php
class Aang
{
	public static function greet(): string
	{
		return 'Flameo!';
	}
}

class_alias(Aang::class, 'BonzuPippinpaddleopsicopolisTheThird');

echo BonzuPippinpaddleopsicopolisTheThird::greet(); // Flameo!
```

This can be useful for using classes with a long FQCN in views, where importing
classes with `use` statements might not be possible or is just plain ugly.

## The Confusion
Laravel aliases all facades it ships with to their base classname. That means
[all classes in the `Illuminate\Support\Facades` namespace](https://github.com/laravel/framework/tree/428f86d2734d7ce4a40b3826bf78500c395b419d/src/Illuminate/Support/Facades) are available
as if they are in the global namespace. You can see this happen in your own
`config/app.php` (the `aliases` key).

I think this default behavior is why a lot of people in the Laravel community have
conflated facades and class aliases.

Using a namespaced class as if it lives in the global namespace is not only for
facades. You can alias whatever classes you want in the aforementioned `config/app.php`.
For example you might alias `Illuminate\Support\Str` to just `Str` and
`Illuminate\Support\Number` to `Num` for quick and easy use in views.

## Conclusion
`\Config` is not a _facade_, it's a class alias for the facade. There is no reason
why you shouldn't import the full namespace to a facade in PHP-only files.

I generally think that for facades, you should import the full namespace 
(`use Illuminate\Support\Facades\Config`) and not the alias. I also try to limit
the use of class aliases in views and opt for the global functions Laravel provides
instead because aliases don't work with autocomplete in my IDE without external
tooling.
