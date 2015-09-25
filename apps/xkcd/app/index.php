<?php

$xkcd = $app->getCachedJSON('http://xkcd.com/info.0.json', $cacheMinutes = 86400);
