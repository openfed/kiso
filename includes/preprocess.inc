<?php

/**
 * @file
 * Prepares variables for all templates.
 */

/**
 * Implements hook_preprocess().
 */
function kiso_preprocess(&$variables, $hook) {
  try {
    $variables['is_front'] = \Drupal::service('path.matcher')->isFrontPage();
    $variables['language'] = \Drupal::languageManager()->getCurrentLanguage()->getId();
  }
  catch (Exception $e) {
    $variables['is_front'] = FALSE;
    $variables['language'] = FALSE;
  }
  // Ensure the cache varies correctly (new in Drupal 8.3).
  $variables['#cache']['contexts'][] = 'url.path.is_front';

  // Creates variables from theme settings.
  $variables['container_fluid'] = theme_get_setting('container_fluid');

  // Load expected asset libraries.
  $variables['#attached']['library'][] = 'kiso/reboot';
  // Base styles:
  $variables['#attached']['library'][] = 'kiso/elements';
  // layout styles:
  $variables['#attached']['library'][] = 'kiso/layout';
  // Components styles:
  $variables['#attached']['library'][] = 'kiso/blocks';
  $variables['#attached']['library'][] = 'kiso/navigations';
  $variables['#attached']['library'][] = 'kiso/forms';
  $variables['#attached']['library'][] = 'kiso/fields';
  $variables['#attached']['library'][] = 'kiso/nodes';
  $variables['#attached']['library'][] = 'kiso/miscs';

  // Enable the "Back to top" button.
  $variables['backtotop_enable'] = theme_get_setting('backtotop_enable');
  $variables['backtotop_label'] = theme_get_setting('backtotop_label');
  $backtotop_enable = theme_get_setting('backtotop_enable');
  $backtotop_offset = theme_get_setting('backtotop_offset');
  $backtotop_mobile_hide = theme_get_setting('backtotop_mobile_hide');
  if (isset($backtotop_enable) and $backtotop_enable == '1') {
    $variables['#attached']['library'][] = 'kiso/back-to-top';
  }
  if (isset($backtotop_offset)) {
    $variables['#attached']['drupalSettings']['kiso']['backtotop']['offset'] = $backtotop_offset;
  }
  if (isset($backtotop_mobile_hide)) {
    $variables['#attached']['drupalSettings']['kiso']['backtotop']['mobile_hide'] = $backtotop_mobile_hide;
  }

  $smoothscroll_enable = theme_get_setting('smoothscroll_enable');
  if (isset($smoothscroll_enable) and $smoothscroll_enable == '1') {
    $variables['#attached']['library'][] = 'kiso/smooth-scroll';
  }
}
