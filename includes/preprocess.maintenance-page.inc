<?php

/**
 * @file
 * Prepares variables for maintenance page templates.
 */

use Drupal\Core\Extension\ThemeSettingsProvider;

/**
 * Implements hook_preprocess_HOOK() for maintenance-page.html.twig.
 */
function kiso_preprocess_maintenance_page(&$variables) {
  // Creates variables from theme settings.
  $variables['container_fluid'] = \Drupal::service(ThemeSettingsProvider::class)->getSetting('container_fluid');
}
