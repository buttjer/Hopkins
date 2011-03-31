<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>Page Title</title>
  </head>
  <script type="text/javascript" charset="utf-8" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="../../assets/admin.js"></script>
  <link type="text/css" rel="stylesheet" media="screen" href="../../assets/admin.css" />
  <body>
  
    <header>
      <nav>
      <?php foreach($nav as $name => $item): ?>
        <a href="<?php print $_SERVER["SCRIPT_NAME"] . '/' . $item; ?>"><?php print $name; ?></a>
      <?php endforeach; ?>
      </nav>
    <?php $i = 0; foreach($title as $item): $i++; ?>
      <h<?php print $i; ?>><?php print $item; ?></h<?php print $i; ?>>
    <?php endforeach; ?>
    </header>
    
    <?php if($next = next($view)) include($next) ?>
    
  </body>
</html>