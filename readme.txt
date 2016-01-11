=== Advanced Custom Fields: Button Field ===
Contributors: webdevmattcrom
Donate link: http://mattcromwell.com
Tags: custom fields, acf, add on
Requires at least: 3.4
Tested up to: 4.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generates a nice button/link to an external url or an internal post type, similar to the page_link field but allows you to override the link text.

== Description ==

NOTE: **This is an extension for the popular [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin. By itself, this plugin does NOTHING.** ENDNOTE

Generates a nice button/link to an external url or an internal post type, similar to the page_link field but allows you to override the link text.

What makes this great is reducing two ACF rows into just one (see screenshots for a clear visual walkthrough). The internal link also uses a dropdown which is populated from all your post types so the button can link to a media file or a Custom Post Type, or of course to a page or post.

NOTE: (*I know it was already mentioned, but just to be sure there's no confusion...*) **This is an extension for the popular [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin. By itself, this plugin does NOTHING.** ENDNOTE

= Future Plans =
Not much really. Probably just a couple things as the need arises:

* Add a filter for media types since the dropdown can get kinda totally out of control.
* Add a target field as well. This would allow for _blank and even "[foobox](http://fooplugins.com/plugins/foobox)" to be targeted.
* Add a checkbox to enable "rel=nofollow".

== Installation ==

This add-on can be treated as both a WP plugin and a theme include.

= Plugin =
1. Copy the 'acf-button' folder into your plugins folder
2. Activate the plugin via the Plugins admin page
3. You can now create a 'button' field. Clicking the button can either perform an `AJAX GET` request, or a `window.open`
