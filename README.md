ocean90/wp-cli-flush-cache
=========================

Clear the cache of a user or a site.

## Using

```
wp user flush-cache <user>
```

**OPTIONS**

	<user>
		User ID, user email, or user login.

---

```
wp site flush-cache <id>
```

**OPTIONS**

	<id>
		ID of a site.

## Installing

Installing this package requires WP-CLI v0.23.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with `wp package install ocean90/wp-cli-flush-cache`.
