# svenluijten.com
This is the source code for [my personal website](https://svenluijten.com/). It is built with:

- [Jigsaw](https://github.com/tighten/jigsaw)
- [TailwindCSS](https://github.com/tailwindlabs/tailwindcss)
- [GitHub Actions](https://github.com/features/actions)
- [Vercel](https://vercel.com/)

## Extra functionality
In addition to how Jigsaw normally works, I've written 2 listeners to add some niceties to the codebase.

### Images next to built files
[The `\App\Listeners\ImagesNextToBuiltFiles` class](./app/Listeners/ImagesNextToBuiltFiles.php) ensures that images that
are shown on a page (eg. `/blog/example-blog-post`) are stored in the same folder as the post's `index.html` file. So
in case of that example, the images would be built into `/blog/example-blog-post/<image>`, next to `index.html`.

### Relative Markdown links
[The `\App\Listeners\RelativeMarkdownLinks` class](./app/Listeners/RelativeMarkdownLinks.php) makes it so that I can
link to other collection items by using their relative links (so something like `[link to post](./another-post.md)`).
This also works across collections, so I can `[link to another collection](../collectionB/post.md)`.

## Deployments
Deployments are handled by [this workflow](./.github/workflows/integrate.yml). When a commit is pushed onto `main`, that
branch will automatically be built using `jigsaw build production` and deployed onto Vercel. If anything happens to a
pull request (commit pushed, opened, rebased, ...), the workflow will deploy a preview build to Vercel which can be
seen from `https://preview-<PR NUMBER>.website.sven.luijten.dev`.

## Dependencies
Dependencies are automatically updated by [Dependabot](./.github/dependabot.yml). Every week it will create new pull
requests for dependencies that can be updated.
