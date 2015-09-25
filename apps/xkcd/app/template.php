<html>
  <head>
    <title>Tactus App: <?php echo $app->getName(); ?></title>

    <?php $app->head(); ?>
  </head>
  <body>
    <?php $app->bodyHead(); ?>

    <div class="container text-center">
      <h3>xkcd.com/<?php echo $xkcd->num ?></h3>
      <img src="<?php echo $xkcd->img; ?>" /><br />

      <h4><?php echo $xkcd->alt; ?></h4>
    </div>

    <?php $app->bodyFooter(); ?>
  </body>
</html>
