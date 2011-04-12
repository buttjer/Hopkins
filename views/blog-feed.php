<?php global $global; ?>
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title><?php print $global['title']; ?></title>
  <id><?php print $global['domain']; ?></id>
  <link rel="self" href="/" />
  <updated><?php $date = current($entries); print $date['date']; ?></updated>
<?php foreach($entries as $key => $entry): ?>
<?php
$date = new DateTime($entry['date']);
?>
<entry>
  <id>blog/entry/<?php print $entry['id']; ?></id>
  <link rel="alternate" href="http://www.<?php print $global['domain']; ?>/blog/entry/<?php print $entry['id']; ?>"/>
  <title><?php print $entry['title']; ?></title>
  <summary><?php print $entry['subtitle']; ?></summary>
  <updated><?php print $date->format('j.n.y'); ?></updated>
  <adress><?php print $entry['author']; ?></adress>
  <content type="xhtml">
   <div xmlns="http://www.w3.org/1999/xhtml">
    <?php print $entry['text']; ?>
    </div>
  </content>
</entry>
<?php endforeach; ?>
</feed>