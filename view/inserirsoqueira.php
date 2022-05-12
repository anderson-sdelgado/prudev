<?php

require_once('../control/SoqueiraCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $soqueiraCTR = new SoqueiraCTR();
    echo $soqueiraCTR->salvarDados($info);
    
endif;
