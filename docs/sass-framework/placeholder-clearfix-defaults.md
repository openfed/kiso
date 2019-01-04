
clearfix-defaults
==========

**File** `STARTERKIT/_sass-framework/placeholders/helpers/general/_clearfix.scss`

## Description

Float clearing default properties.

## Example

### scss - Usage.

```scss
.element {
  @extend %clearfix-defaults;
}

// CSS Output
//
.element::after {
  content: '';
  display: table;
  clear: both;
}
```

## Requires

* {`mixin`} [`clearfix`](mixin-clearfix.md)

## Source

```scss
%clearfix-defaults {
  @include clearfix($extend: false);
}
```