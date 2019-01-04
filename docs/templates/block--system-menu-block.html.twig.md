
block--system-menu-block.html.twig
==========

**File** `templates/block/navigation/block--system-menu-block.html.twig`

Kiso's theme override to display a menu block.

You will find same variables as in the core '[block.html.twig](https://api.drupal.org/api/drupal/core!modules!block!templates!block.html.twig/8.5.x)' template.

### Custom variables:
* **derivative_plugin_id**: Useful class according to the generated module (Provider).
* **block_region**: The block region embedding the current block.
* **heading_id**: A valid HTML ID and guaranteed unique used as value for the WAI-ARIA `aria-labelledby` attribute to point to an existing element by its (unique) ID. If a heading (hX) is present in the region, consider using it as the label.

> #### See also
> * [template_preprocess_block](https://api.drupal.org/api/drupal/core%21modules%21block%21block.module/function/template_preprocess_block/8.5.x "Prepares variables for block templates.")()
> * kiso_preprocess_block()

## Source

```twig
{#
/**
 * @file
 * Kiso's theme override to display a menu block.
 *
 * You will find same variables as in the core 'block.html.twig' template.
 *
 * Custom variables:
 * - derivative_plugin_id: Useful class according to the generated
 *   module (Provider).
 * - block_region: The block region embedding the current block.
 * - heading_id: A valid HTML ID and guaranteed unique used as value for the
 *   WAI-ARIA 'aria-labelledby' attribute to point to an existing element by
 *   its (unique) ID. If a heading (hX) is present in the region, consider
 *   using it as the label.
 *
 * @see template_preprocess_block()
 * @see kiso_preprocess_block()
 */
#}
{%
  set classes = [
    'block',
    'block--menu',
    'block--menu--' ~ derivative_plugin_id|clean_class,
    'block--region-' ~ block_region|clean_class,
  ]
%}
{# Provide WAI-ARIA attributes for screen readers according to the display settings for the label. #}
{% set heading_id = attributes.id ? attributes.id|clean_id ~ '-heading' : 'block-' ~ plugin_id|clean_id ~ '-heading' %}
{% set attributes = label ? attributes.setAttribute('aria-labelledby', heading_id) : attributes.setAttribute('aria-label', configuration.label) %}

<nav{{ attributes|without('role').addClass(classes) }}>
  {{ title_prefix }}
  {% if label %}
    <h2{{ title_attributes.addClass('block__title').setAttribute('id', heading_id) }}>{{ label }}</h2>
  {% endif %}
  {{ title_suffix }}

  {# Menu. #}
  {% block content %}
    {{ content }}
  {% endblock %}
</nav>
```