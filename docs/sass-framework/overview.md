
Sass Framework
==========

The *Sass Framework* theming is accomplished by **Sass variables, Sass maps, and utility CSS**. There’s no dedicated "make up" theming; instead, you can enable built-in Sass variables options to add gradients, shadows, and more.

The *Sass Framework* is **components-oriented**. It means that those should be abstract and decoupled enough that you can build new components quickly from existing parts without having to recode patterns. As new components and features are needed, it should be easy to add, modify and extend CSS without breaking (or refactoring) styles from the existing framework.


## Sass

Utilize our *Sass Framework* files to [**take advantage of variables, maps, mixins and more**](index.md).

### Standards and Guidelines

To minimize friction when contributing, the front-end developers of the *Drupal "Kiso" (基礎) base theme* have reached consensus about coding standards for formatting Sass code ([Guidelines](https://sass-guidelin.es) & [Style Guide](https://css-tricks.com/sass-style-guide/)), file [architecture](https://www.drupal.org/docs/develop/standards/css/css-architecture-for-drupal-8) and  [organization](https://www.drupal.org/docs/develop/standards/css/css-file-organization-for-drupal-8).

### Sass files structure *(within your sub-theme folder)*

Whenever possible, avoid modifying the *Sass Framework* (*functions, mixins and variables* within the `_sass-framework` folder) source files. For Sass, that means creating your own stylesheets that import the *Sass Framework* source files so you can modify and/or extend it. The Sass files structure, within your sub-theme folder, should look like this, keeping *Sass Framework* source files separate from your own:

```plaintext
your-sub-theme-folder/
├── _sass-framework
│   ├── functions/
│   ├── mixins/
│   ├── variables/
│   └── _include-all.scss
└── scss/
    ├── base
    ├── components
    ├── config
    │   ├── _imports.scss
    │   └── _variable-overrides.scss
    ├── layout
    └── theme
```

### Importing

In your `_imports.scss`, you will import *Sass Framework* source Sass files. You have two options: include the full import stack, or pick the parts you need. We encourage option A, because your have to be aware there are some requirements and dependencies across our components.

```scss
// _imports.scss
// Option A: Include all of the 'Sass Framwork'

@import '../../_sass-framework/include-all';
```

```scss
// _imports.scss
// Option B: Include parts of the 'Sass Framwork'

@import '../../_sass-framework/functions/helpers/general';
@import '../../_sass-framework/variables/options';
@import '../../_sass-framework/variables/colors';
@import '../../_sass-framework/variables/base';
@import '../../_sass-framework/mixins/typography/general';
```

With that setup in place, you can begin to modify any of the Sass variables and maps in your `_variable-overrides.scss`.

### Variable and map defaults

Every Sass variable and map in the *Sass Framework* includes the `!default` flag allowing you to override the default value in your `_variable-overrides.scss` file without modifying the *Sass Framework* source code. Copy and paste variables or maps as needed, modify their values, and remove the `!default` flag. If a variable has already been assigned, then it won’t be re-assigned by the default values in the *Sass Framework*.

You will find the complete list of the *Sass Framework* variables and maps in the `_sass-framework/variables/` folder and in the [**Sass reference**](index.md) including the entire *variables, maps, mixins, functions and placeholders SassDoc*.

Variable or map overrides (within `_variable-overrides.scss`) must come before you import the *Sass Framework* source Sass files (within `_imports.scss`).

Here’s an example that changes the `background-color` and `color` for the `<body>`:

```scss
// _variable-overrides.scss
// Both variable overrides for the 'background-color' and 'color' CSS properties:
$body-base-color: #111;
$body-base-background-color: #ccc;

// _imports.scss
// The 'Sass Framework' and its default variables:
@import '../../_sass-framework/include-all';
```

To modify an existing color in our `$theme-colors` map, add the following to your `_variable-overrides.scss` file:

```scss
// _variable-overrides.scss
// Your overrides for the "Theme color scheme" map:
$theme-colors: (
  'primary': #0074d9,
  'danger': #ff4136,
);
```

To add a new color to `$theme-colors`, add the new key and value as followed:

```scss
// _variable-overrides.scss
// Your new color for the "Theme color scheme" map:
$theme-colors: (
  'custom-color': #900,
);
```

To remove colors from `$theme-colors`, or any other map, use `map-remove`. Be aware you must insert it after you import *Sass Framework* source Sass files:

```scss
// _imports.scss
// The 'Sass Framework' and its default variables
@import '../../_sass-framework/include-all';

// Remove "info", "light" and "dark" (key/value) the "Theme color scheme" map:
$theme-colors: map-remove($theme-colors, "info", "light", "dark");
```

#### Required keys

The *Sass Framework* assumes the presence of some specific keys within Sass maps as we used and extend these ourselves. As you customize the included maps, you may encounter errors where a specific Sass map’s key is being used.

For example, The *Sass Framework* uses the `primary`, `success`, and `danger` keys from `$theme-colors` for links, buttons, and form states. Replacing the values of these keys should present no issues, but removing them may cause Sass compilation issues.

### Recompile

When making any changes to the *Sass Framework* variables, you will need to save your changes and recompile the entire Sass files. Doing so will output a brand new set of predefined look and feel. Make sure to output to the proper CSS file path:

```
sass compile scss/base/*.scss > css/components/*.css
sass compile scss/layout/*.scss > css/layout/*.css
sass compile scss/components/*.scss > css/components/*.css
sass compile scss/theme/*.scss > css/theme/*.css
```

After recompiling, you will automatically see your changes reflected in the CSS file... If everything went well ;-)