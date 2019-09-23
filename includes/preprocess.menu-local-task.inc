<?php

/**
 * @file
 * Prepares variables for single local task link templates.
 */

/**
 * Implements hook_preprocess_HOOK() for menu-local-task.html.twig.
 */
function kiso_preprocess_menu_local_task(&$variables) {
  $link = $variables['element']['#link'];

  // Manage tabs links with new classes.
  if (!isset($link['localized_options']['attributes']['class'])) {
    // Add the `.tabs__link` class.
    $link['localized_options']['attributes']['class'] = array('tabs__link');
  }
  else {
    // Prepend the `.tabs__link` class to the beginning of the `['class']` Array.
    array_unshift($link['localized_options']['attributes']['class'], 'tabs__link');
  }

  $link['localized_options']['set_active_class'] = TRUE;
  $variables['link'] = [
    '#type' => 'link',
    '#title' => (isset($variables['link']['#title'])) ? $variables['link']['#title'] : $link['title'],
    '#url' => $link['url'],
    '#options' => $link['localized_options'],
  ];
}
