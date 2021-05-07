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
  $region_labels = isset($variables['layout']) ? $variables['layout']->getRegionLabels() : [];

  foreach (Element::children($variables['content']) as $name) {
    // Add classes for each visible region.
    if (!empty(_kiso_strip_tags(render($variables['content'][$name])))) {
      $variables['visible_region_classes'][] = 'is-visible--' . Html::cleanCssIdentifier($name);
    }
  }
}
