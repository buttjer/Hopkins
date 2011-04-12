<?php global $global; ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title><?php print $global['title']; ?></title>
  <script src="http://use.typekit.com/zkz3rzs.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>
  <link rel="stylesheet" href="<?php print $_SERVER["SCRIPT_NAME"] ?>/../assets/style.css" type="text/css" media="screen">
  <link rel="alternate" type="application/atom+xml" title="<?php print $global['title']; ?> feed" href="<?php print $_SERVER["SCRIPT_NAME"] ?>/blog/feed" />
</head>
<body>
  <script>
    if (!!navigator.userAgent.match(/WebKit/)) document.getElementsByTagName('html')[0].className = 'webkit';
  </script>
  <div id="page">
  <header id="title">
    <canvas id="c" width="160" height="165"></canvas>
    <div>
      <h1>bureaubureau</h1>
      <nav>
        <ul>
          <?php foreach ($menu as $item): ?>
          <li>
            <a href="<?php print $_SERVER["SCRIPT_NAME"] ?><?php print $item['path'] ?>" <?php if($item['status'] === true): ?>class="active"<?php endif; ?>><?php print $item['title'] ?></a>
          </li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </div>
  </header>
  
  <section id="content">
    <?php if($next = next($view)) include($next) ?>
  </section>
  </div>
  <footer id="footer">
    <div id="color"></div>
  </footer>
  <script src="<?php print $_SERVER["SCRIPT_NAME"] ?>/../assets/script.js"></script>
</body>
</html>