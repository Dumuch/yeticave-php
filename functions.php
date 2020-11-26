<?php
function render_template($__view, $__data)
{
    extract($__data);
    ob_start();
    require $__view;
    $output = ob_get_clean();
    return $output;
}
