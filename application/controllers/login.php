<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Login extends CI_Controller {

    public function logar() {
        ///////////////////////////////
        // Rececimentoi via JSON o Usuario e senha
        // Retornos possiveis :
        // 1 - Usuario e senha validados corretamente ( Banco )
        // 2 - Faltou informar o usuario (frontend)
        // 3 - Faltou informar a senha (frontend)
        // 4 - usuario ou senha invalidos (banco)
        ///////////////////
        
        // usuario e senha recebidos via JSON
        // e colocados em atributos para
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario = $resultado->usuario;
        $senha = $resultado->senha;

        if(trim($usuario) == '') { //trim = tira os espaços em branco da senha ou usuario
            $retorno = array('codigo' => 2,
                            'msg' => 'Usuário não informado');
        } elseif(trim($senha) == '') {
            $retorno = array('codigo' => 3,
                             'msg' => 'Senha não informada');
        } else {

            //realiza a instancia da model
            $this->load->model('m_acesso');

            //atributo $retorno recebe array cokm informacoes 
            //da validacao do acesso
            $retorno = $this->m_acesso->validalogin($usuario, $senha);
        }

        echo json_encode($retorno); //json_encode = pega um array e tarnsforma em json
    }
}



//instânciar = pegar, consumir

?>



