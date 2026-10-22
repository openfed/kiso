<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Hook implementations used to preprocess image formatter variables.
 */
class PreprocessImageFormatterHooks {

  use StringTranslationTrait;

  public function __construct(
    protected readonly LanguageManagerInterface $languageManager,
    TranslationInterface $stringTranslation,
  ) {
    $this->setStringTranslation($stringTranslation);
  }

  /**
   * Implements hook_preprocess_HOOK().
   */
  #[Hook('preprocess_image_formatter')]
  public function preprocessImageFormatter(array &$variables): void {
    /** @var \Drupal\Core\Url|null $url */
    $url = $variables['url'] ?? NULL;
    if (!$url) {
      return;
    }
    $attributes = $url->getOption('attributes') ?? [];
    if (!isset($attributes['aria-label']) || $attributes['aria-label'] === '') {
      $label = $this->entityLabel($url->getOption('entity') ?? NULL);
      $attributes['aria-label'] = $label !== '' ? $this->t('Open details page - @label', [
        '@label' => $label,
      ]) : $this->t('Open details page');
      $url->setOption('attributes', $attributes);
    }
  }

  /**
   * Get the label of an entity, taking into account the current language.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface|null $entity
   *   The entity from which to get the label.
   *
   * @return string
   *   The label of the entity.
   */
  private function entityLabel(?ContentEntityInterface $entity): string {
    if (!$entity) {
      return '';
    }
    $langcode = $this->languageManager->getCurrentLanguage()->getId();
    if ($entity->hasTranslation($langcode)) {
      $entity = $entity->getTranslation($langcode);
    }
    return $entity->label();
  }

}
