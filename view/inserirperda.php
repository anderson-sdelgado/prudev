<?php

require_once('../control/PerdaCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $perdaCTR = new PerdaCTR();
    echo $perdaCTR->salvarDados($info, "inserirperda");
    
endif;
