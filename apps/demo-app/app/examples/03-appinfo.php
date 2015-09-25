<?php

# All values are set in the app.json file

echo $app->getID();
# ID, e.g. demo-app

echo $app->getName();
# Full name, e.g. Demo App

echo $app->getVersion();
# Version number, e.g. 0.0.1

echo $app->getDescription();
# The description set in app.json, e.g. This app shows code demos for Tactus

echo $app->getAuthor();
# Authors Name, e.g. Gavin Brown
