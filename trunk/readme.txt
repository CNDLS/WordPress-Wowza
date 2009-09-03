=== Plugin Name ===
Contributors: d.busby
Donate link: http://www.saiweb.co.uk/wordpress-flowplayer#donate
Tags: flowplayer, mp4, flv, h264, libx264, HD, streaming, flow, player
Requires at least: 2.7
Tested up to: 2.8.4
Stable tag: 2.0.9.9

A Flowplayer plugin for wordpress.

== Description ==

NOTE: As of version 2.0.9.9 all settings are stored in wordpress meta data as such if you are upgrading to 2.0.9.9 or higher from an earlier verison
you will have to re-enter your settings.

Homepage: http://www.saiweb.co.uk/wordpress-flowplayer

NOTE: /wp-content/plugins/word-press-flow-player/saiweb_wpfp.conf has now been removed, Meta data is now in use, you will have to re-enter your settings!

The version of flowplayer provided with this plugin is version 3.1.1 and is provided under the GPL license as specified by the authors of flowplayer http://flowplayer.org/.

As of version 2.0.1.3, the bundeled version is the commercial version of flowplayer distributed with permission from the authors, this will allows owners of a commercial key to access commercial features.

Pre 2.0.9.9

Plugin is provided under CC License: http://creativecommons.org/licenses/by-nc-sa/2.0/uk

Post 2.0.9.9

plugin is provided under the GPLv3 license, see the bundled license.txt file.


The admin menu as of plugin version 2.0.1.0 uses farbtastic 1.2 as provided under GPL here: http://acko.net/dev/farbtastic

Credits:

1. http://www.flowplayer.org Flowplayer.
2. http://acko.net Farbtastic colour picker.
3. http://saiweb.co.uk Wordpress Flowplayer Plugin.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Download plugin and upload all contents to `/wp-content/plugins/``
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place [FLOWPLAYER=media.flv,600,450] where media.flv is your media file path, this can be realative or a full http url, followed by the width,height.
4. Updates are made available automatically via the wordpress upgrade system, please ensure you read the change log before upgrading.
5. You can make changes to the default settings by visiting the configuration page i.e. http://your_website_here/wp-admin/options-general.php?page=flowplayer.php
6. As of 2.0.9.9 you can now specify playlists, i.e. [FLOWPLAYER=media1.flv|media2.flv,600,450] each item is seperated using the pipe |

== Frequently Asked Questions ==

= I get an error: Parse error: parse error, unexpected T_STRING, expecting T_OLD_FUNCTION or T_FUNCTION or T_VAR or } in /wp-content/plugins/word-press-flow-player/wpfp/flowplayer.php on line XX =

This plugin is incompatible with releases 4.x of PHP, please update your PHP installation to 5.x.

NOTE: versions 2.0.9.9 and higher _MAY_ be compatible with php 4.x this is untested at this time, there is no planned support for PHP 4.x

= I have another error / problem / question / suggestion =

Please use our TRAC system here: http://trac.saiweb.co.uk/saiweb

== Screenshots ==

1. Admin interface in wordpress 2.7