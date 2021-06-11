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
  // Keyboard Focus Tracking
  $form['javascripts']['trackfocus'] = array(
    '#type' => 'details',
    '#title' => t('Keyboard Focus Tracking'),
    '#description' => t('The <em>Keyboard Focus Tracking</em> is based on the <em><a href="https://github.com/ten1seven/what-input">What Input</a></em> GitHub library, a global utility for tracking the current input method (mouse, keyboard or touch).<br><br><strong>Note:</strong> Since interacting with a form always requires use of the keyboard, <em>What Input</em> uses the <code>data-whatintent</code> attribute to display a "buffered" version of input events while form <code>&lt;input&gt;</code>s, <code>&lt;select&gt;</code>s, and <code>&lt;textarea&gt;</code>s are being interacted with (i.e. mouse user\'s <code>data-whatintent</code> will be preserved as <code>mouse</code> while typing).'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascripts']['trackfocus']['trackfocus_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable the "Keyboard Focus Tracking" indicator'),
    '#default_value' => theme_get_setting('trackfocus_enable'),
    '#description' => t('Display a unique highly visible <em>keyboard only</em> focus indicator <strong>for all focusable elements</strong> using a combination of a highly contrasting style.'),
  );
  $form['javascripts']['trackfocus']['trackfocus_options'] = array(
    '#type' => 'details',
    '#title' => t('Options'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => [
      'visible' => [':input[name="trackfocus_enable"]' => ['checked' => TRUE]],
    ],
  );
  $form['javascripts']['trackfocus']['trackfocus_options']['trackfocus_disable_persist'] = array(
    '#type' => 'checkbox',
    '#title' => t('Disable persisting input/intent across pages'),
    '#default_value' => theme_get_setting('trackfocus_disable_persist'),
    '#description' => t('By default, <em>What Input</em> uses <a href="https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage">session storage</a> to persist the input and intent values across pages. The benefit is that once a visitor has interacted with the page, subsequent pages won\'t have to wait for interactions to know the input method.'),
  );
  // Outdated Browser
  $form['javascripts']['outdatedbrowser'] = array(
    '#type' => 'details',
    '#title' => t('Outdated Browser'),
    '#description' => t('<strong><a href="http://outdatedbrowser.com/en">Outdated Browser</a></strong> is a time saving tool for developers. With this solution it will be possible to check if the user’s <em>Microsoft</em> browser can handle your website. If not, it will show a notice advising the user to update his browser for latest versions. It will be up to the user to upgrade... or not.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascripts']['outdatedbrowser']['outdatedbrowser_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable the "Outdated Browser" warning message'),
    '#default_value' => theme_get_setting('outdatedbrowser_enable'),
    '#description' => t('Detect outdated <em>Microsoft Internet Explorer</em> browsers and advise users to upgrade to a new version.'),
  );
  $form['javascripts']['outdatedbrowser']['outdatedbrowser_options'] = array(
    '#type' => 'details',
    '#title' => t('Options'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => [
      'visible' => [':input[name="outdatedbrowser_enable"]' => ['checked' => TRUE]],
    ],
  );
  $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['outdatedbrowser_ie_target'] = array(
    '#title' => t('IE target versions:'),
    '#type' => 'select',
    '#options' => array(
      '9' => t('IE 9 and lower'),
      '10' => t('IE 10 and lower'),
      '11' => t('IE 11 and lower'),
    ),
    '#default_value' => theme_get_setting('outdatedbrowser_ie_target'),
    '#description' => t('Select the <em>Microsoft Internet Explorer</em> versions that will trigger the warning message display (e.g. "IE 11 and lower" for IE 11, 10, 9 and 8 browser versions at least).'),
  );
  $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['css_matching'] = array(
    '#type' => 'fieldset',
    '#title' => t('CSS Matching'),
    '#description' => t('Use CSS selectors to only look inside explicitly or exclude entirely specified <code>&lt;body&gt;</code> classes which will identify specific Website pages to trigger the warning message display.'),
  );
  $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['css_matching']['outdatedbrowser_css_explicit'] = array(
    '#type' => 'textarea',
    '#title' => t('Only look for Website pages inside these CSS selectors:'),
    '#maxlength' => NULL,
    '#default_value' => theme_get_setting('outdatedbrowser_css_explicit'),
    '#description' => t('Enter a comma-separated list of CSS selectors (e.g. <code>.page--frontpage, .page--node-type-news, .not-logged-in</code>).'),
  );
  $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['css_matching']['outdatedbrowser_css_exclude'] = array(
    '#type' => 'textarea',
    '#title' => t('Exclude Website pages inside these CSS selectors:'),
    '#maxlength' => NULL,
    '#default_value' => theme_get_setting('outdatedbrowser_css_exclude'),
    '#description' => t('Enter a comma-separated list of CSS selectors (e.g. <code>.page--contact, .logged-in, .no-sidebars</code>).'),
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
