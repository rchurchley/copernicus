# Copernicus

Copernicus is a [SASS](http://sass-lang.com) theme to bootstrap your way to a simple mobile-friendly website. Its colors are based on Ethan Schoonover's [Solarized](http://ethanschoonover.com/solarized) palette. Check out [the demo](https://cdn.rawgit.com/rchurchley/copernicus-scss/master/demo/index.html) to see it in action.


## Usage

Compiling Copernicus requires the [`sass`](http://sass-lang.com) and [`sass-globbing`](https://github.com/chriseppstein/sass-globbing) Ruby gems to be installed on your system.

First, make sure your webpage follows the structure illustrated in `demo/index.html`. Compile the main stylesheet with
```sh
sass -r sass-globbing main.scss
```
and add the resulting CSS to your project.


## Customization

The theme can be customized by adding SASS files to a new `local` directory outside this repository. Any styles in `../local/*` will be appended to the main Copernicus stylesheet.

The color scheme (among other things) can be customized by adding SASS files to a new `local/settings` folder outside this repository. Redefining any of the following variables in `../local/settings/*` will override the default options in `partials/_base.scss`.

Default fonts:
```sass
$body-font: "Avenir Next", sans-serif;
$code-font: Inconsolata, monospace;
```

Default font size:
```sass
$body-font-size: large;
```

"Greyscale" colour palette, used respectively for text, minor text, borders, body background, and content background:
```sass
$base-colors: #586e75, #657b83, #93a1a1, #eee8d5, #fdf6e3;
```

"Splash" colour palette, used respectively for a, a:hover, a:visited.
```sass
$splash-colors:  #b58900, #d33682, #073642;
```

The color of the header, menu, and headlines.
```sass
$header-text:     nth($base-colors, 5)   !default;
$header-color:    nth($splash-colors, 1) !default;
$menu-color:      nth($splash-colors, 3) !default;
$headline-color:  nth($splash-colors, 3) !default;
```

Maximum width of `main`
```sass
$max-width:  640px;
```

Breakpoint below which the mobile menu is used
```sass
$breakpoint: 640px;
```

The default margin after paragraphs and other elements
```sass
$parskip: 1.25rem;
```

The proportion of `main` to be used for each gutter
```sass
$gutter-fraction: 1/16;
```
