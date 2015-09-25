<!-- Include jquery & bootstrap js -->
    <script src="<?php echo $this->getFrameworkPublicFolder(); ?>/js/vendors.js"></script>

<?php if(!Tactus\Config::getConfig('localhost', true)): ?>
    <!-- Log javascript errors to sentry -->
    <script src="https://cdn.ravenjs.com/1.1.22/backbone,jquery,native/raven.min.js"></script>
    <script>Raven.config('https://75ca01c80f95416ab12770bfbd62ce7d@app.getsentry.com/52945').install()</script>

<?php endif; ?>
    <!-- Tactus javascript framework -->
    <script src="<?php echo $this->getFrameworkPublicFolder(); ?>/js/tactus.js"></script>

    <!-- Include tactus bootstrap -->
    <link rel="stylesheet" href="<?php echo $this->getFrameworkPublicFolder(); ?>/css/bootstrap.css">

    <!-- Tactus app default overrides -->
    <link rel="stylesheet" href="<?php echo $this->getFrameworkPublicFolder(); ?>/css/app.css" />

    <!-- App JS and CSS -->
<?php if(file_exists($this->getDefaultJSFilePath())): ?>
    <script src="<?php echo $this->getDefaultJSFilePath(); ?>"></script>
<?php endif; ?>
<?php if(file_exists($this->getDefaultCSSFilePath())): ?>
    <link rel="stylesheet" href="<?php echo $this->getDefaultCSSFilePath(); ?>">
<?php endif; ?>
