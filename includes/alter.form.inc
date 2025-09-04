<?php

/**
 * @file
 * Perform alterations before a form is rendered.
 */

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_alter().
 */
function kiso_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Ensures that Views exposed forms have unique HTML IDs by overriding the
  // '#id' property with a unique value. This prevents conflicts when multiple
  // exposed forms are rendered on the same page.
  // @see \Drupal\views\Form\ViewsExposedForm::buildForm()
  if ($form_id === 'views_exposed_form') {
    // Add unique ID to forms.
    $form['#id'] = Html::getUniqueId($form['#id']);
  }
}
