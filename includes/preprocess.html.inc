<?php

/**
 * @file
 * Prepares variables for HTML document templates.
 */

/**
 * Implements hook_preprocess_HOOK() for html.html.twig.
 */
function kiso_preprocess_html(&$variables) {
  // Added body classes when sidebar(s) has (have) content.
  if (!empty($variables['page']['navigation']) && !empty($variables['page']['complementary'])) {
    $variables['attributes']['class'][] = 'sidebar';
    $variables['attributes']['class'][] = 'two-sidebars';
  }
  elseif (!empty($variables['page']['navigation'])) {
    $variables['attributes']['class'][] = 'sidebar';
    $variables['attributes']['class'][] = 'one-sidebar';
    $variables['attributes']['class'][] = 'is-visible--navigation';
  }
  elseif (!empty($variables['page']['complementary'])) {
    $variables['attributes']['class'][] = 'sidebar';
    $variables['attributes']['class'][] = 'one-sidebar';
    $variables['attributes']['class'][] = 'is-visible--complementary';
  }
  else {
    $variables['attributes']['class'][] = 'no-sidebars';
  }

  // Add body classes related to node content.
  $node = \Drupal::routeMatch()->getParameter('node');
  if ($node) {
    // Set the a class on unpublished nodes.
    if (!$node->status->value) {
      $variables['attributes']['class'][] = 'page--node--unpublished';
    }
  }

  // WCAG 2.0 - Guideline 3.1.1 – Language of Page (Level A).
  // Sufficient Technique H57: Using language attributes on the html element.
  $language = \Drupal::languageManager()->getCurrentLanguage();
  if (!$variables['html_attributes']->offsetExists('lang')) {
    $language_id = $language->getId();
    $variables['html_attributes']->setAttribute('lang', $language_id);
  }
}
