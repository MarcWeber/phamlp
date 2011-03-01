<?php

include "test_inc.php";


$source = <<<END

a {
  @if #ccc {color: #111; }
  @if 123 {color: #222; }
  @if true {color: #333; }
  @if "test" {color: #444; }
  @if 0 {color: #555; }
  @if 0 {color: #666; }
  @else {color: #777; }
}

END;

echo '<pre>'.$sass->toCss($source, false).'</pre>';