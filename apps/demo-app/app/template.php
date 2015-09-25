<html>
  <head>
    <title>Tactus App: <?php echo $app->getName(); ?></title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <?php $app->head(); ?>
  </head>
  <body>
    <?php $app->bodyHead(); ?>

    <div class="container">
      <div class="row">
        <h2>PHP Examples</h2>

        <h3>Downloading HTML from an external URL</h3>
        <pre><code class="php"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/examples/01-getHTML.php')); ?></code></pre>

        <h3>Downloading JSON from an external API</h3>
        <pre><code class="php"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/examples/02-getJSON.php')); ?></code></pre>

        <h3>Get Information about your app from the app.json file</h3>
        <pre><code class="php"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/examples/03-appinfo.php')); ?></code></pre>
      </div>

      <div class="row">
        <h2>Bootstrap Examples</h2>
        Tactus provides a custom build of Bootstrap scaled for the high resolution tactus display.<br />
        You can read more about Tactus at
        <a href="http://getbootstrap.com/getting-started/">http://getbootstrap.com/</a>.
        Below are some example components.

        <h3>Grid</h3>
        <div class="grid-example example">
          <?php echo file_get_contents(__DIR__ . '/examples/01-grid.html'); ?>
        </div>

        <pre><code class="html"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/examples/01-grid.html')); ?></code></pre>

        <h3>Dropdown</h3>
        <div class="example">
          <?php echo file_get_contents(__DIR__ . '/examples/02-dropdown.html'); ?>
        </div>

        <pre><code class="html"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/examples/02-dropdown.html')); ?></code></pre>

        <h3>Button Group</h3>
        <div class="example">
          <?php echo file_get_contents(__DIR__ . '/examples/03-btn-group.html'); ?>
        </div>

        <pre><code class="html"><?php echo htmlspecialchars(file_get_contents(__DIR__ . '/examples/03-btn-group.html')); ?></code></pre>

        <h3>
      </div>

    </div>
    <?php $app->bodyFooter(); ?>
  </body>
</html>
