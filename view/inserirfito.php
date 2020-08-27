<?php

require_once('../control/FitoCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $fitoCTR = new FitoCTR();
    echo $fitoCTR->salvarDados($info, "inserirfito");
    
endif;
