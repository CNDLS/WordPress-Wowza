=== Plugin Name ===
Contributors: d.busby, flowplayer.org, acko.net
Donate link: http://www.saiweb.co.uk/wordpress-flowplayer
Tags: flowplayer, mp4, flv, h264, libx264, HD, streaming, flow, player
Requires at least: 2.7
Tested up to: 2.7
Stable tag: 2.0.1.2

A Flowplayer plugin for wordpress.

== Description ==

Homepage: http://www.saiweb.co.uk/wordpress-flowplayer

NOTE: IF YOU ARE UPGRADING REMEMBER TO BACKUP YOUR /wp-content/plugins/word-press-flow-player/saiweb_wpfp.conf

The version of flowplayer provided with this plugin is version 3.0.2 and is provided under the GPL license as specified by the authors of flowplayer http://flowplayer.org/.

PLugin is provided under CC License: http://creativecommons.org/licenses/by-nc-sa/2.0/uk

The admin menu as of plugin version 2.0.1.0 uses farbtastic 1.2 as provided under GPL here: http://acko.net/dev/farbtastic


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Download plugin and upload all contents to `/wp-content/plugins/`
2. Create a directory in your webroot for media files `/wp-content/videos/`
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Place [FLOWPLAYER=media.flv,600,450] where media.flv is your media file in `/wp-content/videos/` in your blog text (As of 2.0.1.0 you can now include media via http i.e. [FLOWPLAYER=http://another-site.com/media.flv,600,450]).
5. Updates are made available automatically via the wordpress upgrade system, please ensure you read the change log before upgrading.
6. You can make changes to the default settings by visiting the configuration page i.e. http://your_website_here/wp-admin/options-general.php?page=flowplayer.php

== Frequently Asked Questions ==

= I get an error: Parse error: parse error, unexpected T_STRING, expecting T_OLD_FUNCTION or T_FUNCTION or T_VAR or } in /wp-content/plugins/word-press-flow-player/wpfp/flowplayer.php on line XX =

This plugin is incompatible with releases 4.x of PHP, please update your PHP installation to 5.x.

= I have another error / problem / question / suggestion =

Please use our TRAC system here: http://trac.saiweb.co.uk/saiweb

== Screenshots ==

