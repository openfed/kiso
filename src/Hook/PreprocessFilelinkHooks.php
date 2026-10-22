<?php

namespace Drupal\kiso\Hook;

use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\Template\Attribute;
use Drupal\file\IconMimeTypes;

/**
 * Hook implementations used to preprocess file link variables.
 */
class PreprocessFilelinkHooks {

  use StringTranslationTrait;

  public function __construct(TranslationInterface $stringTranslation) {
    $this->setStringTranslation($stringTranslation);
  }

  /**
   * Implements hook_preprocess_HOOK() for file-link.html.twig.
   */
  #[Hook('preprocess_file_link')]
  public function preprocessFileLink(array &$variables): void {
    $file = $variables['file'];
    $mime_type = $file->getMimeType();
    $extension = pathinfo($file->getFilename(), PATHINFO_EXTENSION);
    // Set an accessible name for files that cannot be identified using their
    // extension as accronym in the label.
    $labels = [
      'doc' => $this->t("Word document"),
      'docx' => $this->t("Word document"),
      'ppt' => $this->t("PowerPoint presentation"),
      'pptx' => $this->t("PowerPoint presentation"),
      'txt' => $this->t("Plain text document"),
      'xls' => $this->t("Spreadsheet"),
      'xlsx' => $this->t("Spreadsheet"),
    ];
    // WCAG 2.1 - Guideline 1.3.1 – Info and Relationships (Level A).
    // Sufficient Technique ARIA24: Semantically identifying a font icon with
    // `role="img"`:
    // See: https://www.w3.org/WAI/WCAG21/Techniques/aria/ARIA24
    $variables['icon_attributes'] = [
      'role' => 'img',
      'aria-label' => array_key_exists($extension, $labels) ? $labels[$extension] : $this->t("@ext file", [
        '@ext' => strtoupper($extension),
      ]),
    ];
    // Classes to add to the <i> (Icon) element.
    $classes = [
      'icon',
      // Add a more general class for groups of well known MIME types.
      'icon--' . IconMimeTypes::getIconClass($mime_type),
    ];
    // Set file classes to the attribute object.
    $variables['icon_attributes'] = new Attribute($variables['icon_attributes']);
    $variables['icon_attributes']->addClass($classes);
  }

}
