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

## Initial Development
First off, every repository has a `main` branch. This is always the _latest_ version of the library. This is therefore
also where development happens _before_ a version is tagged. There is little to no benefit from introducing complexity
by way of pull requests or approvals at this stage of development.

## Tagging the First Version
When you're ready to tag your first version (`v1.0.0`, in this case), you would do so _directly from the `main` branch_:

```sh
git switch main
git pull origin main
git tag -s v1.0.0 -m 'Version 1.0.0'
git push origin v1.0.0
```

This is also when I _stop_ directly committing to `main`, and work via pull requests from this point on. These pull
requests should be targeted towards `main`, and any subsequent minor and patch versions should be tagged from there as
well.

## Two Point Oh and Beyond
When you introduce a breaking change in one of your pull requests, it's time to tag the next major version (`v2.0.0`),
because you're following [SemVer](https://semver.org), right? But before you do, prepare your branches so you and
contributors can still apply bug fixes to `1.x`. Even if you don't want to actively support this version anymore, it's a
good idea to make it as easy as possible for others to find old versions of your library.

```sh
# Do this *before* merging the breaking change:
git switch main
git pull origin main
git switch -c 1.x
```

Create a `1.x` branch directly from `main`. This way, `1.x` is an "archived" version of the first version of your
package, and `main` is still the _latest_ version.

> **If `v2.0.0` is not ready to be tagged yet, you should [change the default branch](https://docs.github.com/en/repositories/configuring-branches-and-merges-in-your-repository/managing-branches-in-your-repository/changing-the-default-branch) to `1.x` on GitHub**.
>
> It is good practice to have the latest stable version be the default branch. This can also be `main`.

Once you're ready to tag `v2.0.0`, do so directly from `main`.

## Bug Fixes to Previous Versions
At this point, I normally only accept bug fixes for `1.x`. When one comes in as a pull request, it should be targeted
towards the `1.x` branch _if it only applies to that version_. If this is not the case, see
[Porting Bug Fixes to Previous Versions](#porting-bug-fixes-to-previous-versions).

When this pull request is merged into `1.x`, tag the next version _from that branch_:

```sh
git switch 1.x
git pull origin 1.x
git tag -s v1.x.y -m 'Version 1.x.y' # Where 'y' is incremented
git push origin v1.x.y
git switch main
```

## Porting Bug Fixes to Previous Versions
If a bug fix comes in that should be applied to `2.x` _and_ `1.x` (or other previous versions), it should be targeted to
the latest branch where the bug is present. I will assume `main` in this case. Once the bug fix is merged into `main`,
you can _cherry-pick_ the commit(s) into the other affected version(s):

```sh
git switch main
git pull origin main
git switch 1.x
git cherry-pick <commit sha>
# Or, if you want to cherry-pick multiple commits:
# git cherry-pick <first commit>^..<last commit>
git push origin 1.x
git tag -s v1.x.y -m 'Version 1.x.y' # Where 'y' is incremented
git push origin v1.x.y
git switch main
```

## Conclusion
This workflow seems to work well for me, though I'm sure I'll be tweaking it as I adopt it into more libraries. Now that
I wrote it out, it'll also be easier for me to actually implement it into my own packages/libraries.
