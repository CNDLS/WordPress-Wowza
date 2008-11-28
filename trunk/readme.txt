=== Plugin Name ===
Contributors: d.busby, flowplayer.org
Donate link: http://www.saiweb.co.uk/wordpress-flowplayer
Tags: flowplayer, mp4, flv
Requires at least: 2.6.1
Tested up to: 2.6.2
Stable tag: 1.0.0.35

A Flowplayer plugin for wordpress.

== Description ==

The version of flowplayer provided with this plugin is version 2.2.2 and is provided under the GPL license as specified by the authors of flowplayer http://flowplayer.org/.

I am not the author or owner of flowplayer as such all copyright for flowplayer remains that of the respective parties.

I am the author of the included flowplayer.php file and have made this available under the Creative Commons license similar to the GPL: http://creativecommons.org/licenses/by-nc-sa/2.0/uk

If the authors of flowplayer object to the distribution of their works under the original GPL license, I reserve the right to remove the download of this plugin

Whilst GPL does allow for me to legally redistribute the "free software" under the original license.

There currently is only a very basic featureset available, I have added BETA rmtp support as of 1.0.0.0 and will continue to add support for the features list here: http://flowplayer.org/player/advanced.html.



== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Download plugin and upload all contents to `/wp-content/plugins/`
2. Create a directory in your webroot for media files `/wp-content/videos/`
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Place [FLOWPLAYER=media.flv,600,450] where media.flv is your media file in `/videos/` in your blog text.
5. Place [FLOWPLAYER=rtmp://url.com:port/instance,media.flv,600,450] for rtmp support, REMEBER FOR WOWZA REMOVE THE FILE EXTENSION i.e. [FLOWPLAYER=rtmp://url.com:port/instance,media,600,450]

== Frequently Asked Questions ==

= I get an error: Parse error: parse error, unexpected T_STRING, expecting T_OLD_FUNCTION or T_FUNCTION or T_VAR or } in /wp-content/plugins/word-press-flow-player/wpfp/flowplayer.php on line XX =

This plugin is incompatible with releases 4.x of PHP, please see this page for a 4.x version http://www.saiweb.co.uk/php/flowplayer-for-wordpress: NOTE this is version 0.1 and in unlikely to be updated, if you require a PHP 4.x port of the current version of this plugin please request it using my contact form: http://www.saiweb.co.uk/contact-me

= I have another error / problem / question / suggestion =

Please use the contact form here: http://www.saiweb.co.uk/contact-me

== Screenshots ==

1. screenshot1.png
