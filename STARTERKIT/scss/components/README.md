Components folder
==========

For smaller components, there is the 'components/' folder. While 'layout/' is macro (defining the global wireframe), 'components/' is more focused on widgets. It contains all kind of specific modules like a slider, a loader, a widget, and basically anything along those lines. There are usually a lot of files in 'components/' since the whole site/application should be mostly composed of tiny modules.

Ideally, components should exist in their own Sass file (or partial) within this 'components/' folder. The styles described in each component file should only be concerned with:

* the style of the component itself;
* the style of the component's variants, modifiers, and/or states;
* the styles of the component's descendents (i.e. children), if necessary.

If you want your components to be able to be themed externally (e.g. from the 'themes/'' folder), limit the declarations to only structural styles, such as dimensions (width/height), padding, margins, alignment, default/common color etc.

Be aware Kiso (基礎) base theme (including the Sass Framework) already provide few components definition rules.

*Take a look at (without modifying):*

* ./kiso/scss/components/
* ./THEMENAME/_sass-framework/placeholders/components/