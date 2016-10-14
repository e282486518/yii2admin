# jquery.cookieBar

A simple, lightweight jQuery plugin for creating a notification bar that is dismissable and dismiss is saved by cookie. Perfect for implementing the new eu cookielaw! - example available on [gh-pages] (http://carlwoodhouse.github.com/jquery.cookieBar)

Uses: [jQuery.Cookie](https://github.com/carhartl/jquery-cookie) - bundled, no need to reference.

## Installation

Include script *after* the jQuery library

    <script src="/path/jquery.cookieBar.js"></script>
	
If you want the default styles also include the css, if not feel free to style it as you see wish!

	<link rel="stylesheet" type="text/css" href="cookieBar.css">

## Usage

Create a cookiebar with no markup whatsoever! it's like magic ...

	<script type="text/javascript">
		$(document).ready(function() {
		  $.cookieBar();
		});
	</script>

Or, create your cookiebar markup from a simple container, example:

	<script type="text/javascript">
		$(document).ready(function() {
		  $('.cookie-message').cookieBar();
		});
	</script>
	
	<div class="cookie-message">
		The government says i have to tell you i use cookies, so here it is
    </div>
	
Or, create your cookiebar markup from a simple container with an advanced button, example:

	<script type="text/javascript">
		$(document).ready(function() {
		  $('.cookie-message').cookieBar({ closeButton : '.my-close-button' });
		});
	</script>
	
    <div class="cookie-message">
		The government says i have to tell you i use cookies, so here it is <a class="my-close-button" href>cheers!</a>
	</div>

Full Example
	Check out example.html in the repository or visit our [github-page] (http://carlwoodhouse.github.com/jquery.cookieBar)
	
## Options
**closeButton** - Define a close button for the bar

    closeButton: 'none'
	
*Default: a close button will be added automagically*

**secure** - Define if the cookie transmission requires secure protocal (https)

	secure: true
   
*Default: false*
 
 **path** - Define the path the cookie is valid for
 
	path: '/path/for/cookie'

*Default: '/' (site wide)*

**domain** - Define the domain the cookie operates on

    domain: 'domain.com'
	
*Default: domain cookie was created on*
  
## Authors

* [Carl Woodhouse](https://github.com/carlwoodhouse)
* [Craig Hamnett](https://github.com/craighamnett)
