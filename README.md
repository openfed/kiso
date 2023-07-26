

Drupal "Kiso" (基礎) base theme
==========

![GitHub updated](https://img.shields.io/badge/Last%20updated-July%2011,%202026-405b77.svg)
[![Drupal compatibility](https://img.shields.io/badge/Drupal%20compatibility-9.x|10.x-405b77.svg)](kiso.info.yml)
[![GitHub release](https://img.shields.io/badge/Release-3.0.1-405b77.svg)](https://github.com/openfed/kiso/releases/tag/3.0.1)

> **Note**
> This *Kiso* release (3.0) is compatible with **Drupal 10**.

> *Kiso* is a brand new base theme completely build from scratch. *Kiso* theme is fully built around and adapted to Drupal 9/10, with a strong focus on *accessibility*, *portability*, *simplicity* and *efficiency*.

## Topics

* [Getting started](docs/getting-started.md)
* [Theme settings](docs/theme-settings.md)
* [Stylesheets (Baseline)](scss/README.md)
* [Sass framework](https://github.com/smillart/Framework-SASS-Source-Files)
* [Templates](templates/)
* [Accessibility](docs/accessibility.md)

## About Kiso

**In a nutshell:**

 1. *Kiso* rewrites [Templates](templates/) from *Drupal* core only if it makes sense to do so, in order to meet specific requirements;
 2. *Kiso* is built with [Accessibility](docs/accessibility.md) and [CSS coding standards for Drupal](https://www.drupal.org/docs/develop/standards/css/css-coding-standards) in mind;
 3. *Kiso* use a mobile-first [Flexbox grid system](scss/layout/README.md) to build layouts of all shapes and sizes thanks to a twelve column system, five default responsive tiers, Sass variables and mixins, and dozens of predefined classes;
 4. *Kiso* [Stylesheets (Baseline)](scss/README.md) is based on the [Drupal 9's CSS (file) organization](https://www.drupal.org/docs/develop/standards/css/css-file-organization-for-drupal-9), [SMACSS](https://smacss.com/ "Scalable and Modular Architecture for CSS") & [BEM](http://bem.info/ "Block, Element, Modifier").

## Browser Support

*Kiso* supports the **latest, stable releases** of all major browsers and platforms. On Windows, **Kiso supports Internet Explorer 11 / Microsoft Edge**. ([Although Internet Explorer 11 support dropped in Drupal 10](https://www.drupal.org/node/3199540))

*Kiso* implemented a time saving tool for developers. With this solution you can check if the user’s _Microsoft_ browser can handle your website. If not, it will show a looking notice advising the user to update his browser for latest versions.

Alternative browsers which use the latest version of WebKit, Blink, or Gecko, whether directly or via the platform’s web view API, are not explicitly supported. However, Kiso should (in most cases) display and function correctly in these browsers as well.
