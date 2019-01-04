
contains-number
==========

**File** `STARTERKIT/_sass-framework/functions/helpers/general/_contains-number.scss`

## Description

Checks if a list contains a number(s).

## Parameters

* **`$values`** {`List`}  
A single value or list of values to check for.

## Returns

`Bool`

## Access

private

## Source

```scss
@function contains-number(
  $values
) {

  @each $value in $values {

    @if type-of($value) == "number" {
      @return true;
    }
  }

  @return false;
}
```