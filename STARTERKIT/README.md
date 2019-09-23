
Getting Started
==========

## Installation

 1. Install the ***Drupal Kiso (基礎)*** base theme in `./themes/contrib` or a similar `./sites/*/themes/contrib` directory.
 2. Navigate to `admin/appearance` and click the `Enable and set default` link next to the ***Kiso (基礎)*** theme title.

## Sub-Theming

Below are instructions on how to create a ***Drupal Kiso (基礎)*** based sub-theme. There are several different variations on how to accomplish this task, but this topic will focus on the primarily and most common way.

> **WARNING:** You should never modify any file that is packaged in the ***Drupal Kiso (基礎)*** base theme. If you do, all changes you have made will be lost once that theme is updated. Instead, you should create a subtheme using the provided *STARTERKIT* (this is considered a best practice). Once you've done that, you can remove/extend/override CSS, override templates and theme processing.

The *STARTERKIT* provided by the ***Drupal Kiso (基礎)*** base-theme supplies the basic file structure on how to construct a proper ***Drupal Kiso (基礎)*** based sub-theme for use with your own *Sass framework and source files*.

By default, the *STARTERKIT* is designed to be used with the [***Kiso (基礎)*** Framework SASS Source Files](https://github.com/smillart/Framework-SASS-Source-Files) for quick setup regarding the CSS's remove/extend/override coming from the ***Drupal Kiso (基礎)*** base-theme. While there are a multitude of different approaches on how to actually compile your *Sass framework and source files*, this *STARTERKIT* does not and will not provide anymore specific *Sass framework* to use with. It is up to you, the front-end developer, to figure out which solution is best for your particular needs.

> **NOTE:** Using the ***Kiso (基礎) Framework SASS Source Files*** is the preferred method for loading CSS for your site. There are advantages and disadvantages to using it and you will need to weigh the benefits based on your site's own requirements. Using the ***Kiso (基礎) Framework SASS Source Files*** does mean that it depends on a third-party service. There is no obligation or commitment made by the ***Drupal Kiso (基礎)*** project to use this *Sass framework*.

1.  Copy the `./themes/contrib/kiso/STARTERKIT` directory into the `./themes/custom` directory.
2.  Rename the directory to a unique machine readable name. This is your sub-theme's "*machine name*". When referring to files inside a sub-theme, they will always start with `./THEMENAME/`, where `THEMENAME` is the machine name of your sub-theme. They will continue to specify the full path to the file or directory inside it. For example, the primary file Drupal uses to determine if a theme exists is: `./THEMENAME/THEMENAME.info.yml`.
3.  Rename `./THEMENAME/THEMENAME.starterkit.yml` to match `./THEMENAME/THEMENAME.info.yml`.
4.  Rename `./THEMENAME/THEMENAME.libraries.yml`
5.  Rename `./THEMENAME/THEMENAME.theme`.
6.  Open `./THEMENAME/THEMENAME.info.yml` and change the name, description and any other properties to suite your needs.
7.  Rename the sub-theme configuration files, located at: `./THEMENAME/config/install/THEMENAME.settings.yml` and `./THEMENAME/config/schema/THEMENAME.schema.yml`.
8.  Open `./THEMENAME/config/schema/THEMENAME.schema.yml` and rename `- THEMENAME.settings:` and `'THEMETITLE settings'`

> **WARNING:** Ensure that the `.starterkit` suffix is not present on your sub-theme's `.info.yml` filename. This suffix is simply a stop gap measure to ensure that the bundled starter kit sub-theme cannot be enabled or used directly. This helps people unfamiliar with Drupal avoid modifying the starter kit sub-theme directly and instead forces them to create a new sub-theme to modify.

### Enable Your New Sub-theme

In your Drupal site, navigate to `admin/appearance` and click the `Enable and set default` link next to your newly created sub-theme. Now that you've enabled your starterkit, please refer to the [*Stylesheets (Baseline)*](https://github.com/openfed/kiso/tree/master/scss/README.md) page to customize.