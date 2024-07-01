<?php

/**
 * @file
 * Utilities used by the theme preprocess functions.
 */

/**
 * Strips html tags, except allowed, returning a trimmed clean markup.
 */
function _kiso_strip_tags(string $markup, string $allowed_tags = '') {
  $allowed_tags .= '<drupal-render-placeholder><img>';
  return trim(strip_tags($markup, $allowed_tags));
}
