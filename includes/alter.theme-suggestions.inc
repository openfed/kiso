<?php

/**
 * @file
 * Alters named suggestions for a specific theme hook.
 *
 * Following hooks allow any module or theme to provide alternative theme function
 * or template name suggestions and reorder or remove suggestions provided by
 * hook_theme_suggestions_HOOK() or by earlier invocations of these hooks.
 */

use Drupal\block\Entity\Block;

/**
 * Implements hook_theme_suggestions_HOOK_alter() for `page` templates.
 */
function kiso_theme_suggestions_page_alter(array &$suggestions, array $variables) {
  // Add template suggestions for pages 40[x].
  $http_error_suggestions = [
    '401',
    '403',
    '404',
  ];
  if ($exception = \Drupal::request()->get('exception')) {
    $status_code = $exception->getStatusCode();
    if (in_array($status_code, $http_error_suggestions)) {
      $suggestions[] = 'page__error';
    }
  }
  // Add template suggestions for content type.
  if ($node = \Drupal::request()->attributes->get('node')) {

    // in revision $node is a int returned as string
    // check if $node is a numeric and check if parsing int work (if not intval return 0)
    if (is_numeric($node) && intval($node) > 0) {
      $node = \Drupal\node\Entity\Node::load(intval($node));
    }

    // if $node is a Node
    if ($node instanceof \Drupal\node\Entity\Node) {
      array_splice($suggestions, 1, 0, 'page__node__' . $node->getType());
    }
  }
}

/**
 * Implements hook_theme_suggestions_HOOK_alter() for `block` templates.
 */
function kiso_theme_suggestions_block_alter(array &$suggestions, array $variables) {
  // Prepare the '$region' variable to add specific block
  // templates according to the region it is placed in.
  if (isset($variables['elements']['#id'])) {
    if ($block = Block::load($variables['elements']['#id'])) {
      $region = $block->getRegion();
    }
  }
  // This 'else if' is only for 'page_manager' module.
  else if (isset($variables['elements']['#configuration']['region'])) {
    $region = $variables['elements']['#configuration']['region'];
  }

  // Add template suggestion for blocks which need to use HTML5 '<aside>'
  // element to assign the 'complementary' landmark role to each content
  // designed to be complementary to the main content (at a similar level
  // in the DOM hierarchy).
  if (isset($region) && $region == 'complementary') {
    $suggestions[] = 'block__' . $region . '_landmark';
  }

  // Add template suggestion for the 'Language switcher' block which needs
  // to use HTML5 '<nav>' element to assign the 'navigation' landmark role.
  if (isset($variables['elements']['#base_plugin_id']) && $variables['elements']['#base_plugin_id'] == 'language_block') {
    $suggestions[] = 'block__navigation_landmark';
  }
}
