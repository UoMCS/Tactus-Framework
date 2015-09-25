<html>
  <head>
    <title>Tactus App: <?php echo $app->getName(); ?></title>

    <?php $app->head(); ?>
  </head>
  <body>
    <?php $app->bodyHead(); ?>

    <div class="container">

      <div class="col-sm-6">
        <h1>Daniel Drake's Project Profile</h1>

        Biometric authentication and fingerprint recognition technologies were once the stuff of
        Bond movies and spy fiction. However, such technologies are now  increasingly
        prevalent in the mobile computing market and became the focus of an undergraduate project
        by CS graduate Daniel.<br><br>

        <img class="pull-right" src="http://www.cs.manchester.ac.uk/media/eps/schoolofcomputerscience/study/undergraduate/studentexperience/d.jpg" alt="Daniel's project" />

        Daniel's project, 'fprint', enables fingerprint scanners to be used simply and efficiently
        on the open-source operating system Linux. Where previously individual
        scanners were supported by their own drivers and API (Application Programming Interface),
        Daniel created 'libfprint', a standardised API that works with a whole host of
        different fingerprint readers. In doing so, he has made previously unusable hardware
        available to Linux users, generating a sizable user base and significant media
        interest in the process. Daniel's work plugs a gap in the Open Source desktop and is now
        available via SourceForge. Undertaken by Daniel Drake, BSc Computer Science.
      </div>

      <div class="col-sm-6">
        <h2>Science, Engineering and Technology Student of the Year and Lecturer of Year 2013 award success</h2>

        <img class="pull-right" src="https://newsagent.cs.manchester.ac.uk/images/00/49/49/LauraBestStudent_web.jpg">

        <strong>Laura Howarth-Kirke</strong>, a graduate of the School of Computer Science at the University of Manchester, won awards for
        the <strong>Best Computer Science Student</strong> and the overall <strong>BP Science, Engineering and Technology Student of the Year</strong> &nbsp;honour for her
        project entitled, &lsquo;Learning and Recognising Human Gestures using the Microsoft Kinect.<br><br>

        Making use of the Microsoft Kinect device, Laura built a software interface capable of recognising human gestures for the purposes of controlling media devices like
        TVs &ndash; this is cutting edge technology, only just appearing in modern Samsung TVs this year.<br><br>

        However, the project went beyond what is available on the high street, using &lsquo;machine learning&rsquo; techniques to automatically learn new personalised gestures
        from the user. No existing retail device has this capability, yet Laura managed to build it during a five-month final year project.
        During the project, Laura learnt new programming languages and large software toolkits, as well as advanced techniques (MSc level) in Statistical Machine Learning
        called &lsquo;Hidden Markov Models&rsquo;, as well as advanced mathematical formalisms like quaternions, something that belongs on an MSc module in computer graphics.
      </div>
    </div>

    <?php $app->bodyFooter(); ?>
  </body>
</html>
