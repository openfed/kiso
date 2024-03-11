<?php

/**
 * @file
 * Page attachments alter hooks.
 */

use Drupal\Component\Utility\Html;

/**
 * Alter attachments (typically assets) to a page before it is rendered.
 *
 * @param array &$attachments
 *   Array of all attachments provided by hook_page_attachments() implementations.
 *
 * @see hook_page_attachments_alter()
 */
function kiso_page_attachments_alter(array &$attachments)
{
  $theme_path = \Drupal::theme()->getActiveTheme()->getPath();

  // Favicon for iOS - Web Clip.
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'apple-touch-icon',
      'sizes' => '180x180',
      'href' => '/' . $theme_path . '/images/favicons/apple-touch-icon.png'
    )
  );

  // Favicon for Desktop Browsers and Google Result Pages.
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'icon',
      'type' => 'image/png',
      'sizes' => '16x16',
      'href' => '/' . $theme_path . '/images/favicons/favicon-16x16.png'
    )
  );
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'icon',
      'type' => 'image/png',
      'sizes' => '32x32',
      'href' => '/' . $theme_path . '/images/favicons/favicon-32x32.png'
    )
  );

  // Favicon for Android Chrome.
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'manifest',
      'href' => '/' . $theme_path . '/images/favicons/site.webmanifest'
    )
  );

  // macOS Safari.
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'mask-icon',
      'href' => '/' . $theme_path . '/images/favicons/safari-pinned-tab.svg',
      'color' => '#405b77'
    )
  );

  // Windows Metro.
  $attachments['#attached']['html_head'][] = array(
    array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'msapplication-TileColor',
        'content' => '#405b77',
      )
    ),
    'msapplication-tilecolor',
  );
  $attachments['#attached']['html_head'][] = array(
    array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'msapplication-TileImage',
        'content' => '/' . $theme_path . '/images/favicons/mstile-144x144.png',
      )
    ),
    'msapplication-tileimage',
  );
  $attachments['#attached']['html_head'][] = array(
    array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'msapplication-config',
        'content' => '/' . $theme_path . '/images/favicons/browserconfig.xml',
      )
    ),
    'msapplication-config',
  );

  // Theme color.
  $attachments['#attached']['html_head'][] = array(
    array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'theme-color',
        'content' => '#405b77',
      )
    ),
    'theme-color',
  );

  // Load the "External Links" (New Window) library.
  $moduleHandler = \Drupal::service('module_handler');
  if ($moduleHandler->moduleExists('extlink') && theme_get_setting('extlinkwindow_enabled')) {
    $attachments['#attached']['library'][] = 'kiso/extlink-window';
    $config = \Drupal::config('kiso.settings');

    // Prepare configurable theme settings.
    $extlink_label = (theme_get_setting('extlinkwindow_extlink_custom_label')) ? Html::escape(theme_get_setting('extlinkwindow_extlink_label')) : $config->get('extlinkwindow_extlink_label');
    $intlink_label = (theme_get_setting('extlinkwindow_intlink_custom_label')) ? Html::escape(theme_get_setting('extlinkwindow_intlink_label')) : $config->get('extlinkwindow_intlink_label');
    $font_awesome_class = (theme_get_setting('extlinkwindow_font_awesome_custom_class')) ? theme_get_setting('extlinkwindow_font_awesome_class') : $config->get('extlinkwindow_font_awesome_class');

    // Attach configurable JavaScript.
    $attachments['#attached']['drupalSettings']['kiso']['extlinkWindow'] = [
      'viewBoxSquare'    => '0 0 512 512',
      'viewBoxRect'      => '0 0 448 512',
      'extlinkLabel'     => t($extlink_label),
      'intlinkLabel'     => t($intlink_label),
      'fontAwesomeClass' => $font_awesome_class,
      'intlinkEnabled'   => theme_get_setting('extlinkwindow_intlink_enabled'),
      'extlinkShapeData' => 'M448 80v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48zm-88 16H248.029c-21.313 0-32.08 25.861-16.971 40.971l31.984 31.987L67.515 364.485c-4.686 4.686-4.686 12.284 0 16.971l31.029 31.029c4.687 4.686 12.285 4.686 16.971 0l195.526-195.526 31.988 31.991C358.058 263.977 384 253.425 384 231.979V120c0-13.255-10.745-24-24-24z',
      'mailtoShapeData'  => 'M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z',
      'intlinkShapeData' => 'M512 48v288c0 26.5-21.5 48-48 48h-48V176c0-44.1-35.9-80-80-80H128V48c0-26.5 21.5-48 48-48h288c26.5 0 48 21.5 48 48zM384 176v288c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48h288c26.5 0 48 21.5 48 48zm-68 28c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v52h252v-52z',
    ];
  }

  // Load the "Tooltip" library.
  if (theme_get_setting('tooltip_enabled')) {
    $attachments['#attached']['library'][] = 'kiso/tooltip';
    $config = \Drupal::config('kiso.settings');
    // Attach configurable JavaScript.
    $attachments['#attached']['drupalSettings']['kiso']['tooltip'] = [
      'delay' => !empty(theme_get_setting('tooltip_delay')) ? theme_get_setting('tooltip_delay') : $config->get('tooltip_delay'),
    ];
  }

  // Load the "Outdated Browser" library.
  if (theme_get_setting('outdatedbrowser_enable')) {
    $attachments['#attached']['library'][] = 'kiso/outdated-browser';

    // IE target versions.
    $attachments['#attached']['html_head'][] = array(
      array(
        '#tag' => 'meta',
        '#attributes' => array(
          'name' => 'outdatedbrowser-ieTarget',
          'content' => theme_get_setting('outdatedbrowser_ie_target'),
        )
      ),
      'outdatedbrowser-ie-target',
    );

    // Only look for Website pages inside CSS selectors.
    if (!empty(theme_get_setting('outdatedbrowser_css_explicit'))) {
      $attachments['#attached']['html_head'][] = array(
        array(
          '#tag' => 'meta',
          '#attributes' => array(
            'name' => 'outdatedbrowser-cssExplicit',
            'content' => theme_get_setting('outdatedbrowser_css_explicit'),
          )
        ),
        'outdatedbrowser-css-explicit',
      );
    }

    // Exclude Website pages inside CSS selectors.
    if (!empty(theme_get_setting('outdatedbrowser_css_exclude'))) {
      $attachments['#attached']['html_head'][] = array(
        array(
          '#tag' => 'meta',
          '#attributes' => array(
            'name' => 'outdatedbrowser-cssExclude',
            'content' => theme_get_setting('outdatedbrowser_css_exclude'),
          )
        ),
        'outdatedbrowser-css-exclude',
      );
    }
  }

  // Load the "Keyboard Focus Tracking" library.
  if (theme_get_setting('trackfocus_enable')) {
    $attachments['#attached']['library'][] = 'kiso/track-focus';
  }

  // Load the "Smooth Scrolling" library.
  if (theme_get_setting('smoothscroll_enable')) {
    $attachments['#attached']['library'][] = 'kiso/smooth-scroll';
    $config = \Drupal::config('kiso.settings');
    // Attach configurable JavaScript.
    $attachments['#attached']['drupalSettings']['kiso']['smoothscroll'] = [
      'speed' => !empty(theme_get_setting('smoothscroll_speed')) ? theme_get_setting('smoothscroll_speed') : $config->get('smoothscroll_speed'),
    ];
  }

  // Enabling the css depending on the option given in the theme settings

  // Load the "Reboot" (Structural rules) libraries.
  if (theme_get_setting('reboot_enable')) {
    $attachments['#attached']['library'][] = 'kiso/reboot';
  }
  // Load the "Elements" (Styles) library.
  if (theme_get_setting('elements_enable')) {
    $attachments['#attached']['library'][] = 'kiso/elements';
  }

  // Load the "Layout" (Styles) library.
  if (theme_get_setting('layout_enable')) {
    $attachments['#attached']['library'][] = 'kiso/layout';
  }
  // Load the "Components" (Structural rules) libraries.
  if (theme_get_setting('components_enable')) {
    $attachments['#attached']['library'][] = 'kiso/blocks';
    $attachments['#attached']['library'][] = 'kiso/navigations';
    $attachments['#attached']['library'][] = 'kiso/forms';
    $attachments['#attached']['library'][] = 'kiso/fields';
    $attachments['#attached']['library'][] = 'kiso/nodes';
    $attachments['#attached']['library'][] = 'kiso/miscs';
  }
}
function kiso_css_alter(&$css) {
  $settings = [
    // Base elements.
    'themes/contrib/kiso/css/base/elements/selection.css' => 'elements_selection_enable',
    'themes/contrib/kiso/css/base/elements/root.css' => 'elements_root_enable',
    'themes/contrib/kiso/css/base/elements/headings.css' => 'elements_headings_enable',
    'themes/contrib/kiso/css/base/elements/typography.css' => 'elements_typography_enable',
    'themes/contrib/kiso/css/base/elements/blockquotes.css' => 'elements_blockquotes_enable',
    'themes/contrib/kiso/css/base/elements/lists.css' => 'elements_lists_enable',
    'themes/contrib/kiso/css/base/elements/media.css' => 'elements_media_enable',
    'themes/contrib/kiso/css/base/elements/code.css' => 'elements_code_enable',
    'themes/contrib/kiso/css/base/elements/tables.css' => 'elements_tables_enable',
    'themes/contrib/kiso/css/base/elements/forms.css' => 'elements_forms_enable',

    // Layout.
    'themes/contrib/kiso/css/layout/grid.css' => 'grid_enable',
    'themes/contrib/kiso/css/layout/page/wrapper.css' => 'page_wrapper_enable',
    'themes/contrib/kiso/css/layout/page/section.css' => 'page_section_enable',
    'themes/contrib/kiso/css/layout/region/header-collapsible.css' => 'header_collapsible_enable',

    // Components.
    'themes/contrib/kiso/css/components/block/branding.css' => 'branding_enable',
    'themes/contrib/kiso/css/components/navigation/breadcrumb.css' => 'breadcrumb_enable',
    'themes/contrib/kiso/css/components/navigation/menu.css' => 'menu_enable',
    'themes/contrib/kiso/css/components/navigation/menu-menubar.css' => 'menu_menubar_enable',
    'themes/contrib/kiso/css/components/navigation/menu-footer.css' => 'menu_footer_enable',
    'themes/contrib/kiso/css/components/navigation/action-links.css' => 'action_links_enable',
    'themes/contrib/kiso/css/components/navigation/links.css' => 'links_enable',
    'themes/contrib/kiso/css/components/navigation/tabs.css' => 'tabs_enable',
    'themes/contrib/kiso/css/components/navigation/pager.css' => 'pager_enable',
    'themes/contrib/kiso/css/components/dataset/item-list.css' => 'item_list_enable',
    'themes/contrib/kiso/css/components/form/button.css' => 'form_button_enable',
    'themes/contrib/kiso/css/components/form/element.css' => 'form_element_enable',
    'themes/contrib/kiso/css/components/form/element-label.css' => 'form_element_label_enable',
    'themes/contrib/kiso/css/components/form/controls.css' => 'form_controls_enable',
    'themes/contrib/kiso/css/components/form/checks.css' => 'form_checks_enable',
    'themes/contrib/kiso/css/components/field/label-inline.css' => 'inline_labels_enable',
    'themes/contrib/kiso/css/components/field/text-formatted.css' => 'text_formatted_enable',
    'themes/contrib/kiso/css/components/field/multiple-value-form.css' => 'multiple_value_form_enable',
    'themes/contrib/kiso/css/components/field/file.css' => 'file_enable',
    'themes/contrib/kiso/css/components/node/unpublished.css' => 'unpublished_node_enable',
    'themes/contrib/kiso/css/components/misc/skip-link.css' => 'skip_link_enable',
    'themes/contrib/kiso/css/components/misc/noscript.css' => 'noscript_enable',
    'themes/contrib/kiso/css/components/misc/messages.css' => 'messages_enable',
    'themes/contrib/kiso/css/components/navigation/links--language-block.css' => 'language_block_links_enable'
  ];

  foreach ($settings as $css_file => $setting) {
    if (!theme_get_setting($setting)) {
      unset($css[$css_file]);
    }
  }
}
