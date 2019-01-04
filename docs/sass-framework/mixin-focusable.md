
focusable
==========

**File** `STARTERKIT/_sass-framework/mixins/helpers/general/_screen-readers-only.scss`

## Description

Only display content when it’s focused.

Use in conjunction with `@include visually-hidden;` to only display content when it's focused. Useful for "Skip to main content" links.

### Link

* [https://www.w3.org/TR/2013/NOTE-WCAG20-TECHS-20130905/G1](https://www.w3.org/TR/2013/NOTE-WCAG20-TECHS-20130905/G1)  
G1: Adding a link at the top of each page that goes directly to the main content area

### Note

Extending (@extend) is not possible across media contexts. Reasons why we cannot extend across different media contexts are strictly technical at this point. Still, this is something quite annoying to deal with. To work around this issue, the less worse idea is to wrap placeholders with a mixin so you can choose either to `@extend` or to `@include`, depending on whether your in a `@media` block or not.

## Parameters

* **`$extend`** {`Bool`} [`true`]  
Choose either to `@extend` or to `@include`, depending on whether your in a `@media` block or not.

## Example

### scss - Default usage.

```scss
.element {
  @include visually-hidden;
  @include focusable;
}

// CSS Output
//
.element {
  position: absolute !important;
  clip: rect(1px, 1px, 1px, 1px) !important;
  ...
  border: 0 !important;
  white-space: nowrap !important;
}
.element:focus,
.element:active {
  clip: auto !important;
  ...
  white-space: normal !important;
}
```

### scss - Usage across `@media` context.

```scss
.element {
  @include breakpoint-up(medium) {
    @include visually-hidden($extend: false);
    @include focusable($extend: false);
  }
}

// CSS Output
//
@media (min-width: 768px) {
  .element {
    position: absolute !important;
    clip: rect(1px, 1px, 1px, 1px) !important;
    ...
    border: 0 !important;
    white-space: nowrap !important;
  }
  .element:focus,
  .element:active {
    clip: auto !important;
    ...
    white-space: normal !important;
  }
}
```

## Requires

* {`variable`} [`enable-extend-directive`](variable-enable-extend-directive.md)
* {`placeholder`} [`screen-reader-only-focusable-defaults`](placeholder-screen-reader-only-focusable-defaults.md)

## Source

```scss
@mixin focusable(
  $extend: $enable-extend-directive
) {

  @if $extend {
    @extend %screen-reader-only-focusable-defaults;
  }
  @else {
    
    // Focus and active states
    //
    &:focus,
    &:active {
      clip: auto !important;
      clip-path: none !important;
      overflow: visible !important;
      width: auto !important;
      height: auto !important;
      white-space: normal !important;
    }
  }
}
```