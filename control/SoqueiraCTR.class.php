<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LogDAO.class.php');
require_once('../model/dao/CabecSoqueiraDAO.class.php');
require_once('../model/dao/AmostraSoqueiraDAO.class.php');
/**
 * Description of SoqueiraCTR
 *
 * @author anderson
 */
class SoqueiraCTR {

    public function salvarDados($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $pos1 = strpos($dados, "_") + 1;

        $cabec = substr($dados, 0, ($pos1 - 1));
        $amostra = substr($dados, $pos1);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjAmostra = json_decode($amostra);

        $dadosCabec = $jsonObjCabec->cabec;
        $dadosAmostra = $jsonObjAmostra->amostra;

        $ret = $this->salvarCabec($dadosCabec, $dadosAmostra);

        return $ret;
    }

    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina);
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    private function salvarCabec($dadosCabec, $dadosAmostra) {
        $cabecSoqueiraDAO = new CabecSoqueiraDAO();
        foreach ($dadosCabec as $cabec) {
            $v = $cabecSoqueiraDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecSoqueiraDAO->insCabec($cabec);
            }
            $idCabec = $cabecSoqueiraDAO->idCabec($cabec);
            $this->salvarAmostra($idCabec, $cabec->idCabecSoqueira, $dadosAmostra);
            $idCabecArray[] = array("idCabecSoqueira" => $cabec->idCabecSoqueira);
        }
        $dadoCabec = array("cabec"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return 'GRAVOU-SOQUEIRA_' . $retCabec;
    }

    private function salvarAmostra($idCabecBD, $idCabecCel, $dadosAmostra) {
        $amostraSoqueiraDAO = new AmostraSoqueiraDAO();
        foreach ($dadosAmostra as $amostra) {
            if ($idCabecCel == $amostra->idCabecAmostra) {
                $v = $amostraSoqueiraDAO->verifAmostra($idCabecBD, $amostra);
                if ($v == 0) {
                    $amostraSoqueiraDAO->insAmostra($idCabecBD, $amostra);
                }
            }
        }
    }
    
}
