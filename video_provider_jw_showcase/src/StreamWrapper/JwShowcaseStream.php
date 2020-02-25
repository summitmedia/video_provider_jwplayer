<?php

namespace Drupal\video_provider_jw_showcase\StreamWrapper;

use Drupal\video\StreamWrapper\VideoRemoteStreamWrapper;

/**
 * Defines a JwShowcaseStream (jwshowcase://) stream wrapper class.
 */
class JwShowcaseStream extends VideoRemoteStreamWrapper {

  /**
   * Base video url.
   *
   * @var string
   * @see getExternalUrl() for details.
   */
  protected static $baseUrl = 'https://jwpapp.com';

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->t('JW Showcase');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('Use this tool to create rich, video-centric experiences across web, mobile web and OTT Apps.');
  }

  /**
   * {@inheritdoc}
   */
  public static function baseUrl() {
    return self::$baseUrl;
  }

  /**
   * {@inheritdoc}
   */
  public function getExternalUrl() {
    $path = str_replace('\\', '/', $this->getTarget());
    $base_url = parse_url(static::baseUrl());

    return $base_url['scheme'] . '://' . $path . '.' . $base_url['host'];
  }

}
