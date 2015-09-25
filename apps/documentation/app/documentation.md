# Getting Started

## Download the Framework
Download the Tactus framework and example apps (which includes this app) from [website to be provided by Gavin].

## Setup a Local PHP Server
In order to build Tactus you'll need PHP on your local machine, if it's not already installed.

There are plenty of tutorials [on the web](https://www.google.co.uk/search?q=install%20php%20windows) for this but one of the quickest solutions is to download a package such as [XAMPP](https://www.apachefriends.org/index.html) which comes with PHP out of the box for Windows/Linux/OSX.

## Extract the Folder
Having installed PHP, extract the .zip you downloaded to the **root** of your web server (e.g. `c:\xampp\htdocs\` or `/Applications/XAMPP/htdocs/`).

Inside the zip you'll find two folders and a config file

 - `config.json` Configure your local environment here, you'll need to make changes if you don't have tactus at the root of your web server
 - `apps/` All apps are here, inside you'll find some examples inside named folders e.g. `/apps/documentation`
 - `framework/` The Tactus code lives here, inside you'll find PHP/JS/CSS that make creating apps possible
 
## Browse To Localhost
Head to `http://127.0.0.1/apps/` in your browser and you should be greeted by a simple page which includes a list of your installed apps. You can view them individually by clicking the links, this documentation is within the `documentation` app. Apps are loaded by browsing to `http://127.0.0.1/apps/app-name` for example `http://127.0.0.1/apps/documentation`.

You're now ready to start writing apps for Tactus.

If the page doesn't load, or you see a PHP error you'll need to check your PHP installation.
 
## Config.json
The majority of people won't need to change this file, but it you extract the zip somewhere other than the root of your web server you'll need to configure it.

The default file is below:

```
{
  "app-url": "/",
  "framework-public-url": "/framework/public",
  "localhost": true
}
```
 
- `app-url` tells tactus where the root of your code is, if you extracted it to `/htdocs/tactus/` (http://127.0.0.1/tactus/) this is `/tactus/`.
- `framework-public-url` tells tactus where the framework's css/js can be found, for above it would be `/tactus/framework/public`
- `localhost` tells tactus you're running code on your local machine, things might break if you turn this off

# Creating An App
Example apps can be found within the `/apps` folder in the downloaded zip. Additionally some extra code and user interface examples can be found within the `demo-app`.

## App Structure
An 'app' consists of the following files contained within a folder, such as `student-map/`, please see below for more details.

 - `index.php` - A file that bootstraps your application, any modifications will be deleted on deploy. This file is the entry point for your application.
 - `app/app.json` - A package file that sets information about your app, see below.
 - `app/index.php` - Define any variables you wish to pass to your template here. If this file exists, it will be included before `template.php`.
 - `app/template.php` - Used to define the HTML of your application and to make some callbacks to Tactus which will include the CSS/JS frameworks.
 - `app/js/app.js` - Write any javascript code here, assuming you're calling all the headers in your template.php, this file will be auto-included if it exists.
 - `app/css/app.css` - Any custom styles for your app go here, if this file exists it will be auto included in the header of `template.php`.

## Files That Make Up an App
You'll need to create each of these files to build your app.

### App.json

The app.json file is where you can tell us about your app, an example app.json for this app is below.

```
{
  "name": "Documentation",
  "version": "0.0.1",
  "description": "A rough overview of Tactus and how to build apps for it",
  "author": "Gavin Brown",
  "email": "gxb@cs.machester.ac.uk",
  "icon": "laptop",
  "color": "red",
  "tags": [
    'documentation', 'learning', 'about'
  ]
}
```

Walking through each of the possible values in turn:

- `name` - The name of your app, this appears at the top of the Tactus screen when the app is open
- `version` - The current version of this app, when you upload your app it'll replace any version with an older number.
- `description` - A short sentence or two about your app, it appears in the top right of the Tactus screen.
- `author` - Your name! This will also appear in the top right of the Tactus screen
- `email` - Your email! We'll use this to contact you about your app.
- `icon` - The icon that you would like to represent your app with, you can use any icon in
  [FontAwesome](https://fortawesome.github.io/Font-Awesome/icons/) by name. For example [fa-bicycle](http://fortawesome.github.io/Font-Awesome/icon/bicycle/) becomes `bicycle`.
- `color` - What color you would like your icon to be, possible options are: red, orange, yellow, green, blue, indigo, violet, purple.
- `tags` - An array of 'tags' you'd like to assosiate your app with, these will be used for ordering and search in the future.

### app/index.php

The index file is the entry point for your app and will automatically be loaded by the tactus framework first. It is not,
however, required.

Here you can make any web requests or set variables for use in your apps template. An example `index.php` which
searches the twitter api is below.

```
<?php

// Make the request to twitter, cache it and save it as a variable
$tweets = $app->getCachedJSON('https://api.twitter.com/1.1/search/tweets.json?q=uomcompsci');

// Go though all of the tweets and store the locations in an array
$locations = array();
foreach($tweets as $tweet) {
  $locations[] = array('lat' => $tweet->lat, 'long' => $tweet->long);
}
```

### app/template.php

This is the second PHP file loaded by tactus (if it exists), it's expected that you'll define the layout of your app here.
A starter template.php is below, which continues the example of the twitter search app.

Note the calls to `$app->head();`, `$app->bodyHead();` and `$app->bodyFooter()` which are required for your app to load.

```
<html>
  <head>
    <title>Tactus App: <?php echo $app->getName(); ?></title>

    <?php $app->head(); ?>
  </head>
  <body>
    <?php $app->bodyHead(); ?>

    <div class="container">
      <h1>All Tweets</h1>
      <?php foreach($tweets as $tweet): ?>
        Tweet: <?php echo $tweet->message; ?><br />
      <?php endforeach; ?>

      <h1>All Locations</h1>
      <?php foreach($locations as $location): ?>
        Lat: <?php echo $location['lat']; ?>, Long: <?php echo $location['lat']; ?><br />
      <?php endforeach; ?>
    </div>

    <?php $app->bodyFooter(); ?>
  </body>
</html>
```

The above template.php code outputs something along the lines of below.
Note how the following framework files are automatically included:

 - Vendors.js which provides jquery and bootstraps javascript functionality
 - Tactus.js the tactus javascript framework
 - Bootstap.css a custom build of [Bootstrap](http://getbootstrap.com/) designed for use on the Tactus screen
 - App.css some overrides that configure the touch screen
 
Along with the app specific javascript/css files

 - app/js/app.js any custom javascript for your app can go here, it will only be included if it exists
 - app/css/app.css any custom css for your app can go here, it will only be included if it exists

```
<html>
  <head>
    <title>Tactus App: Documentation</title>

    <!-- Include jquery & bootstrap js -->
    <script src="/framework/public/js/vendors.js"></script>

    <!-- Tactus javascript framework -->
    <script src="/framework/public/js/tactus.js"></script>

    <!-- Include tactus bootstrap -->
    <link rel="stylesheet" href="framework/public/css/bootstrap.css">

    <!-- Tactus app default overrides -->
    <link rel="stylesheet" href="framework/public/css/app.css" />

    <!-- App JS and CSS -->
    <script src="app/js/app.js"></script>
    <link rel="stylesheet" href="app/css/app.css">
  </head>
  <body>
    <div class="container">
      <h1>All Tweets</h1>
      Tweet: Hello this tweet is from the API<br />
      Tweet: Hello this tweet is also from the API<br />
      
      <h1>All Locations</h1>
      Lat: 0.111, Long: 0.2232<br />
      Lat: 0.323, Long: 0.233<br />
    </div>
  </body>
</html>
```

### app/js/app.js
Write any custom javascript code here, assuming you're calling all the headers in your `template.php`, this file will be auto-included if it exists.
Example content could be:

```
$(document).ready(function() {
	alert("The page has loaded, welcome to my app");
});
```

### app/css/app.css
Any custom styles for your app go here, if this file exists it will be auto included in the header of `template.php`.

```
body {
    color: purple; /* Purple font */ 
    background-color: #d8da3d; /* A green background */
}
```

## PHP Framework
Tactus provides various helpers to speed up the development of your app.

In both your template.php and index.php `$app` is a reference to the current instance of your app. For example you can call `$app->getName();` to get the name of the current app.

- `$app->getName()`
- `$app->getVersion()`
- `$app->getDescription()`
- `$app->getURL()`
- `$app->getIcon()`
- `$app->getTags()`
- `$app->getAuthor()`

In addition to information about your app, some helper methods are defined under `$tactus`.

 - `$tactus->getCachedHTML($url)` - downloads a file from the Internet but stores it in a cache. When accessing remote files, this should always be used.
 - `$tactus->getCachedJSON($url, $minutesToCacheFor)` - downloads a .json file over the internet and returns a JSON representation for the file.

That's it for now, other methods including database access are coming soon. Have a suggestion for a method? Let us know!

Thse methods must be called in your app's `template.php`, or it'll fail to boot.

- `$app->head()` - Call this at the end of your `<head>`er, it adds extra CSS and JS

- `$app->bodyHead()` - Call this at the top of your `<body>`

- `$app->bodyFooter()` - Call this at the end of your body, just before `</body>`

### PHP Classes
For the more advanced developers, the following classes are available:

 - ApiWrapper - An abstract wrapper around an HTTP api with `post($dataToPost)` and `get($dataToGet, $cacheMinutes)` methods.
 - TactusApp - Represents a tactus app (available as `$app` within your app), view TactusApp.php for all included methods.
