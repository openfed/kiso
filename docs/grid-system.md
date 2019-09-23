
Grid System
==========

## Overview

***Drupal "Kiso" (基礎)*** grid system uses a series of containers, rows, and columns to layout and align content. It’s built with [Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/) and is fully responsive. The flex grid works very similarly to the standard float grid, but includes a number of useful features only possible with *Flexbox*, like horizontal and vertical alignment, automatic sizing, and easier source ordering.

### Responsiveness

Since ***Drupal "Kiso" (基礎)*** is developed to be mobile first, we use a handful of *media queries* to create sensible *breakpoints* for our layouts and interfaces. These *breakpoints* are mostly based on minimum viewport widths and allow us to scale up elements as the viewport changes.

***Drupal "Kiso" (基礎)*** primarily uses the following *breakpoints* in the source [Sass](https://sass-lang.com/) files for the grid system.

```scss
$grid-breakpoints: (
  // Extra small devices (Portrait phones, less than 576px)
  xsmall: 0,
  // Small devices (Landscape phones, 576px and up)
  small:  576px,
  // Medium devices (Tablets, 768px and up)
  medium: 768px,
  // Large devices (Desktops, 992px and up)
  large:  992px,
  // Extra large devices (Large desktops, 1200px and up)
  xlarge: 1230px,
) !default;
```

**Note:** While ***Drupal "Kiso" (基礎)*** uses `rem`s for defining most sizes, `px`s are used for breakpoints. This is because the viewport width is in pixels and does not change with the increase of the [font size](https://drafts.csswg.org/mediaqueries-3/#units).

### Browser support

The *Flexbox* grid is only supported in Chrome, Firefox, Safari 6+, Internet Explorer 10+, iOS 7+, and Android 4.4+. Flexbox is supported in Android 2, but not reliably enough for use with this grid. ([View flexbox browser support.](https://caniuse.com/#feat=flexbox))

## Containers

Containers are the most basic layout element and are **required when using the grid system**. Choose from a responsive, fixed-width container (meaning its `max-width` changes at each breakpoint).

```html
<div class="container">
  <!-- Content here -->
</div>
```

Or fluid-width (meaning it’s `100%` wide spanning the entire width of the viewport).

```html
<div class="container-fluid">
  <!-- Content here -->
</div>
```

## Auto-layout columns

### Equal-width

Rows use the `.row` class, and columns use the default `.column` class for equal-width column sizing (*without any explicit numbered class*). These columns will be the same from the smallest of devices to the largest. (See the [Responsive layout](#responsive-layout) section for responsiveness.)

```html
<div class="container">
  <div class="row">
    <div class="column">
      1 of 3 (equal-width)
    </div>
    <div class="column">
      2 of 3 (equal-width)
    </div>
    <div class="column">
      3 of 3 (equal-width)
    </div>
  </div>
</div>
```

### Setting one (or more) column(s) width

Auto-layout for *Flexbox* grid columns also means you can set the width of one or more columns (using `.column-{size}` classes) and have the sibling columns automatically resize and expand to fill the leftover space equally.

#### Example 1:

```html
<div class="container">
  <div class="row">
    <div class="column-4">
      1 of 2 (33.3% wide)
    </div>
    <div class="column">
      2 of 2 (whatever's left)
    </div>
  </div>
</div>
```

#### Example 2:

```html
<div class="container">
  <div class="row">
    <div class="column">
      1 of 3
    </div>
    <div class="column-6">
      2 of 3 (50% wider)
    </div>
    <div class="column">
      3 of 3
    </div>
  </div>
</div>
```

#### Example 3:

```html
<div class="container">
  <div class="row">
    <div class="column-3">
      1 of 3 (25% wide)
    </div>
    <div class="column-5">
      2 of 3 (41.6% wide)
    </div>
    <div class="column">
      3 of 3 (whatever's left)
    </div>
  </div>
</div>
```

### Variable width content

Use `.column-auto` class to size columns based on the natural width of their content.

```html
<div class="container">
  <div class="row">
    <div class="column">
      1 of 3 (whatever's left)
    </div>
    <div class="column-auto">
      Variable width content
    </div>
    <div class="column-2">
      3 of 3 (16.6% wide)
    </div>
  </div>
</div>
```

## Responsive layout

***Drupal "Kiso" (基礎)*** grid includes five tiers of predefined classes for building complex responsive layouts.
**Grid system features across multiple devices within a handy table**

|-|Max container width|Class prefix|Nestable|Reordering|
|---|:---:|:---|:---:|:---:|:---:|
|**Extra small**|None (auto)|`.column-{size}`|Yes|Yes|
|**Small**|540px|`.column-small-{size}`|Yes|Yes|
|**Medium**|750px|`.column-medium-{size}`|Yes|Yes|
|**Large**|990px|`.column-large-{size}`|Yes|Yes|
|**Extra large**|1200px|`.column-xlarge-{size}`|Yes|Yes|

### Mixing columns width through devices

Customize the size of your columns on extra small, small, medium, large, or extra large devices however you see fit. Use a combination of different responsive classes for each tier as needed if you do not want your columns to stack in some grid tiers.

**Example 1:**

```html
<div class="container">
  <div class="row">
    <div class="column-6 column-large-4">
      1 of 3 (50% wide on mobile & tablet) (33.3% wide from desktop)
    </div>
    <div class="column-6 column-large-4">
      2 of 3 (50% wide on mobile & tablet) (33.3% wide from desktop)
    </div>
    <div class="column-6 column-large-4">
      3 of 3 (50% wide on mobile & tablet) (33.3% wide from desktop)
    </div>
  </div>
</div>
```

**Example 2:**

```html
<div class="container">
  <div class="row">
    <div class="column-12 column-medium-8">
      1 of 2 (full-width on mobile) (66.6% wide from tablet)
    </div>
    <div class="column-6 column-medium-4">
      2 of 2 (50% wide on mobile) (33.3% wide from tablet)
    </div>
  </div>
</div>
```

**Example 3:**

```html
<div class="container">
  <div class="row">
    <div class="column-small">
      1 of 3 (starts out stacked to equal-width at landscape phone)
    </div>
    <div class="column-small">
      2 of 3 (starts out stacked to equal-width at landscape phone)
    </div>
    <div class="column-small">
      3 of 3 (starts out stacked to equal-width at landscape phone)
    </div>
  </div>
</div>
```

## Adjustment

### Offsetting columns

Use `.offset-{size}` classes for **moving columns** to the right (increasing the left margin). These classes are responsive, so you can set the `offset` by breakpoint (e.g., `.offset-1.offset-medium-2`).

```html
<div class="container">
  <div class="row">
    <div class="column-medium-3">
      1 of 2 (25% wide from tablet)
    </div>
    <div class="column-medium-3 offset-medium-6">
      2 of 2 (25% wide with 50% offset from tablet)
    </div>
  </div>
</div>
```

In addition to column clearing at responsive breakpoint, you may need to reset offsets using `.offset-{breakpoint}-0` classes.

```html
<div class="container">
  <div class="row">
    <div class="column-small-5 column-medium-6">
      1 of 2 (41.6% wide on mobile) (50% wide from tablet)
    </div>
    <div class="column-small-5 offset-small-2 column-medium-6 offset-medium-0">
      2 of 2 (41.6% wide with 16.6% offset on mobile) (50% wide with offset reset from tablet)
    </div>
  </div>
</div>
```

### Reordering columns

Use `.order-{position}` classes for controlling the **visual order** of your columns. These classes are responsive, so you can set the `order` by breakpoint (e.g., `.order-4.order-large-5`).

```html
<div class="container">
  <div class="row">
    <div class="column-large-6 order-large-4">
      1 of 3 (50% wide in first, but second from desktop)
    </div>
    <div class="column-large order-large-1">
      2 of 3 (half whatever's left in second, but first from desktop)
    </div>
    <div class="column-large">
      3 of 3 (half whatever's left in third, but unordered from desktop)
    </div>
  </div>
</div>
```

## Alignment

### Horizontal & vertical alignment of rows

Use `.align-{direction}` classes for defining the **row alignment along/across both horizontal & vertical axis**. These classes are responsive, so you can set the `align` by breakpoint (e.g., `.align-justify.align-large-distribute`).

**Following directions are available to help distribute extra free space left:**

 - *Horizontally:* `left` (*default*), `right`, `center`, `justify` and `distribute`.
 - *Vertically:* `stretch` (*default*), `top`, `middle`, `bottom` and `baseline`.

**Note:** We use the word `center` for *horizontal alignment*, and `middle` for *vertical alignment*.

**Horizontal alignment examples:**

```html
<div class="container">
  <div class="row">
    <div class="column-4">Columns are packed toward</div>
    <div class="column-4">the start of the row</div>
  </div>
  <div class="row align-right align-large-left">
    <div class="column-4">Packed toward (the end of the row on mobile & tablet)</div>
    <div class="column-4">(the start of the row from desktop)</div>
  </div>
  <div class="row align-justify align-medium-distribute">
    <div class="column-4">Columns are (justified from start to end of the row on mobile)</div>
    <div class="column-4">(evenly equal-space distributed in the row from tablet)</div>
  </div>
</div>
```

**Vertical alignment examples:**

```html
<div class="container">
  <div class="row align-medium-top">
    <div class="column-4">Columns are (stretched to fill the container on mobile)</div>
    <div class="column-4">(placed on the cross-start row from tablet)</div>
  </div>
  <div class="row align-bottom align-medium-top">
    <div class="column-4">Columns are placed (on the cross-end row on mobile)</div>
    <div class="column-4">(on the cross-start row from tablet)</div>
  </div>
  <div class="row align-middle align-large-baseline">
    <div class="column-4">Columns are (centered in the cross-axis on mobile & tablet)</div>
    <div class="column-4">(aligned such as their base rows align from desktop)</div>
  </div>
</div>
```

### Vertical alignment of child columns (individually)

Use `.align-self-{direction}` classes for defining **individual column alignment across the vertical axis**. These classes are responsive, so you can set the `align-self` by breakpoint (e.g., `.align-self-middle.align-self-large-baseline`).

Please see the [`.align-{direction}` for *vertical alignment*](#horizontal--vertical-alignment-of-rows) to know all available `direction`s values.

```html
<div class="container">
  <div class="row">
    <div class="column">(default): stretch to fill the container</div>
    <div class="column align-self-top align-self-large-bottom">
      (placed on the cross-start row on mobile) (placed on the cross-end row from desktop)
    </div>
    <div class="column">(default): stretch to fill the container</div>
    <div class="column align-self-xlarge-baseline">
      (starts aligned such as their base rows align at large desktop)
    </div>
    <div class="column">(default): stretch to fill the container</div>
  </div>
</div>
```

## Nesting

To nest your content with the default grid, add a new `.row` within an existing `.row` container. Nested rows should include a set of columns that add up to 12 or fewer (it is not required that you use all 12 available columns).

```html
<div class="container">
  <div class="row">
    <div class="column">
      Level 1: 1 of 2 (equal-width)
      <div class="row">
        <div class="column">
          Level 2: 1 of 3
        </div>
        <div class="column-6">
          Level 2: 2 of 3 (50% wider of the parent row)
        </div>
        <div class="column">
          Level 2: 3 of 3
        </div>
      </div>
    </div>
    <div class="column">
      Level 1: 2 of 2 (equal-width)
  </div>
</div>
```