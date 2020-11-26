<?php
function render_template($__view, $__data)
{
    extract($__data);
    ob_start();
    require_once($__view);
    $output = ob_get_clean();
    return $output;
}
