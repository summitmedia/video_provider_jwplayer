<?php

namespace Drupal\video_provider_jwplayer\Plugin\video\Provider;

use Drupal\video\ProviderPluginBase;

/**
 * Class JwBaseClass.
 *
 * @package Drupal\video_provider_jwplayer\Plugin\video\Provider
 */
abstract class JwBaseClass extends ProviderPluginBase {

  /**
   * The default player ID for video.
   *
   * @var string
   * @todo this one should be in configs for entity display type.
   */
  protected const PLAYER_ID = 'kz34wX4X';

  /**
   * {@inheritdoc}
   */
  abstract public function getRemoteThumbnailUrl();

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($settings) {
    $data = $this->getVideoMetadata();
    return [
      '#type' => 'html_tag',
      '#tag' => 'script',
      '#attributes' => [
        // Ignore for Cloudflare Rocket Loader.
        // Fixed ```Error: jwplayer(…).setup is not a function```.
        // @link https://support.cloudflare.com/hc/en-us/articles/200168056-What-does-Rocket-Loader-do-
        // @link https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-specific-JavaScripts-
        'data-cfasync' => 'false',
        'src' => 'https://cdn.jwplayer.com/players/' . $data['id'] . '-' . self::PLAYER_ID . '.js',
      ],
    ];
  }

}
