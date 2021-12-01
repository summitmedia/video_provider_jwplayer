<?php

namespace Drupal\video_provider_jw_showcase\PathProcessor;

use Drupal\Core\PathProcessor\InboundPathProcessorInterface;
use Drupal\Core\PathProcessor\OutboundPathProcessorInterface;
use Drupal\Core\Render\BubbleableMetadata;
use Symfony\Component\HttpFoundation\Request;

/**
 * Path prefix path processor.
 */
class JwShowcasePathProcessor implements InboundPathProcessorInterface, OutboundPathProcessorInterface {

  /**
   * Available path prefixes.
   */
  public const SHOWCASE_PATH_PREFIXES = '/showcase/';

  /**
   * {@inheritdoc}
   */
  public function processInbound($path, Request $request) {
    return self::getBaseNodeShowcasePath($path);
  }

  /**
   * {@inheritdoc}
   */
  public function processOutbound($path, &$options = [], Request $request = NULL, BubbleableMetadata $bubbleable_metadata = NULL) {
    // Return Path without parameters if this is a showcase path.
    if (
      empty($request) ||
      $request->attributes->get('_route') !== 'entity.node.canonical' ||
      substr($path, 0, strlen(self::SHOWCASE_PATH_PREFIXES)) !== self::SHOWCASE_PATH_PREFIXES ||
      substr($_SERVER['REQUEST_URI'], 0, strlen(self::SHOWCASE_PATH_PREFIXES)) !== self::SHOWCASE_PATH_PREFIXES
    ) {
      return $path;
    }

    return $request->getPathInfo();
  }

  /**
   * Get base node showcase path.
   *
   * @param string $path
   *   Current path.
   *
   * @return string
   *   Original base node showcase path.
   */
  public static function getBaseNodeShowcasePath(string $path) {
    // Check if this is a showcase path with custom parameters.
    $pattern = '/^\/showcase\/([\w\W]+)\/[m|p]\/[\w\W]+/m';
    preg_match($pattern, $path, $matches);
    if (!empty($matches[1])) {
      return self::SHOWCASE_PATH_PREFIXES . $matches[1];
    }

    return $path;
  }

}
