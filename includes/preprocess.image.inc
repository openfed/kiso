<?php

/**
 * @file
 * Prepares variables for image (media) templates.
 */

/**
 * Implements hook_preprocess_HOOK() for image.html.twig.
 */
function kiso_preprocess_image(&$variables) {
  // WCAG 2.1 - Failure of Success Criterion 1.1.1 due to omitting the `alt`
  // attribute or text alternative on <img> elements, area elements, and input
  // elements of type "image":
  // https://www.w3.org/WAI/WCAG21/Techniques/failures/F65
  //
  // If no title attribute is used, and the text alternative is set to null
  // (i.e. alt="") it indicates to Assistive Technology (AT) that the image is
  // decorative and can be safely ignored. However, the `alt` attribute MUST
  // remain mandatory.
  //
  // By default, if we mark the "Alt" field as optional in the UI, it will set
  // the 'alt' variable as NULL which will remove '#alt' property from the image
  // attributes, resulting in a non-accessible output. The following should fix
  // this issue.
  if (!isset($variables['alt']) || is_null($variables['alt'])) {
    $variables['attributes']['alt'] = '';
  }
}
