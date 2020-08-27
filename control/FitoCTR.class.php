<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LogDAO.class.php');
require_once('../model/dao/CabecFitoDAO.class.php');
require_once('../model/dao/RespFitoDAO.class.php');
/**
 * Description of FitoCTR
 *
 * @author anderson
 */
class FitoCTR {
    
    public function salvarDados($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $pos1 = strpos($dados, "_") + 1;

        $cabec = substr($dados, 0, ($pos1 - 1));
        $resp = substr($dados, $pos1);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjResp = json_decode($resp);

        $dadosCabec = $jsonObjCabec->cabec;
        $dadosResp = $jsonObjResp->resp;

        $ret = $this->salvarCabec($dadosCabec, $dadosResp);

        return $ret;
    }

    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina);
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    private function salvarCabec($dadosCabec, $dadosResp) {
        $cabecFitoDAO = new CabecFitoDAO();
        $idCabecArray = array();
        foreach ($dadosCabec as $cabec) {
            $v = $cabecFitoDAO->verifCabec($cabec);
            if ($v == 0) {
                $cabecFitoDAO->insCabec($cabec);
            }
            $idCabec = $cabecFitoDAO->idCabec($cabec);
            $this->salvarResp($idCabec, $cabec->idCabecFito, $dadosResp);
            $idCabecArray[] = array("idCabecFito" => $cabec->idCabecFito);
        }
        $dadoCabec = array("cabec"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return 'GRAVOU-FITO_' . $retCabec;
    }

    private function salvarResp($idCabecBD, $idCabecCel, $dadosResp) {
        $respFitoDAO = new RespFitoDAO();
        foreach ($dadosResp as $resp) {
            if ($idCabecCel == $resp->idCabecRespFito) {
                $v = $respFitoDAO->verifResp($idCabecBD, $resp);
                if ($v == 0) {
                    $respFitoDAO->insResp($idCabecBD, $resp);
                }
            }
        }
    }
    
}
