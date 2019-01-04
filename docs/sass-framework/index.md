
Sass Reference
==========

Utilize our [*Sass Framework*](overview.md) files to take advantage of the following *functions*, *placeholders*, *mixins*, *variables* and *maps*.

## Helpers

### General

#### Functions

* [`contains-number($values)`](function-contains-number.md) :  
Checks if a list contains a number(s).

* [`strip-units($value)`](function-strip-units.md) :  
Strips the units from a value.

#### Placeholders

* [`%clearfix-defaults`](placeholder-clearfix-defaults.md) :  
Float clearing default properties.

* [`%screen-reader-only-defaults`](placeholder-screen-reader-only-defaults.md) :  
Content to screen readers default properties.

* [`%screen-reader-only-focusable-defaults`](placeholder-screen-reader-only-focusable-defaults.md) :  
Focused content default properties.

#### Mixins

* [`clearfix($extend)`](mixin-clearfix.md) :  
Float clearing helper.

* [`visually-hidden($extend)`](mixin-visually-hidden.md) :  
Only display content to screen readers.

* [`focusable($extend)`](mixin-focusable.md) :  
Only display content when it's focused.

### Color

#### Functions

* `color($key)` :  
Retreive a color from the "*All colors*" Sass map.

* `theme-color($key)` :  
Retreive a color from the "*Theme colors*" Sass map.

* `grayscale($key)` :  
Retreive a color from the "*Grayscales*" Sass map.

### Media

#### Mixins

* `background($color, $image, $image-size, $image-path, $image-extension, $image-repeat, ...)` :  
Mixin for background images with retina fallback.

### Support

#### Mixins

* `properties($declarations)` :  
Mixin to print couple of property/value which are stored in a Sass map.

## Layout

### General

#### Functions

* `breakpoint-next($name, $breakpoints, $breakpoint-names)` :  
Retreive the name of the next breakpoint.

* `breakpoint-min($name, $breakpoints)` :  
Retreive the minimum breakpoint width.

* `breakpoint-max($name, $breakpoints)` :  
Retreive the maximum breakpoint width.

* `breakpoint-infix($name, $breakpoints)` :  
Retreive a blank string if smallest (xsmall) breakpoint, otherwise returns the name with a dash infront.

#### Mixins

* `breakpoint-up($name, $breakpoints)` :  
Generate Media Query of at least the minimum breakpoint width.

* `breakpoint-down($name, $breakpoints)` :  
Generate Media Query of at most the maximum breakpoint width.

* `breakpoint-between($lower, $upper, $breakpoints)` :  
Generate Media Query that spans multiple breakpoint widths.

* `breakpoint($name, $breakpoints)` :  
Generate Media Query between the breakpoint's minimum and maximum widths.

* `flex($aligns, $flow)` :  
Quickly manage the layout, alignment of navigation, components, and more with a full suite of flexbox utilities.

### Grid System

#### Placeholders

* `%container-defaults` :  
Grid container default properties.

* `%row-defaults` :  
Grid row default properties.

* `%row-reset-defaults` :  
Reset grid row default properties.

* `%column-defaults` :  
Grid column default properties.

* `%column-ready-defaults` :  
Grid column (with paddings) default properties.

#### Mixins

* `make-container($gutter)` :  
Generate container width, and override it in media queries.

* `make-container-max-widths($max-widths, $breakpoints)` :  
For each breakpoint, define the maximum width of the container in a media query.

* `make-row($gutter)` :  
Generate a row (wrapper) for a series of columns.

* `make-column-ready($gutter)` :  
Make the element grid-ready (applying everything but the width).

* `make-column($size, $columns)` :  
Generate specific width that span multiple columns.

* `make-column-offset($offset, $columns)` :  
Move columns to the right by increasing the left margin of a column by * columns.

* `make-column-order($order, $columns)` :  
Easily control the visual order of your columns.

## Library

### General

#### Mixins

* `list-variant($style, $unstyled-padding-left, $inline-item-vertical-align, $inline-item-margin-left)` :  
Easily set out variant styles for all kind of lists.

* `paragraph-variant($style, $lead-font-size, $lead-font-weight)` :  
Easily set out variant styles for all paragraphs.

* `table-variant($style, $striped-background-color, $hover-background-color)` :  
Easily set out variant styles for all tables.

## Typography

### General

#### Mixins

* `rem($property, $values, $root)` :  
Generate PX/REM value which is relative to the font-size defined for the html element.

## Variables

### Options

* `$enable-grid-classes` :  
Enable or disable the *Grid Sytem* classes

* `$enable-extend-directive` :  
Choose either to use the `@extend` or the `@include` Sass directive.

* `$enable-retina-fallback` :  
Enable or disable the retina fallback for images.

* `$enable-legacy-support-for-ie6` :  
Enable or disable the browser support to Internet Explorer 6.

* `$enable-legacy-support-for-ie7` :  
Enable or disable the browser support to Internet Explorer 7.

* `$enable-legacy-support-for-ie8` :  
Enable or disable the browser support to Internet Explorer 8.

* `$enable-legacy-support-for-ie9` :  
Enable or disable the browser support to Internet Explorer 9.

* `$enable-legacy-support-for-ie10` :  
Enable or disable the browser support to Internet Explorer 10.

* `$enable-legacy-support-for-ie11` :  
Enable or disable the browser support to Internet Explorer 11.

### Kiso's default palette

* `$colors` :  
Map of color scheme

* `$theme-colors` :  
Map of theme color scheme

* `$grays` :  
Map of grayscales

### Base rule variables

* `$font-family-sans-serif` :  
Sans-serif font family.

* `$font-family-monospace` :  
Monospace font family.

* `$body-base-color` :  
The base text color applied on the document body.

* `$body-base-background-color` :  
The base background color applied on the document body.

* `$body-base-font-family` :  
The base font family applied on the document body.

* `$body-base-font-size` :  
The base font size applied on the document body.

* `$body-base-font-weight` :  
The base font weight applied on the document body.

* `$body-base-line-height` :  
The base text line height applied on the document body.

* `$heading-[1-6]-font-size` :  
The default font sizes applied on each heading type.

* `$image-folder-path` :  
The default path to the image folder.

* `$image-fallback-extension` :  
The default file extension for images.

* `$image-retina-media-query` :  
The retina display media query string.

* `$image-retina-suffix` :  
The default suffix for images with retina fallback.

### Layout & Grid system variables

* `$grid-breakpoints` :  
Map of breakpoints for responsive design.

* `$container-max-widths` :  
Map of the `.container` maximum widths for different screen sizes.

* `$grid-columns` :  
The number of columns of the *Grid System*.

* `$grid-gutter-width` :  
The width of the gutters between each *Grid System* columns.

### Components rule variables

* `$component-vertical-paddings` :  
Map of common vertical padding sizes used by the components.

* `$component-horizontal-paddings` :  
Map of common horizontal padding sizes used by the components.

* `$component-margins` :  
Map of common margin sizes used by the components.

* `$component-border-width` :  
The common border width used by the components.

* `$component-border-style` :  
The common border style used by the components.

* `$component-border-colors` :  
Map of common border color brightnesses used by the components.

* `$component-border-radiuses` :  
Map of common border radius sizes used by the components.

* `$component-font-weights` :  
Map of common font thicknesses used by the components.

* `$component-state-colors` :  
Map of common text color states used by the components.

* `$component-state-background-colors` :  
Map of common background color states used by the components.

* `$component-box-shadows` :  
Map of common box shadow lengths used by the components.