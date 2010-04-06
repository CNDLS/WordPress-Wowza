=== Plugin Name ===
Contributors: d.busby
Donate link: http://www.saiweb.co.uk/wordpress-flowplayer#donate
Tags: flowplayer, mp4, flv, h264, libx264, HD, streaming, flow, player
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 2.0.9.92

A Flowplayer plugin for wordpress.

== Description ==

NOTE: As of version 2.0.9.9 all settings are stored in wordpress meta data as such if you are upgrading to 2.0.9.9 or higher from an earlier version
you will have to re-enter your settings.

Homepage: http://www.saiweb.co.uk/wordpress-flowplayer

The version of flowplayer provided with this plugin is version 3.1.1 and is provided under the GPL license as specified by the authors of flowplayer http://flowplayer.org/.

plugin is provided under the GPLv3 license, see the bundled license.txt file.

The admin menu uses farbtastic 1.2 as provided under GPL here: http://acko.net/dev/farbtastic

Credits:

1. http://www.flowplayer.org Flowplayer.
2. http://acko.net Farbtastic colour picker.
3. http://saiweb.co.uk Wordpress Flowplayer Plugin.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Download plugin and upload all contents to `/wp-content/plugins/``
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place [FLOWPLAYER=http://domain.com/media.flv,600,450] http://domain.com/media.flv is the complete url to your media
4. Updates are made available automatically via the wordpress upgrade system, please ensure you read the change log before upgrading.
5. You can make changes to the default settings by visiting the configuration page i.e. http://your_website_here/wp-admin/options-general.php?page=flowplayer.php
6. To create playlists simply separate each item with a pipe i.e. [FLOWPLAYER=http://domain.com/media.flv|http://domain.com/media2.flv,600,450]
7. splash image, to create a splash image specify your first item in the playlist as the image to use, and ensure autoplay is set to off i.e. [FLOWPLAYER=http://domain.com/splash.jpg|http://domain.com/media.flv,600,450]


== Frequently Asked Questions ==

= I get an error: Parse error: parse error, unexpected T_STRING, expecting T_OLD_FUNCTION or T_FUNCTION or T_VAR or } in /wp-content/plugins/word-press-flow-player/wpfp/flowplayer.php on line XX =

This plugin is incompatible with releases 4.x of PHP, please update your PHP installation to 5.x.

PHP 4.x became an END OF Life project in August 2008, it is not being maintained or patched, UPDATE YOUR PHP INSTALLATION!

= I have another error / problem / question / suggestion =

Please use our TRAC system here: http://trac.saiweb.co.uk/saiweb

== Screenshots ==

1. Admin interface in wordpress 2.7