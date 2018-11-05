
Sass Reference
==========

Utilize our [*Sass Framework*](overview.md) files to take advantage of the following *functions*, *placeholders*, *mixins*, *variables* and *maps*.

## Base

### Elements

#### Mixins

* [`document-root`](mixin-document-root.md) :  
Mixin setting default 'Document root' properties.

* [`body`](mixin-body.md) :  
Mixin setting default 'Body' properties.

## Helpers

### General

#### Functions

* [`strip-units($val)`](function-strip-units.md) :  
Strips the units from a value.

#### Placeholders

* [`%clearfix-defaults`](placeholder-clearfix.md) :  
Float clearing default properties.

* [`%screen-reader-only-defaults`](placeholder-screen-reader-only.md) :  
Content to screen readers default properties.

* [`%screen-reader-only-focusable-defaults`](placeholder-screen-reader-only-focusable.md) :  
Focused content default properties.

#### Mixins

* [`clearfix($extend)`](mixin-clearfix.md) :  
Float clearing helper.

* [`visually-hidden($extend)`](mixin-visually-hidden.md) :  
Only display content to screen readers.

* [`focusable($extend)`](mixin-focusable.md) :  
Only display content when it's focused.

### Media

#### Mixins

* [`background($color, $image, $image-size, $image-path, $image-extension, $image-repeat, ...)`](mixin-background.md) :  
Mixin for background images with retina fallback.

### Color

#### Functions

* [`color($key)`](function-color.md) :  
Retreive a color from the "*All colors*" Sass map.

* [`theme-color($key)`](function-theme-color.md) :  
Retreive a color from the "*Theme colors*" Sass map.

* [`grayscale($key)`](function-grayscale.md) :  
Retreive a color from the "*Grayscales*" Sass map.

## Layout


### General

#### Functions

* [`breakpoint-next($name, $breakpoints, $breakpoint-names)`](function-breakpoint-next.md) :  
Retreive the name of the next breakpoint.

* [`breakpoint-min($name, $breakpoints)`](function-breakpoint-min.md) :  
Retreive the minimum breakpoint width.

* [`breakpoint-max($name, $breakpoints)`](function-breakpoint-max.md) :  
Retreive the maximum breakpoint width.

* [`breakpoint-infix($name, $breakpoints)`](function-breakpoint-infix.md) :  
Retreive a blank string if smallest (xsmall) breakpoint, otherwise returns the name with a dash infront.

#### Mixins

* [`breakpoint-up($name, $breakpoints)`](mixin-breakpoint-up.md) :  
Generate Media Query of at least the minimum breakpoint width.

* [`breakpoint-down($name, $breakpoints)`](mixin-breakpoint-down.md) :  
Generate Media Query of at most the maximum breakpoint width.

* [`breakpoint-between($lower, $upper, $breakpoints)`](mixin-breakpoint-between.md) :  
Generate Media Query that spans multiple breakpoint widths.

* [`breakpoint($name, $breakpoints)`](mixin-breakpoint.md) :  
Generate Media Query between the breakpoint's minimum and maximum widths.

### Arrangement

#### Mixins

* [`page-wrapper($wrapper-name)`](mixin-page-wrapper.md) :  
Mixin setting default 'Page wrappers' properties.

### Grid System

#### Placeholders

* [`%container-defaults`](placeholder-container.md) :  
Grid container default properties.

* [`%row-defaults`](placeholder-row.md) :  
Grid row default properties.

* [`%row-reset-defaults`](placeholder-row-reset.md) :  
Reset grid row default properties.

* [`%column-defaults`](placeholder-column.md) :  
Grid column default properties.

* [`%column-ready-defaults`](placeholder-column-ready.md) :  
Grid column (with paddings) default properties.

#### Mixins

* [`make-container($gutter)`](mixin-make-container.md) :  
Generate container width, and override it in media queries.

* [`make-container-max-widths($max-widths, $breakpoints)`](mixin-make-container-max-widths.md) :  
For each breakpoint, define the maximum width of the container in a media query.

* [`make-row($gutter)`](mixin-make-row.md) :  
Generate a row (wrapper) for a series of columns.

* [`make-column-ready($gutter)`](mixin-make-column-ready.md) :  
Make the element grid-ready (applying everything but the width).

