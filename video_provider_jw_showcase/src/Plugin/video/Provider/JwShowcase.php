<?php

namespace Drupal\video_provider_jw_showcase\Plugin\video\Provider;

use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\video\ProviderPluginBase;

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
class JwShowcase extends ProviderPluginBase {

  use MessengerTrait;
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function renderEmbedCode($settings) {
    $id = $this->getVideoMetadata()['id'];

    $output['ui-view'] = [
      '#type' => 'html_tag',
      '#tag' => 'ui-view',
      '#value' => '',
    ];

    $output['container'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => 'jw-cover jw-loading',
        'ng-show' => 'rootVm.appStore.loading',
      ],
    ];

    $output['container']['jw_icon'] = [
      '#prefix' => '<div class="jw-loading-icon">',
      '#markup' => '<div class="jw-rotate-animation"><i class="jwy-icon jwy-icon-buffer"></i></div>',
      '#suffix' => '</div>',
    ];

    $output['#attached']['html_head'][] = [
      [
        '#type' => 'html_tag',
        '#tag' => 'script',
        '#value' => "window.configLocation = 'https://$id.jwpapp.com/config.json';",
      ],
      'jwshowcase-config-location',
    ];

    return $output;
  }

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
