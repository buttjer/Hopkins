<?php global $global; ?>
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title><?php print $global['title']; ?></title>
  <id>http://www.<?php print $global['domain']; ?>/</id>
  <link rel="self" href="/" />
  <updated><?php $date = current($entries); print $date['date']; ?></updated>
<?php foreach($entries as $key => $entry): ?>
<?php
$date = new DateTime($entry['date']);
?>
<entry>
  <id>http://www.<?php print $global['domain']; ?><?php print $global['basepath'] ?>blog/entry/<?php print $entry['path']; ?></id>
  <link rel="alternate" href="http://www.<?php print $global['domain']; ?><?php print $global['basepath'] ?>blog/entry/<?php print $entry['path']; ?>"/>
  <title><?php print $entry['title']; ?></title>
  <summary><?php print $entry['subtitle']; ?></summary>
  <updated><?php print $entry['date']; ?></updated>
  <author><name><?php print $entry['author']; ?></name></author>
  <content type="xhtml">
   <div xmlns="http://www.w3.org/1999/xhtml">
    <?php print $entry['text']; ?>
    </div>
  </content>
</entry>
<?php endforeach; ?>
</feed>