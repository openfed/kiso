Components folder
==========

For smaller components, here is the 'components/' folder. While 'layout/' is macro (defining the global wireframe), 'components/' is more focused on widgets. It contains all kind of specific modules/components like buttons, form elements, pager, tabs, breadcrumb, branding and basically anything along those lines. There are usually a lot of files in 'components/' since the whole site/application should be mostly composed of tiny modules/components.

Ideally, components should exist in their own Sass file (or partial) within this 'components/' folder. The styles described in each component file should only be concerned with:

* the default style of the component itself;
* the default style of the component's modifiers and/or states;
* the default styles of the component's descendents (i.e. children), if necessary.

If you want your components to be able to be themed externally (e.g. from the 'theme/' folder), limit the declarations to only structural styles, such as dimensions (width/height), paddings, margins, alignment, default/common color etc.

Be aware Kiso (基礎) base theme (including the 'Framework SASS') already provide few components definition rules.

*Take a look at (without modifying):*

* ./kiso/scss/components/
* ./THEMENAME/_sass-framework/elements/buttons
* ./THEMENAME/_sass-framework/elements/form
* ./THEMENAME/_sass-framework/elements/list
