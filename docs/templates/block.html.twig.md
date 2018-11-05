
block.html.twig
==========

**File** `templates/block/block.html.twig`

Kiso's theme override to display a block.

You will find same variables as in the core '[block.html.twig](https://api.drupal.org/api/drupal/core!modules!block!templates!block.html.twig/8.5.x)' template.

### Custom variables:
* **derivative_plugin_id**: Useful class according to the generated module (Provider).
* **block_wrapper**: HTML element which wraps the block according to the configured label of the block if visible. In this case, the output will be a `<section>` element. In the opposite case, if invisible configured block label, the output will the default  `<div role="region">` wrapper with a suitable landmark.
* **heading_id**: A valid HTML ID and guaranteed unique used as value for the WAI-ARIA `aria-labelledby` attribute to point to an existing element by its (unique) ID. If a heading (hX) is present in the region, consider using it as the label.

> #### See also
> * [template_preprocess_block](https://api.drupal.org/api/drupal/core%21modules%21block%21block.module/function/template_preprocess_block/8.5.x "Prepares variables for block templates.")()
> * kiso_preprocess_block()

## Source

```twig
{#
/**
 * @file
 * Kiso's theme override to display a block.
 *
 * You will find same variables as in the core 'block.html.twig' template.
 *
 * Custom variables:
 * - derivative_plugin_id: Useful class according to the generated
 *   module (Provider).
 * - block_wrapper: HTML element which wraps the block according to
 *   the configured label of the block if visible. In this case, the
 *   output will be a '<section>' element. In the opposite case, if
 *   invisible configured block label, the output will the default
 *   '<div role="region">' wrapper with a suitable landmark.
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
    'block--' ~ configuration.provider|clean_class,
    'block--' ~ configuration.provider|clean_class ~ '--' ~ derivative_plugin_id|clean_class,
  ]
%}
{# Provide WAI-ARIA attributes/landmarks for screen readers according to the display settings for the label. #}
{% if label %}
  {% set block_wrapper = 'section' %}
  {% set heading_id = attributes.id ? attributes.id|clean_id ~ '-heading' : 'block-' ~ plugin_id|clean_id ~ '-heading' %}
  {% set attributes = attributes.setAttribute('aria-labelledby', heading_id) %}
{% else %}
  {% set block_wrapper = 'div' %}
  {% set attributes = attributes.setAttribute('role', 'region').setAttribute('aria-label', configuration.label) %}
{% endif %}

<{{ block_wrapper }}{{ attributes.addClass(classes) }}>
  {{ title_prefix }}
  {% if label %}
    <h2{{ title_attributes.addClass('block__title').setAttribute('id', heading_id) }}>{{ label }}</h2>
  {% endif %}
  {{ title_suffix }}

  {% block content %}
    {{ content }}
  {% endblock %}
</{{ block_wrapper }}>
```