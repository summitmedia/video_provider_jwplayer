<?php

namespace Drupal\video_provider_jwplayer\StreamWrapper;

use Drupal\video\StreamWrapper\VideoRemoteStreamWrapper;

/**
 * Defines a JwVideo (jwvideo://) stream wrapper class.
 */
class JwVideoStream extends VideoRemoteStreamWrapper {

  /**
   * Base video url.
   *
   * @var string
   * @see getExternalUrl() for details.
   */
  protected static $baseUrl = 'https://content.jwplatform.com/videos';

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->t('JW player');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('Video served by the JW player services.');
  }

  /**
   * {@inheritdoc}
   */
  public static function baseUrl() {
    return self::$baseUrl;
  }

}
