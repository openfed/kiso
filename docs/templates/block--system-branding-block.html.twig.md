block--system-branding-block.html.twig
==========

**File** `templates/block/branding/block--system-branding-block.html.twig`

Kiso's theme override to display a branding block.

Each branding element variable (logo, name, slogan) is only available if enabled in the block configuration.

You will find same variables as in the core '[block--system-branding-block.html.twig](https://api.drupal.org/api/drupal/core%21modules%21system%21templates%21block--system-branding-block.html.twig/8.5.x)' template.

### Custom variables:
* **is_hidden**: A flag indicating if the logo is defined.
* **alt_text**: The specific text to be used to set the alternative text for the logo.
* **is_front**: A flag indicating if the current page is the front page.

> #### See also
> * [template_preprocess_block](https://api.drupal.org/api/drupal/core%21modules%21block%21block.module/function/template_preprocess_block/8.5.x "Prepares variables for block templates.")()
> * kiso_preprocess()
> * kiso_preprocess_block()

## Source

```twig
{% extends "block.html.twig" %}
{#
/**
 * @file
 * Kiso's theme override to display a branding block.
 *
 * Each branding element variable (logo, name, slogan) is only available if
 * enabled in the block configuration.
 *
 * You will find same variables as in the core 'block--system-branding-block.html.twig' template.
 *
 * Custom variables:
 * - is_hidden: A flag indicating if the logo is defined.
 * - alt_text: The specific text to be used to set the alternative
 *   text for the logo.
 * - is_front: A flag indicating if the current page is the front page.
 *
 * @see template_preprocess_block()
 * @see kiso_preprocess()
 * @see kiso_preprocess_block()
 */
#}
{% set is_hidden = site_logo ? 'true' : 'false' %}
{% set alt_text = site_name ? site_name : 'the' %}

{% block content %}
  {% if site_logo or site_name %}
    <a href="{{ path('<front>') }}" title="{{ 'Back to the home page'|t }}" rel="home" class="block__branding">

      {% if site_logo %}
        <img src="{{ site_logo }}" alt="{{ 'Back to @site_name home page'|t({ '@site_name': alt_text }) }}" width="60" height="60" class="block__site-logo">
      {% endif %}

      {% if site_name %}
        <span class="block__site-name" aria-hidden="{{ is_hidden }}">{{ '@site_name <span class="visually-hidden">home page</span>'|t({ '@site_name': site_name }) }}</span>
      {% endif %}

    </a>
    {% if site_name and is_front %}
      <h1 class="visually-hidden">{{ '@site_name home page'|t({ '@site_name': site_name }) }}</h1>
    {% endif %}
  {% endif %}

  {% if site_slogan %}
    <small class="block__site-slogan">{{ site_slogan }}</small>
  {% endif %}
{% endblock %}
```