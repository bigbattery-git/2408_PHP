<?php

function get_fetch_time(int $second){
  if($second < 60) {
    echo $second."초";
  }else if($second < 3600) {
    echo intval(($second / 60))."분 ";
    echo ($second % 60)."초";
  }else {
    echo intval(($second / 3600))."시 ";
    $val1 = intval(($second % 3600));

    echo intval(($val1 / 60))."분 ";

    echo ($second % 60)."초";
  }
}

get_fetch_time(19999);