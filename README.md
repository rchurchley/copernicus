# Copernicus

Copernicus is a [SASS](http://sass-lang.com) theme to bootstrap your way to a simple mobile-friendly website. Its colors are based on Ethan Schoonover's [Solarized](http://ethanschoonover.com/solarized) palette.

![](SCREENSHOT.png)

## Usage

First, make sure your webpage follows the structure illustrated in `TEMPLATE.html`. Compile the main stylesheet with 
```sh
sass --load-path local main.scss
```
and add the resulting CSS to your project.

## Customization

The color scheme (among other things) can be customized in `local/_settings.scss`. Any variables defined there will override the default options in `partials/_base.scss`. Similarly, site-specific classes and styles can be appended to the main stylesheet by adding them to `local/_styles.scss`.
