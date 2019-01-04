
screen-reader-only-focusable-defaults
==========

**File** `STARTERKIT/_sass-framework/placeholders/helpers/general/_screen-readers-only.scss`

## Description

Focused content default properties.

## Example

### scss - Usage.

```scss
.bar {
  @extend %screen-reader-only-defaults;
  @extend %screen-reader-only-focusable-defaults;
}

// CSS Output
//
.bar {
  position: absolute !important;
  clip: rect(1px, 1px, 1px, 1px) !important;
  clip-path: inset(50%) !important;
  overflow: hidden !important;
  height: 1px !important;
  width: 1px !important;
  padding: 0 !important;
  border: 0 !important;
  white-space: nowrap !important;
}
.bar:focus,
.bar:active {
  clip: auto !important;
  clip-path: none !important;
  overflow: visible !important;
  width: auto !important;
  height: auto !important;
  white-space: normal !important;
}
```

## Requires

* {`mixin`} [`focusable`](mixin-focusable.md)

## Source

```scss
%screen-reader-only-focusable-defaults {
  @include focusable($extend: false);
}
```