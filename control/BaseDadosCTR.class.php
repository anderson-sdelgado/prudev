<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../control/AtualAplicCTR.class.php');
require_once('../model/AtivDAO.class.php');
require_once('../model/AtualAplicDAO.class.php');
require_once('../model/FuncDAO.class.php');
require_once('../model/LiderDAO.class.php');
require_once('../model/OSDAO.class.php');
require_once('../model/ParadaDAO.class.php');
require_once('../model/RFuncaoAtivParDAO.class.php');
require_once('../model/ROSAtivDAO.class.php');
require_once('../model/TalhaoDAO.class.php');
require_once('../model/TipoApontDAO.class.php');
require_once('../model/TurmaDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    public function dadosAtiv($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
        
            $ativDAO = new AtivDAO();

            $dados = array("dados"=>$ativDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    

    public function dadosFunc($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $funcDAO = new FuncDAO();

            $dados = array("dados"=>$funcDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosLider($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
        
            $liderDAO = new LiderDAO();

            $dados = array("dados"=>$liderDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    
    public function dadosOS($info) {

        $osDAO = new OSDAO();
        $rOSAtivDAO = new ROSAtivDAO();
        $atualAplicDAO = new AtualAplicDAO();

        $jsonObj = json_decode($info['dado']);
        $dados = $jsonObj->dados;

        foreach ($dados as $d) {
            $nroOS = $d->nroOS;
            $token = $d->token;
        }

        $v = $atualAplicDAO->verToken($token);
        
        if ($v > 0) {

            $dadosOS = array("dados" => $osDAO->dados($nroOS));
            $resOS = json_encode($dadosOS);

            $dadosROSAtiv = array("dados" => $rOSAtivDAO->dados($nroOS));
            $resROSAtiv = json_encode($dadosROSAtiv);

            return $resOS . "#" . $resROSAtiv;
        
        }
        
    }
    
    public function dadosParada($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $paradaDAO = new ParadaDAO();

            $dados = array("dados"=>$paradaDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
     public function dadosRFuncaoAtivPar($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $rFuncaoAtivParDAO = new RFuncaoAtivParDAO();

            $dados = array("dados"=>$rFuncaoAtivParDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosROSAtiv($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
        
            $rOSAtivDAO = new ROSAtivDAO();

            $dados = array("dados"=>$rOSAtivDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }

    }
    
    public function dadosTalhao($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
      
            $talhaoDAO = new TalhaoDAO();

            $dados = array("dados"=>$talhaoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTipoApont($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
      
            $tipoApontDAO = new TipoApontDAO();

            $dados = array("dados"=>$tipoApontDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTurma($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){
        
            $turmaDAO = new TurmaDAO();

            $dados = array("dados"=>$turmaDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
}
