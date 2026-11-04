<?php

use Drupal\kiso\RegionContent;

/**
 * Small function to render the regions without passing them by reference.
 *
 * @param $region
 *
 * @return mixed
 */
function _kiso_render_region($region) {
  return Drupal::classResolver(RegionContent::class)->renderRegion($region);
}

/**
 * @file
 * Utilities used by the theme preprocess functions.
 */

/**
 * Properly detect if regions are empty.
 *
 * @param ?string $markup
 *   The rendered region markup to be tested if empty.
 * @param string $allowed_tags
 *   Allowed tags to be excluded from the strip HTML tags process.
 *
 * @return
 *   TRUE if the region exists and is not empty, FALSE otherwise.
 *
 * @see https://www.drupal.org/node/953034
 * @see https://drupal.stackexchange.com/questions/175389/how-do-i-properly-detect-if-region-is-empty
 */
function _kiso_has_region(?string $markup, string $allowed_tags = '') {
  return Drupal::classResolver(RegionContent::class)->hasRegion($markup, $allowed_tags);
}

/**
 * Strips html tags, except allowed, returning a trimmed clean markup.
 *
 * @param string $markup
 *  Original markup.
 * @param string|array $allowed_tags
 *  Allowed tags, can be an array of tag of a string.
 *
 * @return string
 * @throws \Twig\Error\RuntimeError
 */
function _kiso_strip_tags(string $markup, string|array $allowed_tags) {
  return Drupal::classResolver(RegionContent::class)->stripTags($markup, $allowed_tags);
}