* [`make-column($size, $columns)`](mixin-make-column.md) :  
Generate specific width that span multiple columns.

* [`make-column-offset($offset, $columns)`](mixin-make-column-offset.md) :  
Offsetting columns.

* [`make-column-order($order, $columns)`](mixin-make-column-order.md) :  
Reordering columns.

## Typography

### General

#### Mixins

* [`rem($property, $values, $root)`](mixin-rem.md) :  
Generate PX/REM value which is relative to the font-size defined for the html element.

## Variables

### Options

* [`$enable-grid-classes`](variable-enable-grid-classes.md) :  
Enable or disable the *Grid Sytem* classes

* [`$enable-extend-directive`](variable-enable-extend-directive.md) :  
Choose either to use the `@extend` or the `@include` Sass directive.

* [`$enable-retina-fallback`](variable-enable-retina-fallback.md) :  
Enable or disable the retina fallback for images.

* [`$enable-legacy-support-for-ie6`](variable-enable-legacy-support-for-ie6.md) :  
Enable or disable the browser support to Internet Explorer 6.

* [`$enable-legacy-support-for-ie7`](variable-enable-legacy-support-for-ie7.md) :  
Enable or disable the browser support to Internet Explorer 7.

* [`$enable-legacy-support-for-ie8`](variable-enable-legacy-support-for-ie8.md) :  
Enable or disable the browser support to Internet Explorer 8.

* [`$enable-legacy-support-for-ie9`](variable-enable-legacy-support-for-ie9.md) :  
Enable or disable the browser support to Internet Explorer 9.

* [`$enable-legacy-support-for-ie10`](variable-enable-legacy-support-for-ie10.md) :  
Enable or disable the browser support to Internet Explorer 10.

* [`$enable-legacy-support-for-ie11`](variable-enable-legacy-support-for-ie11.md) :  
Enable or disable the browser support to Internet Explorer 11.

### Kiso's default palette

* [`$colors`](variable-colors.md) :  
Map of color scheme

* [`$theme-colors`](variable-theme-colors.md) :  
Map of theme color scheme

* [`$grays`](variable-grays.md) :  
Map of grayscales

### Base rules

* [`$root-font-family`](variable-root-font-family.md) :  
Font family of the document root.

* [`$font-family-sans-serif`](variable-font-family-sans-serif.md) :  
Sans-serif font family.

* [`$font-family-monospace`](variable-font-family-monospace.md) :  
Monospace font family.

* [`$body-base-color`](variable-body-base-color.md) :  
The base text color applied on the document body.

* [`$body-base-background-color`](variable-body-base-background-color.md) :  
The base background color applied on the document body.

* [`$body-base-font-family`](variable-body-base-font-family.md) :  
The base font family applied on the document body.

* [`$body-base-font-size`](variable-body-base-font-size.md) :  
The base font size applied on the document body.

* [`$body-base-font-weight`](variable-body-base-font-weight.md) :  
The base font weight applied on the document body.

* [`$body-base-line-height`](variable-body-base-line-height.md) :  
The base text line height applied on the document body.

* [`$image-folder-path`](variable-image-folder-path.md) :  
The default path to the image folder.

* [`$image-fallback-extension`](variable-image-fallback-extension.md) :  
The default file extension for images.

* [`$image-retina-media-query`](variable-image-retina-media-query.md) :  
The retina display media query string.

* [`$image-retina-suffix`](variable-image-retina-suffix.md) :  
The default suffix for images with retina fallback.

### Layout rules

* [`$grid-breakpoints`](variable-grid-breakpoints.md) :  
Map of breakpoints for responsive design.

* [`$container-max-widths`](variable-container-max-widths.md) :  
Map of the `.container` maximum widths for different screen sizes.

* [`$grid-columns`](variable-grid-columns.md) :  
The number of columns of the *Grid System*.

* [`$grid-gutter-width`](variable-grid-gutter-width.md) :  
The width of the gutters between each *Grid System* columns.

* [`$page-wrappers-padding`](variable-page-wrappers-padding.md) :  
Page wrappers paddings rhythm.

* [`$page-wrappers-backgrounds`](variable-page-wrappers-backgrounds.md) :  
Map of the page wrappers backgrounds properties.