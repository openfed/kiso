<?php

/**
 * @file
 * Prepares variables for Panels layout templates.
 */

use Drupal\Component\Utility\Html;
use Drupal\Core\Render\Element;

/**
 * Implements hook_preprocess_HOOK() for layout.html.twig.
 */
function kiso_preprocess_layout(&$variables) {
  foreach (Element::children($variables['content']) as $name) {
    // Add classes for each visible region.
    if (_kiso_has_region(render($variables['content'][$name]))) {
      $variables['visible_region_classes'][] = 'is-visible--' . Html::cleanCssIdentifier($name);
    }
  }
}
