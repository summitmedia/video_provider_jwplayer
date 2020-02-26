<?php

namespace Drupal\video_provider_jwplayer\Plugin\video\Provider;

/**
 * A JW PlayList provider plugin.
 *
 * @VideoEmbeddableProvider(
 *   id = "jwplaylist",
 *   label = @Translation("JW PlayList"),
 *   description = @Translation("JW Play List Video Provider"),
 *   regular_expressions = {
 *     "@\/\/\w+\.(jwplayer|jwplatform)\.com\/[^\/]+\/playlists\/(?<id>[\_a-zA-Z0-9]+)@i"
 *   },
 *   mimetype = "video/jwplaylist",
 *   stream_wrapper = "jwplaylist"
 * )
 */
class JwPlayList extends JwBaseClass {

  /**
   * {@inheritdoc}
   */
  public function getRemoteThumbnailUrl() {
    $thumbnail = '';
    $data = $this->getVideoMetadata();
    $playlist_json = json_decode(file_get_contents('https://cdn.jwplayer.com/v2/playlists/' . $data['id']), TRUE);
    if (
      empty($playlist_json) ||
      empty($playlist_json['playlist']) ||
      empty($playlist_json['playlist']) ||
      !is_array($playlist_json['playlist'])
    ) {
      return $thumbnail;
    }

    foreach ($playlist_json['playlist'] as $video) {
      if (!empty($video['image'])) {
        return $video['image'];
      }
    }

    return $thumbnail;
  }

}
