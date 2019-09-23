Templates override folder
==========

This folder is where you should place all your overriding template files. By default, the Kiso (基礎) base theme provides all the necessary template files in various folders inside of './kiso/templates'.

For example, the 'html.html.twig' and 'page.html.twig' template files are located at './kiso/templates/layout'. To override any of these files, copy them from the Kiso (基礎) base theme and place them in here.

*Please use the following folder structure to store your overriding template files:*

* ./THEMENAME/templates/block
* ./THEMENAME/templates/block/block--[...].html.twig
* ./THEMENAME/templates/block/...

* ./THEMENAME/templates/content
* ./THEMENAME/templates/content/node--[...].html.twig
* ./THEMENAME/templates/content/...

* ./THEMENAME/templates/field
* ./THEMENAME/templates/field/field--[...].html.twig
* ./THEMENAME/templates/field/...

* ./THEMENAME/templates/layout
* ./THEMENAME/templates/layout/html--[...].html.twig
* ./THEMENAME/templates/layout/page--[...].html.twig
* ./THEMENAME/templates/layout/region--[...].html.twig
* ./THEMENAME/templates/layout/...

* ./THEMENAME/templates/views
* ./THEMENAME/templates/views/views-view--[...].html.twig
* ./THEMENAME/templates/views/...
* ./THEMENAME/templates...