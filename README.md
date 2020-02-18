# JW Player
JW Player module is an implementation of the video embedded provider plugin in Drupal 8

## Settings
The current API don't allow to manage single embed video settings.
All player settings are configurable only on the [player settings page][https://dashboard.jwplayer.com/#/players/list].

## Developer notes
### Existing contrib modules
**[JW player][https://www.drupal.org/project/jw_player] module is unstable.**
- It has [deprecated][https://www.drupal.org/project/jw_player/issues/2838866] installation flow.
- Poor use [statistic][https://www.drupal.org/project/usage/jw_player].
- It doesn't work with [video][https://www.drupal.org/project/video] module.
- It has [fantastic strange template][https://git.drupalcode.org/project/video/blob/8.x-2.x/templates/video-player-formatter.html.twig] for video output.

That's why we didn't use it.

### Troubleshooting
Cloudflare added a [React Loader][https://support.cloudflare.com/hc/en-us/articles/200168056-What-does-Rocket-Loader-do-] script, which broke JW player.
Tested even with the plain html file on dev/prod envs with the same result.
In console it return:
```Error: jwplayer(…).setup is not a function```

That's why ```data-cfasync="false"``` tag was added to jw player script.
@see ["How can I have Rocket Loader ignore specific JavaScripts?"][https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-specific-JavaScripts-] for more info.

[https://www.drupal.org/project/jw_player]: https://www.drupal.org/project/jw_player
[https://www.drupal.org/project/jw_player/issues/2838866]: https://www.drupal.org/project/jw_player/issues/2838866
[https://www.drupal.org/project/usage/jw_player]: https://www.drupal.org/project/usage/jw_player
[https://www.drupal.org/project/video]: https://www.drupal.org/project/video
[https://git.drupalcode.org/project/video/blob/8.x-2.x/templates/video-player-formatter.html.twig]: https://git.drupalcode.org/project/video/blob/8.x-2.x/templates/video-player-formatter.html.twig
[https://dashboard.jwplayer.com/#/players/list]: https://dashboard.jwplayer.com/#/players/list
[https://support.cloudflare.com/hc/en-us/articles/200168056-What-does-Rocket-Loader-do-]: https://support.cloudflare.com/hc/en-us/articles/200168056-What-does-Rocket-Loader-do-
[https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-specific-JavaScripts-]: https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-specific-JavaScripts-
