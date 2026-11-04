<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Extension\ThemeSettingsProvider;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Path\PathMatcherInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Hook implementations used to preprocess variables.
 */
class PreprocessHooks {

  use StringTranslationTrait;

  /**
   * Constructor for PreprocessHooks.
   *
   * @param \Drupal\Core\Path\PathMatcherInterface $pathMatcher
   *   The path matcher service.
   * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
   *   The language manager service.
   * @param \Drupal\Core\Extension\ThemeSettingsProvider $themeSettings
   *   The theme settings provider service.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $stringTranslation
   *   The string translation service.
   */
  public function __construct(
    protected readonly PathMatcherInterface $pathMatcher,
    protected readonly LanguageManagerInterface $languageManager,
    protected readonly ThemeSettingsProvider $themeSettings,
    TranslationInterface $stringTranslation,
  ) {
    $this->setStringTranslation($stringTranslation);
  }

  /**
   * Implements hook_preprocess().
   */
  #[Hook('preprocess')]
  public function preprocess(array &$variables, string $hook): void {
    $variables['is_front'] = $this->pathMatcher->isFrontPage();
    $variables['language'] = $this->languageManager->getCurrentLanguage()
      ->getId();
    // Ensure the cache varies correctly (new in Drupal 8.3).
    $variables['#cache']['contexts'][] = 'url.path.is_front';
    // Creates variables from theme settings.
    $theme_settings = $this->themeSettings;
    $variables['container_fluid'] = $theme_settings->getSetting('container_fluid');
    // Load expected asset libraries.
    $variables['#attached']['library'][] = 'kiso/reboot';
    // Base styles:
    $variables['#attached']['library'][] = 'kiso/elements';
    // Layout styles:
    $variables['#attached']['library'][] = 'kiso/layout';
    // Components styles:
    $variables['#attached']['library'][] = 'kiso/blocks';
    $variables['#attached']['library'][] = 'kiso/navigations';
    $variables['#attached']['library'][] = 'kiso/forms';
    $variables['#attached']['library'][] = 'kiso/fields';
    $variables['#attached']['library'][] = 'kiso/nodes';
    $variables['#attached']['library'][] = 'kiso/miscs';
    // Enable the "Back to top" button.
    $variables['backtotop_enable'] = $theme_settings->getSetting('backtotop_enable');
    $variables['backtotop_label'] = $theme_settings->getSetting('backtotop_label') ?: $this->t('Back to top');
    $backtotop_enable = $theme_settings->getSetting('backtotop_enable');
    $backtotop_offset = $theme_settings->getSetting('backtotop_offset');
    $backtotop_mobile_hide = $theme_settings->getSetting('backtotop_mobile_hide');
    if ($backtotop_enable === 1) {
      $variables['#attached']['library'][] = 'kiso/back-to-top';
    }
    if (isset($backtotop_offset)) {
      $variables['#attached']['drupalSettings']['kiso']['backtotop']['offset'] = $backtotop_offset;
    }
    if (isset($backtotop_mobile_hide)) {
      $variables['#attached']['drupalSettings']['kiso']['backtotop']['mobile_hide'] = $backtotop_mobile_hide;
    }
  }

}
