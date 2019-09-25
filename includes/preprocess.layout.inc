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
    if (!empty(strip_tags(render($variables['content'][$name])))) {
      $variables['visible_region_classes'][] = 'is-visible--' . Html::cleanCssIdentifier($name);
    }

    // Region provides a unique label which can be read by assistive technology.
    $variables['region_attributes'][$name]['aria-label'] = isset($region_labels[$name]) ? $region_labels[$name] : 'Undefined';
  }
}
