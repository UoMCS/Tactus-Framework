<?php
$html = $tactus->getCachedHTML('http://www.bbc.co.uk');
// $html now contains what is on http://www.bbc.co.uk

// Optionally pass the number of seconds to cache the page for (defaults to 30 minutes)
$html = $tactus->getCachedHTML('http://www.bbc.co.uk', 1800);
