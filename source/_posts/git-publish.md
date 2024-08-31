---
title: Git publish
date: 2024-08-31
excerpt: My alias to push new branches in git up to the remote.
extends: _layouts.post
section: body
---

I have a git alias set up to push the current (new) branch up to `origin` and set it as the remote-tracking branch:

```
[alias]
     publish = "!git push origin $(git symbolic-ref --short HEAD) -u"
```

I use it by creating a new branch (for example with `git switch -c new-branch`), making a commit or two, and then
running `git publish`.

Let's take a closer look at what this command does:

- `git symbolic-ref --short HEAD` outputs the _short_ name of the current branch. For example: `new-branch`.
- `git push origin [...]` pushes the given branch to the remote (`origin` by default).
- `-u` (the shorthand for [`--set-upstream`](https://git-scm.com/docs/git-push#Documentation/git-push.txt--u)) makes sure to _track_ the remote branch so that it is easier to work with in subsequent `push` or `pull` operations without having to specify the name of the branch each time. 
