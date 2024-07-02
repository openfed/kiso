<?php

/**
 * @file
 * Utilities alter hooks.
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_alter().
 */
function kiso_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Add unique ID to forms.
  $form['#id'] = Html::getUniqueId($form['#id']);
}