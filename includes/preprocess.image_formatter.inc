<?php

/**
 * @file
 * Contains image formatter preprocess functions.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function kiso_preprocess_image_formatter(&$variables) {
  $url = $variables['url'] ?? NULL;
  if (!$url) {
    return;
  }

  $attributes = $url->getOption('attributes') ?? [];
  if (!isset($attributes['aria-label']) || $attributes['aria-label'] === '') {
    $label = _kiso_get_entity_label($url->getOption('entity') ?? null);
    $attributes['aria-label'] = $label !== ''
      ? t('Open details page - @label', ['@label' => $label])
      : t('Open details page');
    $url->setOption('attributes', $attributes);
  }
}

/**
 * Get the label of an entity, taking into account the current language.
 *
 * @param $entity
 *   The entity from which to get the label.
 *
 * @return string
 *   The label of the entity.
 */
function _kiso_get_entity_label($entity): string {
  if (!$entity) {
    return '';
  }
  $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
  if (method_exists($entity, 'hasTranslation') && $entity->hasTranslation($langcode)) {
    $entity = $entity->getTranslation($langcode);
  }
  return $entity->label();
}
