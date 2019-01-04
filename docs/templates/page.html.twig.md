
page.html.twig
==========

**File** `templates/system/page.html.twig`

Kiso's theme override to display a single page.

The doctype, html, head and body tags are not in this template. Instead they can be found in the `html.html.twig` template in this directory.

You will find same variables as in the core '[page.html.twig](https://api.drupal.org/api/drupal/core%21modules%21system%21templates%21page.html.twig/8.5.x)' template.

### Custom variables:
* **has_tools**, **has_header**, **has_header_collapsible**, **has_highlighted**, **has_postscript**, **has_footer**: Properly detect if regions are empty.

### Regions:
* **page.tools**: Items for the Toolbar region.
* **page.header**: Items for the Header region.
* **page.header_collapsible**: Items for the Header (Collapsible) region.
* **page.highlighted**: Items for the Highlighted (Featured content) region.
* **page.help**: Dynamic help text, mostly for admin pages.
* **page.breadcrumb**: Items for the Breadcrumb region.
* **page.content**: The current page content (Using 'Panels' to build page layouts).
* **page.postscript**: Items for the Postscript (Footnotes) region.
* **page.footer**: Items for the Footer region.

> #### See also
> * [template_preprocess_page](https://api.drupal.org/api/drupal/core%21includes%21theme.inc/function/template_preprocess_page/8.5.x "Prepares variables for the page template.")()
> * kiso_preprocess_page()
> * [html.html.twig](html.html.twig.md)

## Source

```twig
{#
/**
 * @file
 * Kiso's theme override to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the 'html.html.twig' template in this directory.
 *
 * You will find same variables as in the core 'page.html.twig' template.
 * 
 * Custom variables:
 * - has_tools, has_header, has_header_collapsible, has_highlighted, has_navigation,
 *   has_complementary, has_postscript, has_footer: Properly detect if regions are empty.
 *
 * Regions:
 * - page.tools: Items for the Toolbar region.
 * - page.header: Items for the Header region.
 * - page.header_collapsible: Items for the Header (Collapsible) region.
 * - page.highlighted: Items for the Highlighted (Featured content) region.
 * - page.help: Dynamic help text, mostly for admin pages.
 * - page.breadcrumb: Items for the Breadcrumb region.
 * - page.content: The current page content.
 * - page.navigation: Items for the Navigation sidebar (Left) region.
 * - page.complementary: Items for the Related content sidebar (Right) region.
 * - page.postscript: Items for the Postscript (Footnotes) region.
 * - page.footer: Items for the Footer region.
 *
 * @see template_preprocess_page()
 * @see kiso_preprocess_page()
 * @see html.html.twig
 */
#}
{% set container = container_fluid ? 'container-fluid' : 'container' %}

{# Toolbar Area #}
{% if has_tools %}
  {% block tools %}
    <div class="page__wrapper page__wrapper--tools">
      <div class="page__section page__section--tools {{ container }}" aria-label="{{ 'Toolbar'|t }}">
        {{ page.tools }}
      </div>
    </div>
  {% endblock %}
{% endif %}

{# Banner Landmark #}
{% if has_header or has_header_collapsible %}
  {% block header %}
    <div class="page__wrapper page__wrapper--header">
      <header class="page__section page__section--header {{ container }}" role="banner">
        {{ page.header }}
        {# This button is used as the toggle for the Header (Collapsible) #}
        <button type="button" class="button--toggler" aria-controls="headerCollapsible" aria-expanded="false"><span>Menu</span></button>
        {{ page.header_collapsible }}
      </header>
    </div>
  {% endblock %}
{% endif %}

{# Featured content Area #}
{% if has_highlighted %}
  {% block highlighted %}
    <div class="page__wrapper page__wrapper--highlighted">
      <div class="page__section page__section--highlighted {{ container }}" aria-label="{{ 'Featured content'|t }}">
        {{ page.highlighted }}
      </div>
    </div>
  {% endblock %}
{% endif %}

{# Breadcrumb #}
{% block breadcrumb %}
  {{ page.breadcrumb }}
{% endblock %}

{# Main #}
{% block main %}
  <div class="page__wrapper page__wrapper--content">

    {% if has_navigation or has_complementary %}
      <div class="{{ container }}">
        <div class="row">
    {% endif %}

      {# Main content #}
      {%
        set content_classes = [
          'page__section',
          'page__section--content',
          has_navigation or has_complementary ? '' : container,
        ]
      %}
      {% block content %}
        <main{{ content_attributes.addClass(content_classes).setAttribute('role', 'main') }}>
          {{ page.content }}
        </main>
      {% endblock %}

      {# Navigation sidebar (Left) #}
      {% if has_navigation %}
        {% block navigation %}
          <div class="page__section page__section--navigation" aria-label="{{ 'Navigation sidebar'|t }}">
            {{ page.navigation }}
          </div>
        {% endblock %}
      {% endif %}

      {# Related content sidebar (Right) #}
      {% if has_complementary %}
        {% block complementary %}
          <div class="page__section page__section--complementary" aria-label="{{ 'Related content sidebar'|t }}">
            {{ page.complementary }}
          </div>
        {% endblock %}
      {% endif %}

    {% if has_navigation or has_complementary %}
        </div>
      </div>
    {% endif %}

  </div>
{% endblock %}

{# Footnotes Area #}
{% if has_postscript %}
  {% block postscript %}
    <div class="page__wrapper page__wrapper--postscript">
      <div class="page__section page__section--postscript {{ container }}" aria-label="{{ 'Footnotes'|t }}">
        {{ page.postscript }}
      </div>
    </div>
  {% endblock %}
{% endif %}

{# Contentinfo Landmark #}
{% if has_footer %}
  {% block footer %}
    <div class="page__wrapper page__wrapper--footer">
      <footer class="page__section page__section--footer {{ container }}" role="contentinfo">
        {{ page.footer }}
      </footer>
    </div>
  {% endblock %}
{% endif %}
```