<?php
function render_template($__view, $__data)
{
    extract($__data);
    ob_start();
    require_once($__view);
    $output = ob_get_clean();
    return $output;
}

function out_time() {
  date_default_timezone_set('Asia/Irkutsk');
  $dates=explode("-", date("m-d-Y"));
  $then=mktime (0,0,0,$dates[0],$dates[1]+1,$dates[2]);
  $now=time();
  $how=$then-$now;
  $hours=floor($how/3600);
  $mins=floor(($how-($hours*3600))/60);
  $time = $hours . " : " . $mins;
  return $time;
}
