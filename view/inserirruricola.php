<?php

require_once('../control/RuricolaCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $ruricolaCTR = new RuricolaCTR();
    echo $ruricolaCTR->salvarDados($info);
    
endif;
