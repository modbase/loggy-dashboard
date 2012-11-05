# Loggy Dashboard

This is the Loggy Dashboard. It is to be used in combination with the Loggy bundle.

## Installation and configuration

1. Install the migrations table if you haven't already: `php artisan migrate:install`.
2. All you have to do now is run the migrations: `php artisan migrate`. This will create a __logitems__ table where all the log entries will live.

In `application/config/loggy.php` add all your sites that need to be monitored:

```
return array(
	'sites' => array(

		'site_1' => array(
			'name' => 'My first site',
			'fatal_threshold' => 2,
			'warning_threshold' => 5,
			'notice_threshold' => 5,
			'other_threshold' => 3,
		),

		'other_site' => array(
			'name' => 'Another site',
			'fatal_threshold' => 2,
			'warning_threshold' => 5,
			'notice_threshold' => 5,
			'other_threshold' => 3,
		),
	)
);
```

* `site_1` and `other_site` are the site IDs in this example. These much match your Loggy site IDs you've setup. See the Loggy repo for more information.
* `name` will be the visible site name at the dashboard
* `fatal_threshold` - if the number of fatal PHP errors (i.e. `E_ERROR`) is higher than this value, then it will be showed as critical.
* `warning_threshold` - same as for fatal, but applies to E_WARNING errors.
* `notice_threshold` - same as for fatal, but applies to E_NOTICE errrors.
* `other_threshold` - same as for fatal, but applies to all other errors.

## Screenshots

Below are two screenshots of the dashboard in action using the configuration above. The second screenshot shows what happens when you click a row in the sites table. It will show you details about the errors.

![Screen 1](http://i.imgur.com/oIXmm.png)

![Screen 2](http://i.imgur.com/yXUj1.png)