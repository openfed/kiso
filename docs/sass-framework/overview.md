
Sass Framework
==========

## Reboot

The *Drupal “Kiso” (基礎) base theme* provides a collection of element-specific CSS changes in an unchangeable file. Extending Normalize, this "*Reboot*" builds upon best practices to provide an elegant, consistent, and simple baseline to start theming.

Here are some guidelines and reasons for choosing what to override in the "*Reboot*" file:

 - Avoid `margin-top`. Vertical margins can collapse, yielding unexpected results. More importantly though, a single direction of `margin` is a simpler mental model.
 - Keep declarations of `font`-related properties to a minimum, using `inherit` whenever possible.
 - The `box-sizing` is globally set on every element—including `*::before` and `*::after`, to `border-box`. This ensures that the declared width of element is never exceeded due to padding or border.
 - The `<body>` also sets a global `text-align`. This is inherited later by data tables and some form elements to prevent inconsistencies.

## Sass

The *Sass Framework* theming is accomplished by **Sass variables, Sass maps, and utility CSS**. There’s no dedicated "make up" theming; instead, you can enable built-in Sass variables options to add gradients, shadows, and more.

The *Sass Framework* is **components-oriented**. It means that those should be abstract and decoupled enough that you can build new components quickly from existing parts without having to recode patterns. As new components and features are needed, it should be easy to add, modify and extend CSS without breaking (or refactoring) styles from the existing framework.

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
│   ├── placeholders/
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

In your `_imports.scss`, you will import *Sass Framework* source Sass files. You have two options: Include the full import stack (*A*), or pick the parts you need (*B*). We encourage option *A*, because your have to be aware there are some requirements and dependencies across our components.

```scss
// _imports.scss
// Option A: Include all of the 'Sass Framwork' source files

@import '../../_sass-framework/include-all';
```

```scss
// _imports.scss
// Option B: Include parts of the 'Sass Framwork' you need

@import '../../_sass-framework/functions/helpers/general';
@import '../../_sass-framework/variables/options';
@import '../../_sass-framework/variables/colors';
@import '../../_sass-framework/variables/base';
@import '../../_sass-framework/mixins/typography/general';
```

With that setup in place, you can begin to override any of the Sass variables and maps in your `_variable-overrides.scss`.

### Variable and map defaults

Every Sass variable and map in the *Sass Framework* includes the `!default` flag allowing you to override the default value in your `_variable-overrides.scss` file without modifying the *Sass Framework* source code. Copy and paste variables or maps as needed, modify their values, and remove the `!default` flag. If a variable has already been assigned, then it won’t be re-assigned by the default values in the *Sass Framework*.

You will find the complete list of the *Sass Framework* variables and maps in the `_sass-framework/variables/` folder and in the [**Sass reference**](index.md) including the entire *variables, maps, mixins, functions and placeholders SassDoc*.

Variable or map overrides (within `_variable-overrides.scss`) must come before you import the *Sass Framework* source Sass files (within `_imports.scss`).

Here’s an example that changes the `background-color` and `color` for the `<body>`:

```scss
// _variable-overrides.scss
// Both variable overrides for the 'background-color' and 'color' CSS properties:
$body-base-color: $gray-900; // #212529
$body-base-background-color: $gray-100; // #f8f9fa
```

```scss
// _imports.scss
// Your own variable overrides defined here above:
@import 'variable-overrides';
// The 'Sass Framework' and its default variables:
@import '../../_sass-framework/include-all';
```

To modify existing colors and/or add new ones in the `$theme-colors` map, add the following to your `_variable-overrides.scss` file:

```scss
// _variable-overrides.scss
// Override default 'Kiso' colors:
$red: #d13416;
$green: #48782b;
$cyan: #0372d1;
$orange: #c34c09;
// Add your own colors:
$midnight: #0f5153;
$sap: #48782b;
$violet: #c0057a;

// Your overrides and new colors for the "Theme color scheme" map:
$theme-colors: (
  'primary': $midnight,
  'energy': $sap,
  'intellectual-property': $violet,
);
```

To remove colors from `$theme-colors`, or any other map, use the `map-remove` *Sass Script function* (within separate file `_map-removals.scss` for example) . Be aware you must insert it after you import *Sass Framework* source Sass files: 

```scss
// _map-removals.scss
// Remove "info", "light" and "dark" (key/value) from the "Theme color scheme" map:
$theme-colors: map-remove($theme-colors, 'info', 'light', 'dark');
```

```scss
// _imports.scss
// The 'Sass Framework' and its default variables
@import '../../_sass-framework/include-all';
// Your map removals defined here above:
@import 'map-removals';
```

#### Required keys

The *Sass Framework* assumes the presence of some specific keys within Sass maps as we used and extend these ourselves. As you customize the included maps, you may encounter errors where a specific Sass map’s key is being used.

For example, The *Sass Framework* uses the `primary`, `success`, and `danger` keys from `$theme-colors` for links, buttons, and form states. Replacing the values of these keys should present no issues, but removing them may cause Sass compilation issues.

### Recompile

When making any overrides to the *Sass Framework* variables, you will need to save your changes and recompile the entire Sass files. Doing so will output a brand new set of predefined look and feel. Make sure to output to the proper CSS file path:

```
sass compile scss/base/*.scss > css/components/*.css
sass compile scss/layout/*.scss > css/layout/*.css
sass compile scss/components/*.scss > css/components/*.css
sass compile scss/theme/*.scss > css/theme/*.css
```

After recompiling, you will automatically see your changes reflected in the CSS file... If everything went well ;-)