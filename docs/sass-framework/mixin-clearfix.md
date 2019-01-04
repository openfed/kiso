
clearfix
==========

**File** `STARTERKIT/_sass-framework/mixins/helpers/general/_clearfix.scss`

## Description

Provides an easy way to include a clearfix for containing floats.

Based on the micro clearfix hack by Nicolas Gallagher, with the :before pseudo selector removed to allow normal top margin collapse.

### Link

[http://nicolasgallagher.com/micro-clearfix-hack](http://nicolasgallagher.com/micro-clearfix-hack)  
A new micro clearfix hack – Nicolas Gallagher

### Note

Extending (@extend) is not possible across media contexts. Reasons why we cannot extend across different media contexts are strictly technical at this point. Still, this is something quite annoying to deal with. To work around this issue, the less worse idea is to wrap placeholders with a mixin so you can choose either to `@extend` or to `@include`, depending on whether your in a `@media` block or not.

## Parameters

* **`$extend`** {`Bool`} [`true`]  
Choose either to `@extend` or to `@include`, depending on whether your in a `@media` block or not.

## Example

### scss - Default usage.

```scss
.element {
  @include clearfix;
}

// CSS Output
//
.element::after {
  content: '';
  display: table;
  clear: both;
}
```

### scss - Usage across `@media` context.

```scss
.element {
  @include breakpoint-up(medium) {
    @include clearfix($extend: false);
  }
}

// CSS Output
//
@media (min-width: 768px) {
  .element::after {
    content: '';
    display: table;
    clear: both;
  }
}
```

## Requires

* {`variable`} [`enable-extend-directive`](variable-enable-extend-directive.md)
* {`variable`} [`enable-legacy-support-for-ie6`](variable-enable-legacy-support-for-ie6.md)
* {`variable`} [`enable-legacy-support-for-ie7`](variable-enable-legacy-support-for-ie7.md)
* {`placeholder`} [`clearfix-defaults`](placeholder-clearfix-defaults.md)

## Source

```scss
@mixin clearfix(
  $extend: $enable-extend-directive
) {

  @if $extend {
    @extend %clearfix-defaults;
  }
  @else {
    
    @if ($enable-legacy-support-for-ie6 or $enable-legacy-support-for-ie7) {
      *position: relative;
      *zoom: 1;
    }
    
    // After selector
    //
    &::after {
      content: '';
      display: table;
      clear: both;
    }
  }
}
```