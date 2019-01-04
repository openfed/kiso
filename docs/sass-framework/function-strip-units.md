
strip-units
==========

**File** `STARTERKIT/_sass-framework/functions/helpers/general/_strip-units.scss`

## Description

Strips the units from a value.

## Parameters

* **`$value`** {`Number`}  
The value to strip of its unit.

## Returns

{`Number`}  
The value unitless.
e.g. 16px -> 16.

## Access

private

## Source

```scss
@function strip-units(
  $value
) {

  @return ($value / ($value * 0 + 1));
}
```