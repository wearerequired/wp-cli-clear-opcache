WP-CLI Clear OPcache
==================================

Use WP-CLI to clear the OPcache for a site via HTTP.

[![Build Status](https://travis-ci.org/wearerequired/wp-cli-clear-opcache.svg?branch=master)](https://travis-ci.org/wearerequired/wp-cli-clear-opcache)

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing) | [Support](#support)

## Using

This package implements the following commands:

### wp opcache clear

Clear the OPcache for the current WordPress site.

~~~
wp opcache clear 
~~~

**EXAMPLES**

    # Clear the OPcache for the website.
    $ wp opcache clear
    Success: The OPcache was successfully cleared!



### wp opcache invalidate

Invalidate a cached script for the current WordPress site.

~~~
wp opcache invalidate <script> [--force]
~~~

**OPTIONS**

	<script>
		The path to the script being invalidated.

	[--force]
		Force invalidation, even if not necessary.

**EXAMPLES**

    # Invalidate a cached script.
    $ wp opcache invalidate foo/bar.php
    Success: The OPcache was successfully invalidated for foo/bar.php.

## Installing

Installing this package requires WP-CLI v1.3.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this plugin with:

    composer require wearerequired/wp-cli-clear-opcache

## Contributing

We appreciate you taking the initiative to contribute to this project.

Contributing isn’t limited to just code. We encourage you to contribute in the way that best fits your abilities, by writing tutorials, giving a demo at your local meetup, helping other users with their support questions, or revising our documentation.

### Reporting a bug

Think you’ve found a bug? We’d love for you to help us get it fixed.

Before you create a new issue, you should [search existing issues](https://github.com/wearerequired/wp-cli-clear-opcache/issues?q=label%3Abug%20) to see if there’s an existing resolution to it, or if it’s already been fixed in a newer version.

Once you’ve done a bit of searching and discovered there isn’t an open or fixed issue for your bug, please [create a new issue](https://github.com/wearerequired/wp-cli-clear-opcache/issues/new). Include as much detail as you can, and clear steps to reproduce if possible.

### Creating a pull request

Want to contribute a new feature? Please first [open a new issue](https://github.com/wearerequired/wp-cli-clear-opcache/issues/new) to discuss whether the feature is a good fit for the project.


*This README.md is generated dynamically from the project's codebase using `wp scaffold package-readme` ([doc](https://github.com/wp-cli/scaffold-package-command#wp-scaffold-package-readme)). To suggest changes, please submit a pull request against the corresponding part of the codebase.*
