<?php foreach($entries as $key => $entry): ?>
<?php
$date = new DateTime($entry['date']);
?>
<article class="blog">
  <header>
    <h1><a href="<?php print $global["basepath"] ?>blog/entry/<?php print $entry['path']; ?>"><?php print $entry['title']; ?></a></h1>
    <h2><?php print $entry['subtitle']; ?></h2>
    <time><?php print $date->format('j.n.y'); ?></time>
    <adress><?php print $entry['author']; ?></adress>
  </header>
  <?php print $entry['text']; ?>
</article>
<?php endforeach; ?>