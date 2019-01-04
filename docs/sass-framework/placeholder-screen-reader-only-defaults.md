
screen-reader-only-defaults
==========

**File** `STARTERKIT/_sass-framework/placeholders/helpers/general/_screen-readers-only.scss`

## Description

Content to screen readers default properties.

## Example

### scss - Usage.

```scss
.foo {
  @extend %screen-reader-only-defaults;
}

// CSS Output
//
.foo {
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
```

## Requires

* {`mixin`} [`visually-hidden`](mixin-visually-hidden.md)

## Source

```scss
%screen-reader-only-defaults {
  @include visually-hidden($extend: false);
}
```