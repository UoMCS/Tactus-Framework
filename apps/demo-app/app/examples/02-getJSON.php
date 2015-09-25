<?php
$json = $tactus->getCachedJSON('http://example.com/posts.json');
// $json is an object representation of the JSON found at the URL

// Optionally pass the number of seconds to cache the page for (defaults to 30 minutes)
$html = $tactus->getCachedJSON('http://example.com/posts.json', 1800);
