<?php
function formgen_r($items, $parentkey) {
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
      $output .= formgen_r($item, $parentkey . '[' . $key . ']');
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

function formgen_format($items, $parentkey) {
  $output = '';
  foreach ($items as $key => $item):
    if(is_array($item)) {
      $output .= '<fieldset>';
      $output .= '<legend>';
      $output .= $key;
      $output .= '</legend>';
      if (isset($item['value'])) {
        switch($item['value']) {
          case '_today':
            $item['value'] = date('o-m-d\TG:i\Z');
            break;
          case '_currentuser':
            global $global;
            $col = $global['db']->bb->content;
            $id = new MongoId($_SESSION['user']);
            $doc = $col->findone(array('_id' => $id, 'type' => 'profile'));
            $item['value'] = $doc['title'];
            break;
        }
      } else {
        $item['value'] = '';
      }
      if (isset($item['value'])) {
        switch($item['type']) {
          case 'textfield':
            $output .= '<input type="text" name="' . $parentkey . '[' . $key . ']' . '" id="' . $parentkey . '[' . $key . ']' . '" value="' . $item['value'] . '" />';
            break;
          case 'textarea':
            $output .= '<textarea name="' . $parentkey . '[' . $key . ']' . '" id="' . $parentkey . '[' . $key . ']' . '" />' . $item['value'] . '</textarea>';
            break;
          case 'datefield':
            $output .= '<input type="datetime" name="' . $parentkey . '[' . $key . ']' . '" id="' . $parentkey . '[' . $key . ']' . '" value="' . $item['value'] . '" />';
            break;
          case 'password':
            $output .= '<input type="password" autocomplete="off" name="' . $parentkey . '[' . $key . ']' . '" id="' . $parentkey . '[' . $key . ']' . '" value="' . $item['value'] . '" />';
            break;
        }
      }
      $output .= '</fieldset>';
    }
  endforeach;
  return $output;
}