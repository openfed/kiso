<?php

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Theme\ThemeSettings;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\Core\Form;

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * Allow themes to alter the theme-specific settings form.
 *
 * With this hook, themes can alter the theme-specific settings form in any way
 * allowable by Drupal's Form API, such as adding form elements, changing
 * default values and removing form elements. See the Form API documentation on
 * api.drupal.org for detailed information.
 *
 * Note that the base theme's form alterations will be run before any sub-theme
 * alterations.
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   The current state of the form.
 */
function kiso_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state) {
  $form['kiso_settings'] = array(
    '#type' => 'vertical_tabs',
    '#title' => t('Kiso settings'),
    '#default_tab' => 'edit-general',
    '#weight' => -1000,
  );

  /**
   * General settings
   */
  $form['general'] = array(
    '#type' => 'details',
    '#title' => t('General'),
    '#group' => 'kiso_settings',
  );
  // Container
  $form['general']['container'] = array(
    '#type' => 'details',
    '#title' => t('Container'),
    '#collapsible' => true,
    '#collapsed' => true,
  );
  $form['general']['container']['container_fluid'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fluid container'),
    '#default_value' => theme_get_setting('container_fluid'),
    '#description' => t("Uses the .container-fluid class instead of .container class."),
  );

  /**
   * Settings for Javascripts components
   */
  $form['javascripts'] = array(
    '#type' => 'details',
    '#title' => t('JavaScripts'),
    '#group' => 'kiso_settings',
  );
  // Back to Top
  $form['javascripts']['backtotop'] = array(
    '#type' => 'details',
    '#title' => t('Back to Top'),
    '#collapsible' => true,
    '#collapsed' => true,
  );
  $form['javascripts']['backtotop']['backtotop_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Back to Top'),
    '#default_value' => theme_get_setting('backtotop_enable'),
    '#description' => t("Enable the back to top button."),
  );
  $form['javascripts']['backtotop']['backtotop_options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Options'),
  );
  $form['javascripts']['backtotop']['backtotop_options']['backtotop_label'] = array(
    '#type' => 'textfield',
    '#title' => t('Label'),
    '#default_value' => theme_get_setting('backtotop_label'),
    '#description' => t("Change title of the link if needed. Default value is \"Back to top\""),
  );
  $form['javascripts']['backtotop']['backtotop_options']['backtotop_offset'] = array(
    '#type' => 'number',
    '#title' => t('Offset'),
    '#default_value' => theme_get_setting('backtotop_offset'),
    '#description' => t("The offset coordinates is used to set after how many pixels of scrolling the link will appear. Default value is 300."),
  );
  $form['javascripts']['backtotop']['backtotop_options']['backtotop_mobile_hide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hide on mobile'),
    '#default_value' => theme_get_setting('backtotop_mobile_hide'),
    '#description' => t("By checking this box, the back to top link won't appear on smaller devices according to the site's responsive breakpoints."),
  );
  // Smooth Scroll
  $form['javascripts']['smoothscroll'] = array(
    '#type' => 'details',
    '#title' => t('Smooth Scroll'),
    '#collapsible' => true,
    '#collapsed' => true,
  );
  $form['javascripts']['smoothscroll']['smoothscroll_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Smooth Scroll'),
    '#default_value' => theme_get_setting('smoothscroll_enable'),
    '#description' => t("Enable the smooth scroll behavior for anchor links."),
  );
}