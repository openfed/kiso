<?php

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Theme\ThemeSettings;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\Core\Form;
use Drupal\Core\Messenger;

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
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
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
  // External Links (New Window)
  $form['javascripts']['extlinkwindow'] = array(
    '#type' => 'details',
    '#title' => t('External Links (New Window)'),
    '#description' => t('Extends the Drupal "<a href="https://www.drupal.org/project/extlink">External Links <em>(extlink 8.x-1.2)</em></a>" contributed module giving users advanced warning when opening in a new window or tab.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable "External Links" (New Window)'),
    '#default_value' => theme_get_setting('extlinkwindow_enabled'),
    '#description' => t('Enable the "External Links" (New Window) behavior for links that open in a new window.'),
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options'] = array(
    '#type' => 'details',
    '#title' => t('Options'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => [
      'visible' => [':input[name="extlinkwindow_enabled"]' => ['checked' => TRUE]],
    ],
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_extlink_custom_label'] = array(
    '#type' => 'checkbox',
    '#title' => t('Customize the warning message for the external links'),
    '#default_value' => theme_get_setting('extlinkwindow_extlink_custom_label'),
    '#description' => t('If you check this box you can choose which message will be used to warn users when the external links open in a new window.'),
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_extlink_label'] = array(
    '#type' => 'textfield',
    '#title' => t('Text to use for the external links:'),
    '#default_value' => theme_get_setting('extlinkwindow_extlink_label'),
    '#description' => t('Change the warning message of the external links opening in a new window if needed. Default value is "(link is external and opens a new window)".'),
    '#states' => [
      'visible' => [':input[name="extlinkwindow_extlink_custom_label"]' => ['checked' => TRUE]],
    ],
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink'] = array(
    '#type' => 'fieldset',
    '#title' => t('Internal links'),
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink']['extlinkwindow_intlink_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include links having the same domain and opening in a new window'),
    '#default_value' => theme_get_setting('extlinkwindow_intlink_enabled'),
    '#description' => t('Checking this box will automatically include all other links having the same domain (internal) and which open in a new window.'),
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink']['extlinkwindow_intlink_custom_label'] = array(
    '#type' => 'checkbox',
    '#title' => t('Customize the warning message for the internal links'),
    '#default_value' => theme_get_setting('extlinkwindow_intlink_custom_label'),
    '#description' => t('If you check this box you can choose which message will be used to warn users when the internal links open in a new window.'),
    '#states' => [
      'visible' => [
        ':input[name="extlinkwindow_intlink_enabled"]' => ['checked' => TRUE],
      ],
    ],
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink']['extlinkwindow_intlink_label'] = array(
    '#type' => 'textfield',
    '#title' => t('Text to use for the internal links:'),
    '#default_value' => theme_get_setting('extlinkwindow_intlink_label'),
    '#description' => t('Change the warning message of the internal links opening in a new window if needed. Default value is "(link opens a new window)".'),
    '#states' => [
      'visible' => [
        ':input[name="extlinkwindow_intlink_custom_label"]' => ['checked' => TRUE],
      ],
    ],
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Awesome icons'),
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome']['extlinkwindow_font_awesome_custom_class'] = array(
    '#type' => 'checkbox',
    '#title' => t('Customize the Font Awesome icon for links opening in a new window'),
    '#default_value' => theme_get_setting('extlinkwindow_font_awesome_custom_class'),
    '#description' => t('Checking this box will allow you to customize the Font Awesome icon (used instead of SVG image) for links opening in a new window (<a href="/admin/config/user-interface/extlink">see the "External Links" settings page</a>).'),
  );
  $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome']['extlinkwindow_font_awesome_class'] = array(
    '#type' => 'textfield',
    '#title' => t('Font Awesome icon class (links opening in a new window):'),
    '#default_value' => theme_get_setting('extlinkwindow_font_awesome_class'),
    '#states' => [
      'visible' => [':input[name="extlinkwindow_font_awesome_custom_class"]' => ['checked' => TRUE]],
    ],
  );
  // Tooltip Widget
  $form['javascripts']['tooltip'] = array(
    '#type' => 'details',
    '#title' => t('Tooltip'),
    '#description' => t('<strong><a href="https://www.w3.org/TR/wai-aria-practices-1.1/#tooltip">Tooltip Widget</a></strong> are popups that display information related to a <strong>Semantic (Web Font) Icon</strong> when it receives keyboard focus or the mouse hovers over it. It typically appears after a small delay and disappears when <code>Escape</code> is pressed or on mouse out. <strong><a href="https://www.w3.org/WAI/WCAG21/Techniques/aria/ARIA24.html">Semantic Icons</a></strong> are ones that you are using to convey meaning, rather than just pure decoration.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascripts']['tooltip']['tooltip_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Tooltip Widget'),
    '#default_value' => theme_get_setting('tooltip_enabled'),
    '#description' => t('Elements that have <code>[role="img"][aria-label]</code> or <code>[data-pattern="tooltip"][title]</code> attributes set will automatically initialize the tooltip upon page load.'),
  );
  $form['javascripts']['tooltip']['tooltip_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('Delay'),
    '#default_value' => theme_get_setting('tooltip_delay'),
    '#description' => t('The amount of time to delay showing the tooltip (in milliseconds).'),
    '#states' => [
      'visible' => [':input[name="tooltip_enabled"]' => ['checked' => TRUE]],
    ],
  );
  // Back to Top
  $form['javascripts']['backtotop'] = array(
    '#type' => 'details',
    '#title' => t('Back to Top'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
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
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascripts']['smoothscroll']['smoothscroll_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Smooth Scroll'),
    '#default_value' => theme_get_setting('smoothscroll_enable'),
    '#description' => t("Enable the smooth scroll behavior for anchor links."),
  );

  // Display a warning if the "External Links" module is not enabled.
  $moduleHandler = \Drupal::service('module_handler');
  if (theme_get_setting('extlinkwindow_enabled') && !$moduleHandler->moduleExists('extlink')) {
    $messenger = \Drupal::messenger();
    $messenger->addMessage(t('The <strong><a href="https://www.drupal.org/project/extlink">External Links</a></strong> module is not enabled. The <strong>External Links (New Window)</strong> JavaScript requires this module to work with additional libraries.<br />Please enable <a href="https://www.drupal.org/project/extlink">External Links</a> 8.x-1.1 or higher, you must manually set this in the configuration after it is installed.'), $messenger::TYPE_ERROR);
  }
  // Get the "External Links" module settings to manage form elements visibility.
  if ($moduleHandler->moduleExists('extlink') && $config = \Drupal::config('extlink.settings')) {
    $settings = $config->getRawData();
    // Do not display icon customization settings if the "External Links" module does not use Font Awesome icons.
    if (!$settings['extlink_use_font_awesome']) {
      unset($form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome']);
    }
  }
}