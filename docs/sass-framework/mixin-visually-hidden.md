
visually-hidden
==========

**File** `STARTERKIT/_sass-framework/mixins/helpers/general/_screen-readers-only.scss`

## Description

Only display content to screen readers.

### Link

* [http://a11yproject.com/posts/how-to-hide-content](http://a11yproject.com/posts/how-to-hide-content)  
How-to: Hide content - The A11Y Project
* [http://hugogiraudel.com/2016/10/13/css-hide-and-seek/](http://hugogiraudel.com/2016/10/13/css-hide-and-seek/)  
CSS Hide-and-Seek

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
```

### scss - Usage across `@media` context.

```scss
.element {
  @include breakpoint-up(medium) {
    @include visually-hidden($extend: false);
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
}
```

## Requires

* {`variable`} [`enable-extend-directive`](variable-enable-extend-directive.md)
* {`variable`} [`enable-legacy-support-for-ie6`](variable-enable-legacy-support-for-ie6.md)
* {`variable`} [`enable-legacy-support-for-ie7`](variable-enable-legacy-support-for-ie7.md)
* {`placeholder`} [`screen-reader-only-defaults`](placeholder-screen-reader-only-defaults.md)

## Source

```scss
@mixin visually-hidden(
  $extend: $enable-extend-directive
) {

  @if $extend {
    @extend %screen-reader-only-defaults;
  }
  @else {
    position: absolute !important;
    @if ($enable-legacy-support-for-ie6 or $enable-legacy-support-for-ie7) {
      clip: rect(1px 1px 1px 1px) !important; // IE6 and IE7 use the wrong syntax.
    }
    clip: rect(1px, 1px, 1px, 1px) !important;
    clip-path: inset(50%) !important;
    overflow: hidden !important;
    height: 1px !important;
    width: 1px !important;
    padding: 0 !important;
    border: 0 !important;
    white-space: nowrap !important;
  }
}
```