<ul>
<?php foreach($entries as $key => $entry): ?>
  <li><a href="<?php print $_SERVER["SCRIPT_NAME"] . '/admin/content/' . $type . '/entry/' . $key; ?>"><?php print ($entry['title'] != "") ? $entry['title'] : (string)$entry['_id']; ?></a></li>
<?php endforeach; ?>
</ul>