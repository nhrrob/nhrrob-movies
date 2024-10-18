=== NHR Movies ===
Contributors: nhrrob
Tags: movies, management, laravel, eloquent, blade
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.1.5
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A plugin to manage movies using Laravel's Eloquent ORM and Blade templating.

== Description ==
- 🚀 [GitHub Repository](https://github.com/nhrrob/nhrrob-movies): Found a bug or have a feature request? Let us know!
- 💬 [Slack Community](https://join.slack.com/t/nhrrob/shared_invite/zt-2m3nyrl1f-eKv7wwJzsiALcg0nY6~e0Q): Got questions or just want to chat? Come hang out with us on Slack!

One of my favourite quote from legendary Cary Grant,

`<?php echo 'Everyone wants to be Cary Grant, Event I want to be Cary Grant!'; ?>`

The NHR Movies plugin brings the elegance and efficiency of Laravel's Eloquent ORM and Blade templating engine to your WordPress site. Whether you're a movie enthusiast, a film critic, or a cinema database curator, this plugin offers a seamless way to manage and display movie data.

### ✨ Features
- Eloquent ORM Integration: Leverage Laravel's powerful ORM for easy and efficient data management.
- Blade Templating: Use Blade for flexible and clean templating.
- Custom Movie Management: Add, edit, and manage movies with ease.
- (Coming Soon) Advanced Filtering and Sorting: Easily filter and sort movies based on various criteria.

### Shortcode
- `[nhrrob_movies_list]` (Coming Soon!)
- `[nhrrob_movies_detail id="{movie_id}"]` (Coming Soon!)

## External Services & Libraries

This plugin utilizes the following third-party services and libraries:

- Blade Templating Engine: Provides a simple yet powerful templating syntax for creating views.
- Eloquent ORM: Laravel's ORM for interacting with the database in an expressive and elegant way.
- Composer Dependencies: Managed via Composer, the PHP dependency manager. This includes packages like illuminate/database for Eloquent ORM and jenssegers/blade for Blade templating.
- [Tailwind CSS](https://tailwindcss.com)

No personal or sensitive data beyond the specified username is shared. This data is used solely to fetch and display the user's contributions to the WordPress core project.


== Installation ==

1. Upload the plugin files to the /wp-content/plugins/nhrrob-movies directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. (Coming Soon) Use the shortcode `[nhrrob_movies_list]` and `[nhr_movie_detail id="{movie_id}"]` to display movies on your site.


== Frequently Asked Questions ==

= How do I add a new movie? =
Navigate to the NHR Movies page in your WordPress dashboard and click on 'Add New Movie' button. Fill in the required fields and save.

= What database tables does this plugin use? =
- The plugin creates custom tables using Eloquent's migration feature. You can view these tables in your WordPress database, table named `{prefix}_nhrrob_movies`.

= Can I see total contributions count? Also link to the details for each ticket? =
Yes. Total count is shown at the top. Also all tickets are linked to the changesheet url.

= How does the plugin handle my data? =
The NHR Movies plugin only transmits the WordPress.org username specified by the user to the WordPress Core Trac API. This is done solely to fetch and display your core contributions. No personal or sensitive data beyond the username is shared or stored.


== Screenshots ==

1. Dashboard => NHR Movies => Movies list page
2. Add movie page
3. Edit movie page
4. Dashboard => NHR Movies menu location

== Changelog ==

= 1.1.5 - 18/10/2024 =
- WordPress tested up to version is updated to 6.7
- Few minor bug fixing & improvements

= 1.1.4 - 02/08/2024 =
- Added: Legacy data removal migration
- Few minor bug fixing & improvements

= 1.1.3 - 02/08/2024 =
- Added: Release Data migration added
- Few minor bug fixing & improvements

= 1.1.2 - 02/08/2024 =
- Added: Vendor folder added
- Few minor bug fixing & improvements

= 1.1.1 - 01/08/2024 =
- Fixed: Fatal error on DB table creation
- Fixed: Plugin Check (PCP) errors
- Improved: List page design revamped
- Added: Composer related files added
- Few minor bug fixing & improvements

= 1.1.0 - 01/08/2024 =
- Plugin revamped
- Few minor bug fixing & improvements


== Upgrade Notice ==

= 1.0.0 =
- This is the initial release. Feel free to share any feature request at the plugin support forum page.