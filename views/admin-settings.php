<?php $this->helper('formgen'); ?>
<form name="settings" method="post" action="">
  <input type="submit" name="Submit" value="Submit" />
  <nav>
    <a class="adddocument" href="#" data-parentkey="settings">add document</a>
  </nav>
  <?php print (isset($settings)) ? formgen_r($settings, 'settings') : ''; ?>
  <input type="submit" name="Submit" value="Submit" />
</form>