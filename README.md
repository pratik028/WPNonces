# WPNonces
Composer Package that allows the functionality with WordPress Nonces (wp_nonce _ * () functions) in an object-oriented environment.
You can read more about nonces here : https://codex.wordpress.org/WordPress_Nonces

## Installation

Create a local copy of this repository via git:
``` ~$ git clone git@github.com/pratik028/WPNonces.git  ```
Change to the directory and run composer:
```
~$ cd WPNonces
WPNonces$ composer install
```

## Functions

### `get_nonce_url( $url )`
Extends the given URL with a valid nonce. The name of the parameter corresponds with the given name.

### `get_nonce_field( $action, $name, $referer, $echo )`
Creates an `<input type="hidden">` with a valid nonce for the given action. The name of the field corresponds with the given name. `$referer` is a boolean. Set to `true` the referer input field will be printed as well (Default: `false`). `$echo` defines, if the field will be immediatly echoed (`true`) or just returned (`false`, default).

### `create_nonce( $action )`
Returns a valid nonce for the given action. This can be used in ajax requests.

### `wp_verify_nonce_field( $nonce, $action )`
Verifies if the given nonce is valid for the current action.

### `get_referral_field( $echo )`
Retrieves or displays the referer hidden form field.

### `check_nonce_request( $name, $action, $callback )`
Is used for the automatic check on the `$_REQUEST` and is hooked into the `init` action, if automatic check is enabled. `check_request()` calls at least the actions `check_ajax_referer` (in case of `DOING_AJAX`) or `check_admin_referer` (in case of `is_admin()`), so functions hooked into these actions are still executed.


## Tests
To run the tests:

1. Switch into the WPNonce directory
2. run `composer install`,
3. create a `phpunit.xml` (see the `phpunit.xml.dist` as example) and enter the database credentials to your database.
3. run `phpunit`

The tests rely on https://github.com/inpsyde/WP-Tests-Starter and https://github.com/inpsyde/wordpress-dev