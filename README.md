WP-CLI Clear OPcache
=========================

Use WP-CLI to clear the OPcache for a site via HTTP.

## Usage

```
# Clear the OPcache for the website.
$ wp opcache clear

# Invalidate a cached script.
$ wp opcache invalidate 'foo/bar.php'
```

## Installation

Installing this package requires WP-CLI to be installed on your server. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this plugin with `composer require wearerequired/wp-cli-clear-opcache`.
