<?php

/**
 * @file
 * Page attachments alter hooks.
 */

/**
 * Alter attachments (typically assets) to a page before it is rendered.
 *
 * @param array &$attachments
 *   Array of all attachments provided by hook_page_attachments() implementations.
 *
 * @see hook_page_attachments_alter()
 */
function kiso_page_attachments_alter(array &$attachments) {
  $theme_path = \Drupal::theme()->getActiveTheme()->getPath();
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'apple-touch-icon',
      'sizes' => '180x180',
      'href' => '/' . $theme_path . '/images/favicons/apple-touch-icon.png'
    )
  );
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'icon',
      'type' => 'image/png',
      'sizes' => '32x32',
      'href' => '/' . $theme_path . '/images/favicons/favicon.png'
    )
  );
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'icon',
      'type' => 'image/png',
      'sizes' => '64x64',
      'href' => '/' . $theme_path . '/images/favicons/favicon@2x.png'
    )
  );
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'manifest',
      'href' => '/' . $theme_path . '/images/favicons/site.webmanifest'
    )
  );
  $attachments['#attached']['html_head_link'][] = array(
    array(
      'rel' => 'mask-icon',
      'href' => '/' . $theme_path . '/images/favicons/safari-pinned-tab.svg',
      'color' => '#817c00'
    )
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
  $attachments['#attached']['html_head'][] = array(
    array(
      '#tag' => 'meta',
      '#attributes' => array(
        'name' => 'theme-color',
        'content' => '#ffffff',
      )
    ),
    'theme-color',
  );
}
