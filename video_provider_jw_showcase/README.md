# JW Showcase
JW Showcase module is an implementation of the video embedded provider plugin in Drupal 8

## Installation
To use this module you need to unzip [the latest precompiled jw-showcase archive][https://github.com/jwplayer/jw-showcase/releases/] to ```docroot/libraries/jw-showcase``` folder.
To to this with composer, add to composer.json
```
{
    "repositories": {
        "jw-showcase": {
            "type": "package",
            "package": {
                "name": "jwplayer/jw-showcase",
                "version": "3.9.3",
                "type": "drupal-library",
                "dist": {
                    "url": "https://github.com/jwplayer/jw-showcase/releases/download/v3.9.3/precompiled-static-app.zip",
                    "type": "zip"
                }
            }
        },
    }
}
```
and after that execute ```composer require jwplayer/jw-showcase```

[https://github.com/jwplayer/jw-showcase/releases/]: https://github.com/jwplayer/jw-showcase/releases/
