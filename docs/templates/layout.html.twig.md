
layout.html.twig
==========

**File** `templates/layouts/layout.html.twig`

Kiso's theme override to display a generic layout.

You will find same variables as in the core '[layout.html.twig](https://api.drupal.org/api/drupal/core%21modules%21layout_discovery%21templates%21layout.html.twig/8.5.x)' template.

### Custom variables:
* **visible_region_classes**: This array may contain one or more of the following class pattern:
  * `is-visible--[region_name]`: The region name visibility. For example, if the region is `sidebar_first` it would result in `is-visible--sidebar-first`.
* **region_wrapper**: array of HTML element `['main', 'div']` which wraps the region according to its name.

> #### See also
> * [template_preprocess_layout](https://api.drupal.org/api/drupal/core%21modules%21layout_discovery%21layout_discovery.module/function/template_preprocess_layout/8.5.x "Prepares variables for layout templates.")()
> * kiso_preprocess_layout()

## Source

```twig
{#
/**
 * @file
 * Kiso's theme override to display a generic layout.
 *
 * You will find same variables as in the core 'layout.html.twig' template.
 *
 * Custom variables:
 * - visible_region_classes: This array may contain one or more of the following
 *   class pattern:
 *   - is-visible--[region_name]: The region name visibility. For example, if the
 *     region is 'sidebar_first' it would result in 'is-visible--sidebar-first'.
 * - region_wrapper: array of HTML element '['main', 'div']' which wraps the region according
 *   to its name.
 *
 * @see template_preprocess_layout()
 * @see kiso_preprocess_layout()
 */
#}
{%
  set classes = [
    'layout',
    'layout--' ~ layout.id|clean_class,
  ]
%}
{% if content %}
  <div{{ attributes.addClass(classes, visible_region_classes) }}>
    {% for region in layout.getRegionNames %}
      {% if content[region]|render|striptags %}
        <{{ region_wrapper[region] }}{{ region_attributes[region].addClass('layout__region', 'layout__region--' ~ region|clean_class) }}>
          {{ content[region] }}
        </{{ region_wrapper[region] }}>
      {% endif %}
    {% endfor %}
  </div>
{% endif %}
```