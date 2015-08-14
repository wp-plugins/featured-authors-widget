=== Plugin Name ===
Contributors: ColinD
Donate link: http://www.colinduwe.com/
Tags: authors, widgets
Requires at least: 3.3.2
Tested up to: 4.3
Stable tag: 2.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Choose specific authors to highlight in a widget with optional avatars and links to their posts.

== Description ==

This plugin provides a widget to showcase your site's authors. When configuring the widget you select the authors and choose whether to display them with their avatars and choose how many posts to display for authors.

== Installation ==

1. Upload `featured-authors-widget` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add the widget to your sidebar through the 'Appearance->Widgets menu.
1. Configure the widget.

== Frequently Asked Questions ==

= Can it show x? =

Probably. Please post feature requests in the support forum.


== Screenshots ==

1. Configure the widget in the admin interface
2. This is how it looks in twentyeleven
3. Add some CSS to your theme and it can look like this.

== Changelog ==

= 2.0.1 =
Fixed array variable declaration.

= 2.0 =
Updated to comply with php5 constructor.
Added ajax to admin UI to re-order the selected authors.
Misc small code clean up

= 1.1 =
Added ability to sort the authors using the default sort options available in get_users(). Need to add other sort options like menu order and random in the future. Also need to improve how the order is saved so you only have to save the widget once. 

= 1.0 =
* Initial Release


== Upgrade Notice ==


Initial release. no notes.
