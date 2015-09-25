<html>
  <head>
    <title>Tactus App: <?php echo $app->getName(); ?></title>

    <?php $app->head(); ?>
  </head>
  <body>
    <?php $app->bodyHead(); ?>

    <div class="container">
      <div class="col-sm-12">
        <h3>What's this?</h3>
        <p>
          Tactus is a touchscreen information system for the School, designed and built by us.
          At present the system is still in development - so watch this space.<br />
          All <b><u>students are invited to contribute</u></b> to the project, creating "apps" that will appear on the screens, all around the building.
        </p>

        <div class="pull-right">
          <img src="app/images/tactuslogo-uom.png">
        </div>

        <h3>Can I make an app?</h3>
        <p>
          Of course! Apps are basically webpages, with dynamic content provided by PHP/Javascript.<br />
          You can download the template at: <b>http://studentnet.cs.manchester.ac.uk/tactus</b><br />
          On the "wish-list" of apps at the moment are: something to visualize our @csmcr Twitter feed, something to read and display thumbnails for YouTube videos belonging to us,
          and anything that illustrates a CS principle you learnt in your studies.
        </p>

        <h3>What spec are the machines?</h3>
        They are all Dell XPS 27 All-in-one machines, i5-3330s CPU, 10-point multi-touch display.  The resolution is 2560x1440 pixels.

        <h3>Can I write an app that uses database access?</h3>
        <p>
          Sorry, not yet.  We will sort out a server as soon as possible, but probably not til closer to Christmas.
        </p>

        <div class="pull-right">
          <img src="app/images/gmapsPins.jpg" />
        </div>

        <h3>Are there any Tactus machines that I can use?</h3>
        <p>
          There are a few dotted around the school, speak to Gavin Brown (see below) for more information.
        </p>

        <h3>How can I update my map pin?</h3>
        <p>
          Head to the maps app and swipe your student ID card to login and update your map pin.</p>
        </p>

        <h3>I have another question - who should I ask?</h3>
        <p>
          <a href="http://studentnet.cs.manchester.ac.uk/tactus/Apps/StaffProfiles/showProfile.php?email=Gavin.Brown@manchester.ac.uk">Gavin Brown</a>, in room g11 on the ground floor. Please email first :-)</p>
        </div>
      </div>
    </div>

    <?php $app->bodyFooter(); ?>
  </body>
</html>
