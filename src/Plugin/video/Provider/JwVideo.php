<?php

namespace Drupal\video_provider_jwplayer\Plugin\video\Provider;

/**
 * A JW Player provider plugin.
 *
 * @VideoEmbeddableProvider(
 *   id = "jwvideo",
 *   label = @Translation("JW Video"),
 *   description = @Translation("JW player Video Provider"),
 *   regular_expressions = {
 *     "@\/\/\w+\.(jwplayer|jwplatform)\.com\/videos\/(?<id>[\_a-zA-Z0-9]+)@i"
 *   },
 *   mimetype = "video/jwvideo",
 *   stream_wrapper = "jwvideo"
 * )
 */
class JwVideo extends JwBaseClass {

  /**
   * {@inheritdoc}
   */
  public function getRemoteThumbnailUrl() {
    $data = $this->getVideoMetadata();

    return 'https://content.jwplatform.com/thumbs/' . $data['id'] . '.jpg';
  }

}
