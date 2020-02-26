<?php

namespace Drupal\video_provider_jwplayer\Plugin\video\Provider;

use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * A JW PlayList provider plugin.
 *
 * @VideoEmbeddableProvider(
 *   id = "jwshowcase",
 *   label = @Translation("JW Showcase"),
 *   description = @Translation("JW Showcase Video Provider"),
 *   regular_expressions = {
 *     "@\/\/(?<id>[\_a-zA-Z0-9\-]+).jwpapp\.com@i"
 *   },
 *   mimetype = "video/jwshowcase",
 *   stream_wrapper = "jwshowcase"
 * )
 */
class JwShowcase extends JwBaseClass {

  use MessengerTrait;
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function getRemoteThumbnailUrl() {
    $thumbnail = '';
    $data = $this->getVideoMetadata();
    $config_uri = 'https://' . $data['id'] . '.jwpapp.com/config.json';
    $playlist_json = @file_get_contents($config_uri);
    if ($playlist_json === FALSE) {
      $this->messenger()
        ->addError($this->t('An error occurred during request %config_uri.', [
          '%config_uri' => $config_uri,
        ]));

      return $thumbnail;
    }

    $playlist_json = json_decode($playlist_json, TRUE);

    return @$playlist_json['assets']['banner'] ?: $thumbnail;
  }

}
