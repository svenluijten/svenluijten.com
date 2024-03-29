---
title: Enable IntelliSense for PHP Extensions in PhpStorm
date: 2023-07-07
excerpt: How you can enable extensions in PhpStorm so you get working autocomplete on them.
extends: _layouts.post
section: body
---

If you want to use a non-standard PHP extension in your project (like [Parle](https://www.php.net/manual/en/book.parle.php))
you might run into a problem when trying to use it in PhpStorm: _no IntelliSense_! To fix this, all you need to do is
enable the extension in PhpStorm's settings:

1. Open `Settings` and go to `PHP` ([`Preferences | PHP`](jetbrains://PhpStorm/settings?name=PHP)).
2. Click the `PHP Runtime` tab and expand the `PECL` section.
3. Make sure `Parle` (or whatever extension you are trying to install) is enabled.
4. Hit apply and close the settings window.

![dark](/assets/images/posts/phpstorm-extensions-dark.jpg){scheme=dark}
![Enabling PHP extensions in PHP's interpreter in PhpStorm](/assets/images/posts/phpstorm-extensions.jpg)

You should now have autocomplete/IntelliSense once again!

If you have a CLI interpreter configured, this is also where you can find a "Sync Extensions with Interpreter" button to
have it automatically read your extensions and enable/disable them when needed.
