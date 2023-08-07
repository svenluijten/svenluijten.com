---
title: My branching/tagging strategy for packages
date: 2023-08-11
excerpt: How I manage branches and tags for the PHP packages I've published
extends: _layouts.post
section: body
---

I've never had a very good grasp on how I should branch my open source libraries. There are a lot of resources out there
detailing how to branch and tag _projects_ ([git-flow](https://nvie.com/posts/a-successful-git-branching-model/),
[GitHub flow](https://docs.github.com/en/get-started/quickstart/github-flow),
[Trunk based development](https://trunkbaseddevelopment.com), ...), but these don't map very well to distributed
libraries.

This is the blog post I wish I had when I was searching for a good workflow for branching and tagging open source
packages/libraries.

## My strategy

### Initial development
First off, every repository has a `main` branch. This is always the _next_ major version of the library, and therefore
also where all the development happens _before_ a version is tagged.

### Tagging the first version
When you're ready to tag your first major version (`v1.0.0`), first create a branch called `1.x`. This is where you'll
then tag your first version from.

```sh
$ git switch main
$ git pull origin main
$ git switch -c 1.x
$ git push origin 1.x
$ git tag -s v1.0.0 -m 'Version 1.0.0'
$ git push origin v1.0.0
```

Be sure to also [make `1.x` the default branch on GitHub](https://docs.github.com/en/repositories/configuring-branches-and-merges-in-your-repository/managing-branches-in-your-repository/changing-the-default-branch).
From this point on, `main` is for `v2.0.0` development. I would now also _stop_ directly committing to any of these
branches and work via pull requests instead. These pull requests most often target `1.x`, and are ported over to `main`.

For instance, say I have a new feature _without breaking changes_ in the works. The pull request for this feature will
target `1.x` so it lands in `v1.1.0`. Once approved and merged into `1.x`, I would then merge that change into `main`:

```sh
$ git switch 1.x
$ git pull origin 1.x
$ git switch main
$ git pull origin main
$ git merge 1.x --ff-only
$ git push origin main
```

> You could also facilitate this merge from the GitHub UI by using the "compare" page. Append `/compare/main...1.x` to
> your repository's URL, and you'll see a button to create a pull request to merge the changes from `1.x` into `main`.

### Tagging new minor and patch versions
Once `v1.1.0` is ready to be released, you should tag this from the `1.x` branch:

```sh
$ git switch 1.x
$ git pull origin 1.x
$ git tag -s v1.1.0 -m 'Version 1.1.0'
$ git push origin v1.1.0
```

### Two point oh and beyond
When you introduce a breaking change in one of your pull requests, you should target it to the `main` branch. The moment
you're ready to tag `v2.0.0`, you create a new `2.x` branch and tag the next major version from there. This is pretty
much the same as [tagging the first version](#tagging-the-first-version).

```sh
$ git switch main
$ git pull origin main
$ git switch -c 2.x
$ git tag -s v2.0.0 -m 'Version 2.0.0'
$ git push origin v2.0.0
```

> **Remember to also [update the default branch](https://docs.github.com/en/repositories/configuring-branches-and-merges-in-your-repository/managing-branches-in-your-repository/changing-the-default-branch)
> to `2.x` at this point.**

### Bug fixes for previous versions
If a bug fix comes in that should be applied to `2.x` _and_ `1.x` (or other previous versions), it should be targeted to
the latest branch where the bug is present. I will assume `2.x` in this case. Once the bug fix is merged into `2.x`, you
can _cherry-pick_ the commit(s) into the other affected version(s):

```sh
$ git switch 2.x
$ git pull origin 2.x
$ git switch 1.x
$ git cherry-pick <commit sha>
# Or, if you want to cherry-pick multiple commits:
# git cherry-pick <first commit>^..<last commit>
$ git push origin 1.x
$ git tag -s v1.x.y -m 'Version 1.x.y' # Where 'y' is incremented
$ git push origin v1.x.y
$ git switch main
```

## The alternative
I considered a strategy where the `main` branch is always the _current_ latest version, but that resulted in more
forgettable administrative work. Besides, what I outlined above is actually what Laravel does (as far as I could infer),
and it's similar to [what Symfony follows](https://symfony.com/doc/current/contributing/code/pull_requests.html#choose-the-right-branch).
So we're in good company.

## Conclusion
I hope now that I've written this down, I can actually follow this in my own projects. This should ease the process of
contributing to my packages, and help me in being less confused when I need to tag a new release.
