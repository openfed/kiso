
off-canvas-page-wrapper.html.twig
==========

**File** `templates/system/off-canvas-page-wrapper.html.twig`

Kiso's theme override to display a page wrapper.

For consistent wrapping to `{{ page }}` render in all themes. The `data-off-canvas-main-canvas` attribute is required by the `off-canvas` dialog. This is used by the `core/drupal.dialog.off_canvas` library to select the `main canvas` page element as opposed to the `off canvas` which is the dialog itself. The `main canvas` element must be resized according to the width of the `off canvas` dialog so that no portion of the `main canvas` is obstructed by the `off canvas` dialog. The `off canvas` dialog can vary in width when opened and can be resized by the user. The `data-off-canvas-main-canvas` attribute cannot be removed without breaking the `off canvas` dialog functionality.

You will find same variables as in the core '[off-canvas-page-wrapper.html.twig](https://api.drupal.org/api/drupal/core%21modules%21system%21templates%21off-canvas-page-wrapper.html.twig/8.5.x)' template.

## Source

```twig
{#
/**
 * @file
 * Kiso's theme override to display a page wrapper.
 *
 * For consistent wrapping to '{{ page }}' render in all themes. The
 * 'data-off-canvas-main-canvas' attribute is required by the 'off-canvas' dialog.
 * This is used by the 'core/drupal.dialog.off_canvas' library to select the
 * 'main canvas' page element as opposed to the 'off canvas' which is the dialog
 * itself. The 'main canvas' element must be resized according to the width of
 * the 'off canvas' dialog so that no portion of the 'main canvas' is obstructed
 * by the 'off-canvas' dialog. The 'off-canvas' dialog can vary in width when opened
 * and can be resized by the user. The 'data-off-canvas-main-canvas' attribute
 * cannot be removed without breaking the 'off-canvas' dialog functionality.
 *
 * You will find same variables as in the core 'off-canvas-page-wrapper.html.twig' template.
 */
#}
{%
  set classes = [
    'page',
    'dialog-off-canvas-main-canvas',
  ]
%}
{% if children %}
  <div{{ attributes.addClass(classes).setAttribute('data-off-canvas-main-canvas', '') }}>
    {{ children }}
  </div>
{% endif %}
```