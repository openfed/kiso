
block--bare.html.twig
==========

**File** `templates/block/bare/block--bare.html.twig`

Default Kiso's theme implementation to display a bare minimum block.

You will find same variables as in the core '[block.html.twig](https://api.drupal.org/api/drupal/core!modules!block!templates!block.html.twig/8.5.x)' template.

> #### See also
> * [template_preprocess_block](https://api.drupal.org/api/drupal/core%21modules%21block%21block.module/function/template_preprocess_block/8.5.x "Prepares variables for block templates.")()

> #### Used by
> * [`block--page-title-block.html.twig`](block--page-title-block.html.twig.md)
> * [`block--system-main-block.html.twig`](block--system-main-block.html.twig.md)

## Source

```twig
{#
/**
 * @file
 * Default Kiso's theme implementation to display a bare minimum block.
 *
 * You will find same variables as in the core 'block.html.twig' template.
 *
 * @see template_preprocess_block()
 * @see block--page-title-block.html.twig
 * @see block--system-main-block.html.twig
 * 
 * @ingroup themeable
 */
#}
{% block content %}
  {{ content }}
{% endblock %}
```