<?php

/**
 * @file
 * Prepares variables for file link templates.
 */

use Drupal\Core\Template\Attribute;

/**
 * Implements hook_preprocess_HOOK() for file-link.html.twig.
 */
function kiso_preprocess_file_link(&$variables) {
  $file = $variables['file'];
  $mime_type = $file->getMimeType();
  $extension = pathinfo($file->getFilename(), PATHINFO_EXTENSION);

  // Set an accessible name for files that cannot be identified using their
  // extension as accronym in the label.
  $labels = [
    'doc' => t("Word document"),
    'docx' => t("Word document"),
    'ppt' => t("PowerPoint presentation"),
    'pptx' => t("PowerPoint presentation"),
    'txt' => t("Plain text document"),
    'xls' => t("Spreadsheet"),
    'xlsx' => t("Spreadsheet"),
  ];

  // WCAG 2.1 - Guideline 1.3.1 – Info and Relationships (Level A).
  // Sufficient Technique ARIA24: Semantically identifying a font icon with `role="img"`:
  // See: https://www.w3.org/WAI/WCAG21/Techniques/aria/ARIA24
  $variables['icon_attributes'] = [
    'role' => 'img',
    'aria-label' => array_key_exists($extension, $labels) ? $labels[$extension] : t("@ext file", array('@ext' => strtoupper($extension))),
  ];

  // Classes to add to the <i> (Icon) element.
  $classes = [
    'icon',
    // Add a more general class for groups of well known MIME types.
    'icon--' . file_icon_class($mime_type),
  ];

  // Set file classes to the attribute object.
  $variables['icon_attributes'] = new Attribute($variables['icon_attributes']);
  $variables['icon_attributes']->addClass($classes);
}
