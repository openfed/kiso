Themes folder
==========

The 'theme/' folder contains everything that takes part of purely visual style changing, such as new border settings, box-shadow, colors and backgrounds, font properties, etc ... according to specific contexts. Ideally, these should be separated enough from a component's structure to be "swappable", and omitting these entirely should not break the component's functionality or basic usability.

On large sites and applications, it is not unusual to have different themes. There are certainly different ways of dealing with themes but I personally like having them all in a 'theme/' folder.

Be aware Kiso (基礎) base theme (including the 'Framework SASS') already provide few components definition rules.

*Take a look at (without modifying):*

* ./kiso/scss/theme/
* ./THEMENAME/_sass-framework/mixins/library/general/_buttons.scss
* ./THEMENAME/_sass-framework/mixins/library/general/_tables.scss