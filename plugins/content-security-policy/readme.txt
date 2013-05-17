=== Content Security Policy ===
Contributors: bsterne
Tags: security, xss, csp
Requires at least: 2.9
Tested up to: 3.1
Stable tag: 0.3

Content Security Policy prevents content injection attacks by specifying valid sources of content for a site.

== Description ==

Content Security Policy prevents content injection attacks by allowing admins to specify which sites they trust to serve JavaScript and other types of content in their site.  Any content which is not explicitly allowed by the policy will be blocked from loading.

The Content Security Policy plugin provides WordPress administrators a mechanism to specify a custom policy, or adopt a recommended policy based on the types and sources of content present in their site.

Tested in Firefox 3.6 and Firefox 4, Chrome 10, and Safari 5.

== Screenshots ==

1. CSP configuration page making a policy reccommendation.
2. New panel in media uploader allows direct creation of script files in the uploads directory.
3. CSP configuration page in Chrome.
4. CSP configuration page in Safari.

== Installation ==

1. Upload `content-security-policy.zip` to the `/wp-content/plugins/` directory and unzip
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure a policy for your site in the 'Settings > CSP menu

== Changelog ==

= 0.3 =
* Updated to be compatible with WordPress 3.0 and WordPress 3.1
* Removed json.js (since WordPress ships w/ jQuery 1.4 now)
* Added "restore default settings" button
* Fixed a layout bug in the CSP Settings Page
* Fixed JSON encoding bug in the list of posts to analyze

= 0.2 =
* Fixed origin mismatch problem for https:// admin page users

= 0.1 =
* Initial release
