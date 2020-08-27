<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../model/dao/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    //put your code here
    
    
    public function atualAplic($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
        
            $atualAplicDAO = new AtualAplicDAO();

            $jsonObj = json_decode($info['dado']);
            $dados = $jsonObj->dados;

            foreach ($dados as $d) {
                $celular = $d->idCelularAtual;
                $va = $d->versaoAtual;
            }
            $retorno = 'N';
            $v = $atualAplicDAO->verAtual($celular);
            if ($v == 0) {
                $atualAplicDAO->insAtual($celular, $va);
            } else {
                $result = $atualAplicDAO->retAtual($celular);
                foreach ($result as $item) {
                    $vn = $item['VERSAO_NOVA'];
                    $vab = $item['VERSAO_ATUAL'];
                }
                if ($va != $vab) {
                    $atualAplicDAO->updAtualNova($celular, $va);
                } else {
                    if ($va != $vn) {
                        $retorno = 'S';
                    }
                }
            }
            $dthr = $atualAplicDAO->dataHora();
            if ($retorno == 'S') {
                return $retorno;
            } else {
                return $retorno . "#" . $dthr;
            }
        
        }
        
    }
    
}
