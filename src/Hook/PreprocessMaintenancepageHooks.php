<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Extension\ThemeSettingsProvider;
use Drupal\Core\Hook\Attribute\Hook;

/**
 * Hook implementations used to preprocess maintenance page.
 */
class PreprocessMaintenancepageHooks {

  public function __construct(
    protected readonly ThemeSettingsProvider $themeSettings,
  ) {}

  /**
   * Implements hook_preprocess_HOOK() for maintenance-page.html.twig.
   */
  #[Hook('preprocess_maintenance_page')]
  public function preprocessMaintenancePage(array &$variables): void {
    // Creates variables from theme settings.
    $variables['container_fluid'] = $this->themeSettings->getSetting('container_fluid');
  }

}
