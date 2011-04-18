<ul>
<?php foreach($entries as $key => $entry): ?>
  <li><a href="<?php print $global["basepath"] . 'admin/content/' . $entry['type'] . '/entry/' . $key; ?>"><?php print ($entry['title'] != "") ? $entry['title'] : (string)$entry['_id']; ?></a></li>
<?php endforeach; ?>
</ul>