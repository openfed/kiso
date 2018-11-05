
html.html.twig
==========

**File** `templates/system/html.html.twig`

Kiso's theme override for the basic structure of a single Drupal page.

You will find same variables as in the core '[html.html.twig](https://api.drupal.org/api/drupal/core%21modules%21system%21templates%21html.html.twig/8.5.x)' template.

> #### See also
> * kiso_page_attachments_alter()
> * [template_preprocess_html](https://api.drupal.org/api/drupal/core%21includes%21theme.inc/function/template_preprocess_html/8.5.x "Prepares variables for HTML document templates.")()
> * kiso_preprocess_html()

## Source

```twig
{#
/**
 * @file
 * Kiso's theme override for the basic structure of a single Drupal page.
 *
 * You will find same variables as in the core 'html.html.twig' template.
 *
 * @see kiso_page_attachments_alter()
 * @see template_preprocess_html()
 * @see kiso_preprocess_html()
 */
#}
{%
  set body_classes = [
    logged_in ? 'user-logged-in' : 'not-logged-in',
    not root_path ? 'page--frontpage' : 'page--' ~ root_path|clean_class,
    node_type ? 'page--node-type-' ~ node_type|clean_class,
    db_offline ? 'db-offline',
  ]
%}
<!DOCTYPE html>
<html{{ html_attributes }}>
  <head>
    <head-placeholder token="{{ placeholder_token }}">
    <title>{{ head_title|safe_join(' | ') }}</title>
    <css-placeholder token="{{ placeholder_token }}">
    <js-placeholder token="{{ placeholder_token }}">
  </head>
  <body{{ attributes.addClass(body_classes) }}>
    {# Keyboard navigation/accessibility link to main content section in page.html.twig. #}
    <a accesskey="s" href="#main-content" class="focusable skip-link">
      {{ 'Skip to main content [accesskey="s"]'|t }}
    </a>
    {{ page_top }}
    {{ page }}
    {{ page_bottom }}
    <js-bottom-placeholder token="{{ placeholder_token|raw }}">
    <noscript class="noscript">
      {% set enable_js_url = 'http://www.enable-javascript.com/' %}
      {% trans %}
        For full functionality of this site it is necessary to enable JavaScript.<br>
        Here are the <a href="{{ enable_js_url|raw }}" target="_blank"> instructions how to enable JavaScript in your web browser</a>.
      {% endtrans %}
    </noscript>
  </body>
</html>
```