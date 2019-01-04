
Getting Started
==========

## Installation

Install the *Drupal "Kiso" (基礎) base theme* in `themes/contrib` or a similar `sites/*/themes/contrib` directory.

## Sass Framework

Generally speaking, you should really read the entire [*Sass Framework* documentation](../sass-framework/overview.md), if you haven't already.

## Sub-Theming

Below are instructions on how to create a *Drupal "Kiso" (基礎)* based sub-theme. There are several different variations on how to accomplish this task, but this topic will focus on the primarily and most common way.

> **WARNING:** You should never modify any file that is packaged in the *Drupal "Kiso" (基礎) base theme*. If you do, all changes you have made will be lost once that theme is updated. Instead, you should create a subtheme using the provided *STARTERKIT* (this is considered a best practice). Once you've done that, you can override CSS, templates, and theme processing.

1.  Copy the `./kiso/STARTERKIT` directory into the `themes/custom` directory.
2.  Rename the directory to a unique machine readable name. This is your sub-theme's "*machine name*". When referring to files inside a sub-theme, they will always start with `./THEMENAME/`, where `THEMENAME` is the machine name of your sub-theme. They will continue to specify the full path to the file or directory inside it. For example, the primary file Drupal uses to determine if a theme exists is: `./THEMENAME/THEMENAME.info.yml`.
3.  Rename `./THEMENAME/THEMENAME.starterkit.yml` to match `./THEMENAME/THEMENAME.info.yml`.
4.  Rename `./THEMENAME/THEMENAME.libraries.yml`
5.  Rename `./THEMENAME/THEMENAME.theme`.
6.  Open `./THEMENAME/THEMENAME.info.yml` and change the name, description and any other properties to suite your needs. Make sure to rename the library extension name as well: `THEMENAME/framework`.
7.  Rename the sub-theme configuration files, located at: `./THEMENAME/config/install/THEMENAME.settings.yml` and `./THEMENAME/config/schema/THEMENAME.schema.yml`.
8.  Open `./THEMENAME/config/schema/THEMENAME.schema.yml` and rename `- THEMENAME.settings:` and `'THEMETITLE settings'`

> **WARNING:** Ensure that the `.starterkit` suffix is not present on your sub-theme's `.info.yml` filename. This suffix is simply a stop gap measure to ensure that the bundled starter kit sub-theme cannot be enabled or used directly. This helps people unfamiliar with Drupal avoid modifying the starter kit sub-theme directly and instead forces them to create a new sub-theme to modify.

### Enable Your New Sub-theme

In your Drupal site, navigate to `admin/appearance` and click the `Enable and set default` link next to your newly created sub-theme. Now that you've enabled your starterkit, please refer to the [*Sass Framework* documentation](../sass-framework/overview.md) page to customize.
