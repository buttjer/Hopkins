<section>
  <header>
    <nav class="contentypes">
      <?php foreach($contenttypes as $name => $item): ?>
        <a href="<?php print $global["basepath"] . $item; ?>"><?php print $name; ?></a>
      <?php endforeach; ?>
    </nav>
    <nav class="actions">
      <?php foreach($actions as $name => $item): ?>
        <a href="<?php print $global["basepath"] . $item; ?>"><?php print $name; ?></a>
      <?php endforeach; ?>
    </nav>
    <?php if(isset($action)): ?>
      <h1><?php print $action; ?></h1>
    <?php endif; ?>
  </header>
  <?php if($next = next($view)) include($next) ?>
</section>
