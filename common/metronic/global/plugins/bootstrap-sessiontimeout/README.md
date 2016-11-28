# bootstrap-session-timeout
Inspired by [jquery-sessionTimeout-bootstrap by maxfierke](https://github.com/maxfierke/jquery-sessionTimeout-bootstrap)

There have been a number of major upgrades. For example, as long as the user is doing something on the page, he will never get a timeout. The original plugin launched a timeout warning dialog in a fixed amount of time regardless of user activity. See description and documentation for more information.

You can easily upgrade from jquery-sessionTimeout-bootstrap to bootstrap-session-timeout, since the basic options have been inherited from jquery-sessionTimeout-bootstrap and have not been renamed.

## Description
After a set amount of idle time, a Bootstrap warning dialog is shown to the user with the option to either log out, or stay connected. If "Logout" button is selected, the page is redirected to a logout URL. If "Stay Connected" is selected the dialog closes and the session is kept alive. If no option is selected after another set amount of idle time, the page is automatically redirected to a set timeout URL.

Idle time is defined as no mouse, keyboard or touch event activity registered by the browser.

As long as the user is active, the (optional) keep-alive URL keeps getting pinged and the session stays alive. If you have no need to keep the server-side session alive via the keep-alive URL, you can also use this plugin as a simple lock mechanism that redirects to your lock-session or log-out URL after a set amount of idle time.


## Getting Started

1. Download or git clone.
2. Run `bower install` to install dependencies or if you prefer to do it manually: include jQuery, Bootstrap JS and CSS (required if you want to use Bootstrap modal window).
3. Include `bootstrap-session-timeout.js` or the minified version `bootstrap-session-timeout.min.js`
4. Call `$.sessionTimeout();` on document ready. See available options below or take a look at the examples.



## Documentation
### Options
**title**<br>

Type: `String`

Default: `'Your session is about to expire!'`

This is the text shown to user via Bootstrap warning dialog after warning period. (modal title)

**message**<br>

Type: `String`

Default: `'Your session is about to expire.'`

This is the text shown to user via Bootstrap warning dialog after warning period.

**logoutButton**<br>

Type: `String`

Default: `'Logout'`

This is the text shown to user via Bootstrap warning dialog after warning period in the logout button.

**keepAliveButton**<br>

Type: `String`

Default: `'Stay Connected'`

This is the text shown to user via Bootstrap warning dialog after warning period in the Keep Alive button.

**keepAliveUrl**

Type: `String`

Default: `'/keep-alive'`

URL to ping via AJAX POST to keep the session alive. This resource should do something innocuous that would keep the session alive, which will depend on your server-side platform.

**keepAlive**

Type: `Boolean`

Default: `true`

If `true`, the plugin keeps pinging the `keepAliveUrl` for as long as the user is active. The time between two pings is set by the `keepAliveInterval` option. If you have no server-side session timeout to worry about, feel free to set this one to `false` to prevent unnecessary network activity.

**keepAliveInterval**

Type: `Integer`

Default: `5000` (5 seconds)

Time in milliseconds between two keep-alive pings.

**ajaxType**

Type: `String`

Default: `'POST'`

If you need to specify the ajax method

**ajaxData**

Type: `String`

Default: `''`

If you need to send some data via AJAX POST to your `keepAliveUrl`, you can use this option.

**redirUrl**

Type: `String`

Default: `'/timed-out'`

URL to take browser to if no action is take after the warning.

**logoutUrl**

Type: `String`

Default: `'/log-out'`

URL to take browser to if user clicks "Logout" on the Bootstrap warning dialog.

**warnAfter**

Type: `Integer`

Default: `900000` (15 minutes)

Time in milliseconds after page is opened until warning dialog is opened.

**redirAfter**

Type: `Integer`

Default: `1200000` (20 minutes)

Time in milliseconds after page is opened until browser is redirected to `redirUrl`.

**ignoreUserActivity**

Type: `Boolean`

Default: `false`

If `true`, this will launch the Bootstrap warning dialog / redirect (or callback functions) in a set amounts of time regardless of user activity. This in turn makes the plugin act much like the [jquery-sessionTimeout-bootstrap by maxfierke](https://github.com/maxfierke/jquery-sessionTimeout-bootstrap) plugin.

**countdownSmart**

Type: `Boolean`

Default: `false`

If `true`, displays minutes as well as seconds in the countdown timer (e.g. "3m 14s").
Displays only seconds when timer is under one minute (e.g. "42s").

**countdownMessage**

Type: `String` or `Boolean`

Default: `false`

If you want a custom sentence to appear in the warning dialog with a timer showing the seconds remaining, use this option. Example: `countdownMessage: 'Redirecting in {timer}.'` Place the `{timer}` string where you want the numeric countdown to appear. Another example: `countdownMessage: '{timer} remaining.'`. Can be combined with countdownBar option or used independently.

**countdownBar**

Type: `Boolean`

Default: `false`

If `true`, ads a countdown bar (uses Bootstrap progress bar) to the warning dialog. Can be combined with countdownMessage option or used independently.

**onStart**

Type: `Function` or `Boolean`

Default: `false`

Optional callback fired when first calling the plugin and every time user refreshes the session (on any mouse, keyboard or touch action). Takes options object as the only argument.


**onWarn**

Type: `Function` or `Boolean`

Default: `false`

Custom callback you can use instead of showing the Bootstrap warning dialog. Takes options object as the only argument.

Redirect action will still occur unless you also add the `onRedir` callback.

**onRedir**

Type: `Function` or `Boolean`

Default: `false`

Custom callback you can use instead of redirecting the user to `redirUrl`. Takes options object as the only argument.

## Examples

You can play around with the examples in the `/examples` directory.


**Basic Usage**

Shows the warning dialog after one minute. The dialog is visible for another minute. If user takes no action (interacts with the page in any way), browser is redirected to `redirUrl`. On any user action (mouse, keyboard or touch) the timeout timer is reset. Of course, you will still need to close the dialog.

```js
$.sessionTimeout({
	message: 'Your session will be locked in one minute.',
	keepAliveUrl: 'keep-alive.html',
	logoutUrl: 'login.html',
	redirUrl: 'locked.html',
	warnAfter: 60000,
	redirAfter: 120000
});
```

**With onWarn Callback**

Shows the "Warning!" alert after one minute. If user takes no action (interacts with the page in any way), after one more minute the browser is redirected to `redirUrl`. On any user action (mouse, keyboard or touch) the timeout timer is reset.

```js
$.sessionTimeout({
	redirUrl: 'locked.html',
	warnAfter: 60000,
	redirAfter: 120000,
	onWarn: function () {
		alert('Warning!');
	}
});
```

**With both onWarn and onRedir Callback**

Console logs the "Your session will soon expire!" text after one minute. If user takes no action (interacts with the page in any way), after two more minutes the "Your session has expired!" alert gets shown. No redirection occurs. On any user action (mouse, keyboard or touch) the timeout timer is reset.

```js
$.sessionTimeout({
	warnAfter: 60000,
	redirAfter: 180000,
	onWarn: function () {
		console.log('Your session will soon expire!');
	},
	onRedir: function () {
		alert('Your session has expired!');
	}
});
```

**With countdown message and bar displayed in warning dialog**

Same as basic usage except you'll also see the countdown message and countdown bar in the warning dialog. Uses Bootstrap progress bar. In countdownMessage place the `{timer}` string where you want the numeric countdown (seconds) to appear.

```js
$.sessionTimeout({
    keepAliveUrl: 'keep-alive.html',
    logoutUrl: 'login.html',
    redirUrl: 'locked.html',
    warnAfter: 60000,
	redirAfter: 120000,
    countdownMessage: 'Redirecting in {timer} seconds.',
    countdownBar: true
});
```

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add comments for any new or changed functionality. Lint and test your code using [Grunt](http://gruntjs.com/).

## Release History
 * **1.0.3** `2015-07-17`
	 * Fixes various reported bugs
 * **1.0.2** `2015-02-10`
	 * Added optional onStart callback.
	 * All custom callbacks nowreceive options object as argument. 
	 * Added optional countdown message. Added optional countdown bar.
 * **1.0.1** `2014-01-23`
	 * Added an option to send data to the keep-alive URL.
 * **1.0.0** `2014-01-22`
	 * Initial release.

## License
Copyright (c) 2014 [Orange Hill](http://www.orangehilldev.com). Licensed under the MIT license.
