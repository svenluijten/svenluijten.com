---
title: Adding autocomplete for GitLab CI/CD config in Jetbrains IDEs
date: 2023-08-25
excerpt: Adding external JSON Schema Mappings to PhpStorm for autocomplete on GitLab CI/CD config files.
extends: _layouts.post
section: body
---

I had a problem recently where I was writing a lot of GitLab CI configuration without autocomplete. Now, of course,
eventually you get a decent handle on the syntax, but I figured it'd be a lot nicer if PhpStorm actually gave me some
hints.

That is when I found out you can add custom [JSON Schema](https://json-schema.org/) definitions to Jetbrains IDEs to
allow for extended validation (and autocomplete!) on any of your files. All you need is the JSON Schema for whatever
configuration you're writing, which most companies will publish.

I wanted autocomplete on `.gitlab-ci.yml`, so I went looking if GitLab published their own JSON Schema for their CI/CD
config, and thankfully [they do](https://docs.gitlab.com/ee/development/cicd/schema.html#json-schemas). So I did the 
following:

- Found [the URL of the JSON Schema definition file](https://gitlab.com/gitlab-org/gitlab/-/blob/master/app/assets/javascripts/editor/schema/ci.json) ([raw version](https://gitlab.com/gitlab-org/gitlab/-/raw/master/app/assets/javascripts/editor/schema/ci.json)) GitLab publishes.
- Opened [`Preferences | Languages & Frameworks | Schemas and DTDs | JSON Schema Mappings`](jetbrains://PhpStorm/settings?name=Languages+%26+Frameworks--Schemas+and+DTDs--JSON+Schema+Mappings) in PhpStorm.
- Added a new JSON Schema Mapping called `GitLab CI` with the raw URL from above and the correct schema version selected (see root `$schema` property in the GitLab-published JSON Schema for what version the document is).
- Added a new file path pattern for `*.gitlab-ci.yml`, so the validation/autocomplete is active on files that match that pattern.

![dark](/assets/images/posts/phpstorm-json-schema-mappings-dark.jpg){scheme=dark}
![PhpStorm's settings dialog showing the "JSON Schema Mappings" settings pane](/assets/images/posts/phpstorm-json-schema-mappings.jpg)

When you now edit a file that matches the configured file pattern (`.gitlab-ci.yml`, in this case), you should have
autocomplete for your GitLab CI/CD configuration!

... Of course, I later found out you can also click the little "Globe" icon next to the "Schema file or URL" input to
quickly load commonly-used JSON Schemas, one of which is GitLab's CI/CD. So do that instead!

And, for what it's worth, all JSON Schemas hosted on and maintained by 
[JSON Schema Store](https://www.schemastore.org/json/) are automatically available in all Jetbrains IDEs. So if you're
following conventions, you should already have autocomplete for over 700 file types!
