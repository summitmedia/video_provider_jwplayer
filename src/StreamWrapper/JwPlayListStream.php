<?php

namespace Drupal\video_provider_jwplayer\StreamWrapper;

use Drupal\video\StreamWrapper\VideoRemoteStreamWrapper;

/**
 * Defines a JwVideo (jwplaylist://) stream wrapper class.
 */
class JwPlayListStream extends VideoRemoteStreamWrapper {

  /**
   * Base video url.
   *
   * @var string
   * @see getExternalUrl() for details.
   */
  protected static $baseUrl = 'https://cdn.jwplayer.com/v2/playlists';

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->t('JW play list');
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
