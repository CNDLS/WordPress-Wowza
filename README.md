Wordpress Flowplayer
====================

A wordpress plugin to easily bring [Flowplayer](http://flowplayer.org) to your blog.

Configuration
-------------

1. Navigate to the configuration page from within /wp-admin
2. Configure your player using the options provided
3. Save your changes and ENJOY!

Changelog
---------
* 2.1.0.0 	- Complete re-write, uses database meta data no longer reliant on config file.
* 2.0.9.92 	- Added ability to specify background images, deprecated ability to set play button label, changes to use only fullpaths deprecating releative media paths,more colour options
* 2.0.9.91	- Resolved bug when using wordpress 2.9
* 2.0.9.9	- Pre release version of 2.1.0.0, includes flowplayer 3.1.1
* 2.0.1.5	- Setting wmode to resolve issue with some drop down navigations
* 2.0.1.4	- Fixed bug with missing trailing / pre media file
* 2.0.1.3	- Added error notifications to admin menu, fixed issue with rpath, commercial flowplayer support added, resolved issue where saiweb_wpfp.conf was being overwritten, removed rpath from config file
* 2.0.1.2	- Fixed issue of including full http:// paths, properly this time ...
* 2.0.1.1	- Fixed issue of including full http:// paths
* 2.0.0.68	- Added link to Saiweb.co.uk TRAC via Report bug link in admin menu
* 2.0.0.67	- Jumped to 2.x statsu following integration of flowplayer 3.0.1, added admin menu, verified full wordpress 2.6.7 compatible
* 1.0.0.36	- Added unique naming of media div to allow multiple players per page
* 1.0.0.0	- Added BETA rtmp support
* 0.3		- wpfp to word-press-flow-player relative path change
* 0.2		- syntax tweaks
* 0.1		- Initial check in of the project to word press subversion

Support development
-------------------
If you like this plugin and flowplayer please consider the purchase of a commercial [Flowplayer license](http://flowplayer.org/download/index.html?aff=100)

Contribute
----------

With an ever dwindling amount of free time to work on this project it is always appreciated there are workaround / hacks that other developers have made in order to get the required functioanlity.
As this project is GPL v3, please contribute to it your code changes as follows.

1. Fork it.
2. Create a branch (`git checkout -b my_markup`)
3. Commit your changes (`git commit -am "I made these changes 123"`)
4. Push to the branch (`git push origin my_markup`)
5. Create an [Issue][1] with a link to your branch

[1]: https://github.com/Oneiroi/wordpress-flowplayer/issues
