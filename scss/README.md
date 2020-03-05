
Stylesheets (Baseline)
==========

The default look and feel of the ***Drupal Kiso (基礎)*** base theme is mostly generated from stylesheets (native) located through out the project's `css/` folder. ***Drupal Kiso (基礎)*** base theme uses the [SMACSS](http://smacss.com/book/) system to conceptually categorize CSS rules. These categories help the front-end developers of the ***Drupal Kiso (基礎)*** base theme keep CSS styles with different purposes from getting intertwined with one another.

## Standards and Guidelines

To minimize friction when contributing, the front-end developers of the ***Drupal Kiso (基礎)*** base theme have reached consensus about coding standards for formatting Sass code ([Guidelines](https://sass-guidelin.es) & [Style Guide](https://css-tricks.com/sass-style-guide/)), file [architecture](https://www.drupal.org/docs/develop/standards/css/css-architecture-for-drupal-8) and  [organization](https://www.drupal.org/docs/develop/standards/css/css-file-organization-for-drupal-8).

## Reboot

The ***Drupal Kiso (基礎)*** base theme provides a collection of element-specific CSS changes in an unchangeable file. Extending [Normalize](https://necolas.github.io/normalize.css/) (previously loaded), this "*Reboot*" builds upon best practices to provide an elegant, consistent, and simple baseline to start theming.

Here are some guidelines and reasons for choosing what to override in the "*Reboot*" file:

 - Avoid `margin-top`. Vertical margins can collapse, yielding unexpected results. More importantly though, a single direction of `margin` is a simpler mental model.
 - Keep declarations of `font`-related properties to a minimum, using `inherit` whenever possible.
 - The `box-sizing` is globally set on every element—including `*::before` and `*::after`, to `border-box`. This ensures that the declared width of element is never exceeded due to padding or border.
 - The `<body>` also sets a global `text-align`. This is inherited later by data tables and some form elements to prevent inconsistencies. 

## Separate Concerns

### Elements

Where the "*Reboot*" purpose is to define a consistent foundation across browsers to build the site on, the base rules also consist of styling *HTML elements* using their own element selector, a descendant selector, or a child selector, along with any pseudo-classes. To avoid "undoing" styles in components, *elements* styles should reflect the simplest possible appearance of each element.

### Layout and Grid System

The ***Drupal Kiso (基礎)*** base theme includes, out of the box, a [powerful mobile-first *Flexbox* grid](layout/README.md) to build layouts (Wrappers and Sections) of all shapes and sizes using a twelve column system and five responsive tiers. *Grid systems* should be thought of as shelves. They contain content but are not content in themselves. You put up your shelves then fill them with your stuff [i.e. *Components*].

### Components

Each [templates](../templates/) have their own *component* styles. *Components* are reusable, discrete UI elements. *Components* should be abstract and decoupled enough that you can build new *components* quickly from existing parts without having to recode patterns and problems you’ve already solved.

## Overriding and extending libraries

All libraries (including assets) can be removed/extended or overridden. You must go to your `./THEMENAME/THEMENAME.info.yml` file to override libraries defined in `./kiso/kiso.libraries.yml`. They can be either removed, overridden or extended using `libraries-override` or `libraries-extend`.

**The logic you will need to use when creating overrides is:**

1.  Use the original ***Drupal Kiso (基礎)*** base theme namespace for the library name.
2.  Use the path of the most recent override as the key.
3.  That path should be the full path to the file.

**For example:**

```yml
libraries-override:
  kiso/elements:
    css:
      base:
        css/base/elements/code.css: false
```

Here `kiso/elements` is the namespace of the library and `css/base/elements/code.css:` is the full path to the most recent override of that library. In this case the file has been overridden (removed) with`false`.

Here are a few other ways to use `libraries-override` to remove or replace CSS or Javascript assets or entire libraries your theme has inherited from the ***Drupal Kiso (基礎)*** base theme.

```yml
libraries-override:
  # Replace an entire library.
  kiso/layout: THEMENANE/layout
  
  # Replace assets with others.
  kiso/navigations:
    css:
      component:
        css/components/navigation/breadcrumb.css: css/components/navigation/my-breadcrumb.css
        css/components/navigation/tabs.css: css/components/navigation/my-tabs.css

  # Remove an asset.
  kiso/elements:
    css:
      base:
        css/base/elements/code.css: false
  
  # Remove an entire library.
  kiso/links--language-block: false
```

`libraries-extend` provides a way for themes to alter the assets of a library by adding in additional theme-dependent library assets whenever a library is attached.  `libraries-extend` are specified by extending a library with any number of other libraries. This is perfect for styling certain components differently in your theme. I.e. to customize the look of a component without having to load the CSS to do so on every page.

```yml
# Extend kiso/messages: add assets from your 'THEMENAME/status-messages' library.
libraries-extend:
  kiso/messages: 
    - THEMENAME/status-messages
```