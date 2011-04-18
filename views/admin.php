<?php global $global; ?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>Page Title</title>
  </head>
  <script type="text/javascript" charset="utf-8" src="<?php print $_SERVER["SCRIPT_NAME"] ?>/../assets/admin.js"></script>
  <link type="text/css" rel="stylesheet" media="screen" href="<?php print $_SERVER["SCRIPT_NAME"] ?>/../assets/admin.css" />
  <body>
  
    <header id="title">
      <h1>Hopkins</h1>
      <nav>
      <?php foreach($nav as $name => $item): ?>
        <a href="<?php print $global['basepath'] . $item; ?>"><?php print $name; ?></a>
      <?php endforeach; ?>
      </nav>
    </header>
    <div id="content">
      <header id="headline">
      <?php $i = 0; foreach($title as $item): $i++; ?>
        <h<?php print $i; ?>><?php print $item; ?></h<?php print $i; ?>>
      <?php endforeach; ?>
      </header>
    <?php if($next = next($view)) include($next) ?>
    
    </div>
  </body>
</html>