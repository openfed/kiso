
region--header-collapsible.html.twig
==========

**File** `templates/system/region--header-collapsible.html.twig`

Default Kiso's theme implementation for the "Header" (Collapsible) region.

You will find same variables as in the core '[region.html.twig](https://api.drupal.org/api/drupal/core%21modules%21system%21templates%21region.html.twig/8.5.x)' template.

> #### See also
> * [template_preprocess_region](https://api.drupal.org/api/drupal/core%21includes%21theme.inc/function/template_preprocess_region/8.5.x "Prepares variables for region templates.")()

## Source

```twig
{#
/**
 * @file
 * Default Kiso's theme implementation for the "Header" (Collapsible) region.
 *
 * You will find same variables as in the core 'region.html.twig' template.
 *
 * @see template_preprocess_region()
 * 
 * @ingroup themeable
 */
#}
{%
  set classes = [
    'region',
    'region--' ~ region|clean_class,
  ]
%}
{% if content %}
  <div{{ attributes.addClass(classes).setAttribute('id', 'headerCollapsible') }}>
    {{ content }}
  </div>
{% endif %}
```