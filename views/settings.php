<?php
function formgen($items, $parentkey) {
  $output = '';
  foreach ($items as $key => $item):
    if (is_array($item)):
      $output .= '<fieldset>';
      $output .= '<legend>';
      if (isset($item['name'])) {
        $output .= $item['name'];
      } 
      else {
        $output .= $key;
      }
      $output .= '</legend>';
      $output .= '<nav>';
      $output .= '<a class="addfield" href="#" data-parentkey="' . $parentkey . '[' . $key . ']' . '">add field</a>';
      $output .= '<a class="addfieldset" href="#" data-parentkey="' . $parentkey . '[' . $key . ']' . '">add fieldset</a>';
      $output .= '<a class="remove" href="#">remove</a>';
      $output .= '</nav>';
      $output .= formgen($item, $parentkey . '[' . $key . ']');
      $output .= '</fieldset>';
    else:
      $output .= '<fieldset>';
      $output .= '<legend>';
      $output .= $key;
      $output .= '</legend>';
      if ($key == '_id') {
        $output .= '<input name="' . $parentkey . '[' . $key . ']' . '" id="' . $parentkey . '[' . $key . ']' . '" value="' . $item . '" readonly="readonly" />';
      } else {
        $output .= '<input type="text" name="' . $parentkey . '[' . $key . ']' . '" id="' . $parentkey . '[' . $key . ']' . '" value="' . $item . '" />';
        $output .= '<nav><a class="remove" href="#">remove</a></nav>';
      }
      $output .= '</fieldset>';
    endif;
  endforeach;
  return $output;
}
?>

<form name="settings" method="post" action="">
  <input type="submit" name="Submit" value="Submit" />
  <nav>
    <a class="adddocument" href="#" data-parentkey="settings">add document</a>
  </nav>
  <?php print (isset($settings)) ? formgen($settings, 'settings') : ''; ?>
  <input type="submit" name="Submit" value="Submit" />
</form>