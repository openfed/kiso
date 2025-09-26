<?php

/**
 * @file
 * Post update functions for Kiso theme.
 */

/**
 * Add missing pager ellipsis translations.
 */
function kiso_post_update_add_pager_ellipsis_translations(&$sandbox) {
  /** @var \Drupal\locale\StringDatabaseStorage $storage */
  $storage = \Drupal::service('locale.storage');

  $translations = [
    '' => [
      'de' => 'Auslassungspunkte, die nicht sichtbare Seiten anzeigt',
      'fr' => 'Points de suspension indiquant des pages non visibles',
      'nl' => "Beletselteken die niet-zichtbare pagina's aangeeft",
    ],
  ];

  $source = 'Ellipsis indicating non-visible pages';
  foreach ($translations as $context => $strings) {
    foreach ($strings as $langcode => $translation) {
      $string = $storage->findString(['source' => $source, 'context' => $context]);
      if (!$string) {
        $string = $storage->createString([
          'source' => $source,
          'context' => $context,
          'version' => '3.1.0',
        ])->save();
      }

      $storage->createTranslation([
        'lid' => $string->getId(),
        'language' => $langcode,
        'translation' => $translation,
        'customized' => LOCALE_NOT_CUSTOMIZED,
      ])->save();
    }
  }
}
