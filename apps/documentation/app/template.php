<html>
  <head>
    <title>Tactus App: <?php echo $app->getName(); ?></title>

    <?php $app->head(); ?>
  </head>
  <body>
    <?php $app->bodyHead(); ?>

    <xmp theme="spacelab" style="display:none;">
<?php echo file_get_contents('app/documentation.md'); ?>
    </xmp>

    <?php $app->bodyFooter(); ?>

    <script src="./app/js/strapdown.js"></script>
  </body>
</html>
