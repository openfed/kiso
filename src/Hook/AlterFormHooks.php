<?php

namespace Drupal\kiso\Hook;

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Hook\Attribute\Hook;

/**
 * Hook implementations used to alter forms.
 */
class AlterFormHooks {

  /**
   * Implements hook_form_alter().
   */
  #[Hook('form_alter')]
  public function formAlter(array &$form, FormStateInterface $form_state, string $form_id): void {
    // Ensures that Views exposed forms have unique HTML IDs by overriding the
    // '#id' property with a unique value. This prevents conflicts when multiple
    // exposed forms are rendered on the same page.
    // @see \Drupal\views\Form\ViewsExposedForm::buildForm()
    if ($form_id === 'views_exposed_form') {
      // Add unique ID to forms.
      $form['#id'] = Html::getUniqueId($form['#id']);
    }
  }

}
