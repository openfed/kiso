<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Extension\ThemeSettingsProvider;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Hook implementations used to alter the theme settings form.
 */
class ThemeSettingsHooks {

  use StringTranslationTrait;

  /**
   * Constructs a ThemeSettingsHooks object.
   *
   * @param \Drupal\Core\Extension\ThemeSettingsProvider $themeSettings
   *   The theme settings provider service.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The module handler service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The config factory service.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $stringTranslation
   *   The string translation service.
   */
  public function __construct(
    protected readonly ThemeSettingsProvider $themeSettings,
    protected readonly ModuleHandlerInterface $moduleHandler,
    protected readonly ConfigFactoryInterface $configFactory,
    protected readonly MessengerInterface $messenger,
    TranslationInterface $stringTranslation,
  ) {
    $this->setStringTranslation($stringTranslation);
  }

  /**
   * Implements hook_form_system_theme_settings_alter().
   *
   * Allow themes to alter the theme-specific settings form.
   *
   * With this hook, themes can alter the theme-specific settings form in any
   * way allowable by Drupal's Form API, such as adding form elements, changing
   * default values and removing form elements. See the Form API documentation
   * on api.drupal.org for detailed information.
   *
   * Note that the base theme's form alterations will be run before any
   * sub-theme alterations.
   *
   * @param array $form
   *   Nested array of form elements that comprise the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  #[Hook('form_system_theme_settings_alter')]
  public function formSystemThemeSettingsAlter(array &$form, FormStateInterface $form_state): void {
    $theme_settings = $this->themeSettings;
    $form['kiso_settings'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Kiso settings'),
      '#default_tab' => 'edit-general',
      '#weight' => -1000,
    ];
    // General settings.
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General'),
      '#group' => 'kiso_settings',
    ];
    // Container.
    $form['general']['container'] = [
      '#type' => 'details',
      '#title' => $this->t('Container'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['general']['container']['container_fluid'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Fluid container'),
      '#default_value' => $theme_settings->getSetting('container_fluid'),
      '#description' => $this->t("Uses the .container-fluid class instead of .container class."),
    ];
    // Settings for Javascripts components.
    $form['javascripts'] = [
      '#type' => 'details',
      '#title' => $this->t('JavaScripts'),
      '#group' => 'kiso_settings',
    ];
    // Keyboard Focus Tracking.
    $form['javascripts']['trackfocus'] = [
      '#type' => 'details',
      '#title' => $this->t('Keyboard Focus Tracking'),
      '#description' => $this->t('The <em>Keyboard Focus Tracking</em> is based on the <em><a href="https://github.com/ten1seven/what-input">What Input</a></em> GitHub library, a global utility for tracking the current input method (mouse, keyboard or touch).<br><br><strong>Note:</strong> Since interacting with a form always requires use of the keyboard, <em>What Input</em> uses the <code>data-whatintent</code> attribute to display a "buffered" version of input events while form <code>&lt;input&gt;</code>s, <code>&lt;select&gt;</code>s, and <code>&lt;textarea&gt;</code>s are being interacted with (i.e. mouse user\'s <code>data-whatintent</code> will be preserved as <code>mouse</code> while typing).'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['javascripts']['trackfocus']['trackfocus_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable the "Keyboard Focus Tracking" indicator'),
      '#default_value' => $theme_settings->getSetting('trackfocus_enable'),
      '#description' => $this->t('Display a unique highly visible <em>keyboard only</em> focus indicator <strong>for all focusable elements</strong> using a combination of a highly contrasting style.'),
    ];
    $form['javascripts']['trackfocus']['trackfocus_options'] = [
      '#type' => 'details',
      '#title' => $this->t('Options'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#states' => ['visible' => [':input[name="trackfocus_enable"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['trackfocus']['trackfocus_options']['trackfocus_disable_persist'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable persisting input/intent across pages'),
      '#default_value' => $theme_settings->getSetting('trackfocus_disable_persist'),
      '#description' => $this->t('By default, <em>What Input</em> uses <a href="https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage">session storage</a> to persist the input and intent values across pages. The benefit is that once a visitor has interacted with the page, subsequent pages won\'t have to wait for interactions to know the input method.'),
    ];
    // Smooth Scroll.
    $form['javascripts']['smoothscroll'] = [
      '#type' => 'details',
      '#title' => $this->t('Smooth Scroll'),
      '#description' => $this->t('The <em>Smooth Scrolling</em> enhances your Web site with a nice effect that slows down the scrolling when jumping to another part of your page.'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['javascripts']['smoothscroll']['smoothscroll_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable the "Smooth Scroll" behavior'),
      '#default_value' => $theme_settings->getSetting('smoothscroll_enable'),
      '#description' => $this->t('Enable the smooth scroll effect for <code>#hash</code> links.'),
    ];
    $form['javascripts']['smoothscroll']['smoothscroll_a11y'] = [
      '#type' => 'details',
      '#title' => $this->t('Motion and Accessibility'),
      '#description' => $this->t('Some people can <a href="https://www.theguardian.com/technology/2013/sep/27/ios-7-motion-sickness-nausea">literally get sick</a> from the fast movement on the screen. We would recommend a slow speed of the motion <em>(1000 milliseconds by default)</em> because if the <a href="http://alistapart.com/article/designing-safer-web-animation-for-motion-sensitivity#section5">user is going to jump across a lot of content</a>, it can cause a dizzying effect if it’s too fast.'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#states' => ['visible' => [':input[name="smoothscroll_enable"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['smoothscroll']['smoothscroll_a11y']['smoothscroll_speed'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Motion speed:'),
      '#default_value' => $theme_settings->getSetting('smoothscroll_speed'),
      '#description' => $this->t('The speed of the motion to jump across the content (in milliseconds).'),
    ];
    // Outdated Browser.
    $form['javascripts']['outdatedbrowser'] = [
      '#type' => 'details',
      '#title' => $this->t('Outdated Browser'),
      '#description' => $this->t('<strong><a href="http://outdatedbrowser.com/en">Outdated Browser</a></strong> is a time saving tool for developers. With this solution it will be possible to check if the user’s <em>Microsoft</em> browser can handle your website. If not, it will show a notice advising the user to update his browser for latest versions. It will be up to the user to upgrade... or not.'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['javascripts']['outdatedbrowser']['outdatedbrowser_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable the "Outdated Browser" warning message'),
      '#default_value' => $theme_settings->getSetting('outdatedbrowser_enable'),
      '#description' => $this->t('Detect outdated <em>Microsoft Internet Explorer</em> browsers and advise users to upgrade to a new version.'),
    ];
    $form['javascripts']['outdatedbrowser']['outdatedbrowser_options'] = [
      '#type' => 'details',
      '#title' => $this->t('Options'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#states' => ['visible' => [':input[name="outdatedbrowser_enable"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['outdatedbrowser_ie_target'] = [
      '#title' => $this->t('IE target versions:'),
      '#type' => 'select',
      '#options' => [
        '9' => $this->t('IE 9 and lower'),
        '10' => $this->t('IE 10 and lower'),
        '11' => $this->t('IE 11 and lower'),
      ],
      '#default_value' => $theme_settings->getSetting('outdatedbrowser_ie_target'),
      '#description' => $this->t('Select the <em>Microsoft Internet Explorer</em> versions that will trigger the warning message display (e.g. "IE 11 and lower" for IE 11, 10, 9 and 8 browser versions at least).'),
    ];
    $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['css_matching'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('CSS Matching'),
      '#description' => $this->t('Use CSS selectors to only look inside explicitly or exclude entirely specified <code>&lt;body&gt;</code> classes which will identify specific Website pages to trigger the warning message display.'),
    ];
    $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['css_matching']['outdatedbrowser_css_explicit'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Only look for Website pages inside these CSS selectors:'),
      '#maxlength' => NULL,
      '#default_value' => $theme_settings->getSetting('outdatedbrowser_css_explicit'),
      '#description' => $this->t('Enter a comma-separated list of CSS selectors (e.g. <code>.page--frontpage, .page--node-type-news, .not-logged-in</code>).'),
    ];
    $form['javascripts']['outdatedbrowser']['outdatedbrowser_options']['css_matching']['outdatedbrowser_css_exclude'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Exclude Website pages inside these CSS selectors:'),
      '#maxlength' => NULL,
      '#default_value' => $theme_settings->getSetting('outdatedbrowser_css_exclude'),
      '#description' => $this->t('Enter a comma-separated list of CSS selectors (e.g. <code>.page--contact, .logged-in, .no-sidebars</code>).'),
    ];
    // External Links (New Window)
    $form['javascripts']['extlinkwindow'] = [
      '#type' => 'details',
      '#title' => $this->t('External Links (New Window)'),
      '#description' => $this->t('Extends the Drupal "<a href="https://www.drupal.org/project/extlink">External Links <em>(extlink 8.x-1.2)</em></a>" contributed module giving users advanced warning when opening in a new window or tab.'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable "External Links" (New Window)'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_enabled'),
      '#description' => $this->t('Enable the "External Links" (New Window) behavior for links that open in a new window.'),
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options'] = [
      '#type' => 'details',
      '#title' => $this->t('Options'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#states' => ['visible' => [':input[name="extlinkwindow_enabled"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_extlink_custom_label'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Customize the warning message for the external links'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_extlink_custom_label'),
      '#description' => $this->t('If you check this box you can choose which message will be used to warn users when the external links open in a new window.'),
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_extlink_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text to use for the external links:'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_extlink_label'),
      '#description' => $this->t('Change the warning message of the external links opening in a new window if needed. Default value is "(link is external and opens a new window)".'),
      '#states' => ['visible' => [':input[name="extlinkwindow_extlink_custom_label"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Internal links'),
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink']['extlinkwindow_intlink_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Include links having the same domain and opening in a new window'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_intlink_enabled'),
      '#description' => $this->t('Checking this box will automatically include all other links having the same domain (internal) and which open in a new window.'),
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink']['extlinkwindow_intlink_custom_label'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Customize the warning message for the internal links'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_intlink_custom_label'),
      '#description' => $this->t('If you check this box you can choose which message will be used to warn users when the internal links open in a new window.'),
      '#states' => ['visible' => [':input[name="extlinkwindow_intlink_enabled"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_intlink']['extlinkwindow_intlink_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text to use for the internal links:'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_intlink_label'),
      '#description' => $this->t('Change the warning message of the internal links opening in a new window if needed. Default value is "(link opens a new window)".'),
      '#states' => ['visible' => [':input[name="extlinkwindow_intlink_custom_label"]' => ['checked' => TRUE]]],
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Font Awesome icons'),
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome']['extlinkwindow_font_awesome_custom_class'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Customize the Font Awesome icon for links opening in a new window'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_font_awesome_custom_class'),
      '#description' => $this->t('Checking this box will allow you to customize the Font Awesome icon (used instead of SVG image) for links opening in a new window (<a href="/admin/config/user-interface/extlink">see the "External Links" settings page</a>).'),
    ];
    $form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome']['extlinkwindow_font_awesome_class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Awesome icon class (links opening in a new window):'),
      '#default_value' => $theme_settings->getSetting('extlinkwindow_font_awesome_class'),
      '#states' => ['visible' => [':input[name="extlinkwindow_font_awesome_custom_class"]' => ['checked' => TRUE]]],
    ];
    // Tooltip Widget.
    $form['javascripts']['tooltip'] = [
      '#type' => 'details',
      '#title' => $this->t('Tooltip'),
      '#description' => $this->t('<strong><a href="https://www.w3.org/TR/wai-aria-practices-1.1/#tooltip">Tooltip Widget</a></strong> are popups that display information related to a <strong>Semantic (Web Font) Icon</strong> when it receives keyboard focus or the mouse hovers over it. It typically appears after a small delay and disappears when <code>Escape</code> is pressed or on mouse out. <strong><a href="https://www.w3.org/WAI/WCAG21/Techniques/aria/ARIA24.html">Semantic Icons</a></strong> are ones that you are using to convey meaning, rather than just pure decoration.'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['javascripts']['tooltip']['tooltip_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Tooltip Widget'),
      '#default_value' => $theme_settings->getSetting('tooltip_enabled'),
      '#description' => $this->t('Elements that have <code>[role="img"][aria-label]</code> or <code>[data-pattern="tooltip"][title]</code> attributes set will automatically initialize the tooltip upon page load.'),
    ];
    $form['javascripts']['tooltip']['tooltip_delay'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Delay'),
      '#default_value' => $theme_settings->getSetting('tooltip_delay'),
      '#description' => $this->t('The amount of time to delay showing the tooltip (in milliseconds).'),
      '#states' => ['visible' => [':input[name="tooltip_enabled"]' => ['checked' => TRUE]]],
    ];
    // Back to Top.
    $form['javascripts']['backtotop'] = [
      '#type' => 'details',
      '#title' => $this->t('Back to Top'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];
    $form['javascripts']['backtotop']['backtotop_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Back to Top'),
      '#default_value' => $theme_settings->getSetting('backtotop_enable'),
      '#description' => $this->t("Enable the back to top button."),
    ];
    $form['javascripts']['backtotop']['backtotop_options'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Options'),
    ];
    $form['javascripts']['backtotop']['backtotop_options']['backtotop_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => $theme_settings->getSetting('backtotop_label'),
      '#description' => $this->t('Change title of the link if needed. Default value is "Back to top".'),
    ];
    $form['javascripts']['backtotop']['backtotop_options']['backtotop_offset'] = [
      '#type' => 'number',
      '#title' => $this->t('Offset'),
      '#default_value' => $theme_settings->getSetting('backtotop_offset'),
      '#description' => $this->t("The offset coordinates is used to set after how many pixels of scrolling the link will appear. Default value is 300."),
    ];
    $form['javascripts']['backtotop']['backtotop_options']['backtotop_mobile_hide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide on mobile'),
      '#default_value' => $theme_settings->getSetting('backtotop_mobile_hide'),
      '#description' => $this->t("By checking this box, the back to top link won't appear on smaller devices according to the site's responsive breakpoints."),
    ];
    // Display a warning if the "External Links" module is not enabled.
    if ($theme_settings->getSetting('extlinkwindow_enabled') && !$this->moduleHandler->moduleExists('extlink')) {
      $this->messenger->addError($this->t('The <strong><a href="https://www.drupal.org/project/extlink">External Links</a></strong> module is not enabled. The <strong>External Links (New Window)</strong> JavaScript requires this module to work with additional libraries.<br />Please enable <a href="https://www.drupal.org/project/extlink">External Links</a> 8.x-1.1 or higher, you must manually set this in the configuration after it is installed.'));
    }
    // Get the "External Links" module settings to manage form elements
    // visibility.
    if ($this->moduleHandler->moduleExists('extlink')) {
      $config = $this->configFactory->get('extlink.settings');
      $settings = $config->getRawData();
      // Do not display icon customization settings if the "External Links"
      // module does not use Font Awesome icons.
      if (empty($settings['extlink_use_font_awesome'])) {
        unset($form['javascripts']['extlinkwindow']['extlinkwindow_options']['extlinkwindow_font_awesome']);
      }
      // Check if the icon placement is set to "before" or "after" and display
      // a warning.
      if ($theme_settings->getSetting('extlinkwindow_enabled') && isset($settings['extlink_icon_placement']) && in_array($settings['extlink_icon_placement'], [
        'before',
        'after',
      ])) {
        $this->messenger->addWarning($this->t('The <strong>External Links</strong> module has icon placement set to "@placement". For optimal compatibility with the <strong>External Links (New Window)</strong> feature, please change the icon placement to "prepend" or "append" in the <a href="@config_url">External Links configuration</a>.', [
          '@placement' => $settings['extlink_icon_placement'],
          '@config_url' => '/admin/config/user-interface/extlink',
        ]));
      }
    }
  }

}
