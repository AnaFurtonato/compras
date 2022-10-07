<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Usuario extends CI_Controller {

    public function inserir() {
        /////////////////////////
        //Usuario, senha, nome, tipo (Administrador ou comum)
        // Recebidos via JSON e colocado em variaveis
        // Retornos possiveis :
        // 1 - Usuario cadastrado corretamente ( Banco )
        // 2 - Faltou informar o usuario (frontend)
        // 3 - Faltou informar a senha (frontend)
        // 4 - Faltou informar o nome (frontend)
        // 5 - Faltou informar o tipo de usuario (frontend)
        // 6 - Houve algum problema no insert da tabela (banco)
        ////////////////////////
        
        // usuario e senha recebidos via JSON e colocados em atributos para
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario      = $resultado->usuario;
        $senha        = $resultado->senha;
        $nome         = $resultado->nome;
        $tipo_usuario = strtoupper($resultado->tipo_usuario);

        // Faremos uma validação para sabermos se todos os dados foram envidos 

        if(trim($usuario) == '') { //trim = tira os espaços em branco da senha ou usuario
            $retorno = array('codigo' => 2,
                            'msg' => 'Usuário não informado');
        }elseif(trim($senha) == '') {
            $retorno = array('codigo' => 3,
                             'msg' => 'Senha não informada');
        }elseif(trim($nome) == '') {
            $retorno = array('codigo' => 4,
                             'msg' => 'Nome não informada');
        }elseif ((trim($tipo_usuario) != 'ADMINISTRADOR' &&
                trim($tipo_usuario) != 'COMUM'       ) ||
                trim($tipo_usuario) == '') {
            $retorno = array('codigo' => 5,
                             'msg' => 'Tipo de usuário inválido');
        }else{

            //realiza a instancia da model
            $this->load->model('m_usuario');

            //atributo $retorno recebe array cokm informacoes da validacao do acesso
            $retorno = $this->m_usuario->inserir($usuario, $senha, $nome, $tipo_usuario);
        }

        echo json_encode($retorno); //json_encode = pega um array e tarnsforma em json
    }






    public function consultar() {
        /////////////////////////
        //Usuario, nome, tipo (Administrador ou comum)
        // Recebidos via JSON e colocado em variaveis
        // Retornos possiveis :
        // 1 - Usuario cadastrado corretamente ( Banco )
        // 5 - Faltou informar o tipo de usuario (frontend)
        // 6 - Houve algum problema no insert da tabela (banco)
        ////////////////////////
        
        // usuario e senha recebidos via JSON e colocados em atributos para
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario      = $resultado->usuario;
        $nome         = $resultado->nome;
        $tipo_usuario = strtoupper($resultado->tipo_usuario);

        // Faremos uma validação para sabermos se todos os dados foram envidos 

        if (trim($tipo_usuario) != 'ADMINISTRADOR' &&
            trim($tipo_usuario) != 'COMUM' &&
            trim($tipo_usuario) != '') {

            $retorno = array('codigo' => 5,
                             'msg' => 'Tipo de usuário inválido');
        }else{

            //realiza a instancia da model
            $this->load->model('m_usuario');

            //atributo $retorno recebe array cokm informacoes da validacao do acesso
            $retorno = $this->m_usuario->consultar($usuario, $nome, $tipo_usuario);
        }

        echo json_encode($retorno); //json_encode = pega um array e tarnsforma em json
    }





    public function alterar() {
        /////////////////////////
        //Usuario, senha, nome, tipo (Administrador ou comum)
        // Recebidos via JSON e colocado em variaveis
        // Retornos possiveis :
        // 1 - Dado(s) alterado(s) corretamente ( Banco )
        // 2 - Usuario em branco ou zerado
        // 3 - Nome não informado
        // 4 - Senha em branco
        // 5 - Tipo de usuario invalido (FrontEnd)
        // 6 - Dados não encontrados (banco)
        ////////////////////////
        
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario      = $resultado->usuario;
        $senha        = $resultado->senha;
        $nome         = $resultado->nome;
        $tipo_usuario = strtoupper($resultado->tipo_usuario);

        // Validando para tipos de usuarios que deverá ser ADMINISTRADOR, COMUM, OU VAZIO

        if (trim($tipo_usuario) != 'ADMINISTRADOR' &&
            trim($tipo_usuario) != 'COMUM' &&
            trim($tipo_usuario) != '') {

            $retorno = array('codigo' => 5,
                         'msg' => 'Tipo de usuário inválido');
        }elseif(trim($nome) == '') {
            $retorno = array('codigo' => 3,
                             'msg' => 'Nome não informada');
        }elseif(trim($usuario == '')) {
            $retorno = array('codigo' => 2,
                            'msg' => 'Usuário não informado');
        }elseif(trim($senha == '')) {
            $retorno = array('codigo' => 4,
                             'msg' => 'Senha não pode estar vazia');
        }else{

            //realiza a instancia da model
            $this->load->model('m_usuario');

            //atributo $retorno recebe array cokm informacoes da validacao do acesso
            $retorno = $this->m_usuario->alterar($usuario, $senha, $nome, $tipo_usuario);
        }

        echo json_encode($retorno); //json_encode = pega um array e tarnsforma em json
    }





    public function desativar() {
        /////////////////////////
        //Usuario recebidos via JSON e colocado em variaveis
        // Retornos possiveis :
        // 1 - Usuario desativado corretamente( Banco )
        // 2 - Usuario em branco 
        // 6 - Dados não encontrados (banco)
        ////////////////////////
        
        $json = file_get_contents('php://input');
        $resultado = json_decode($json);

        $usuario      = $resultado->usuario;
        
        // Validando para tipos de usuarios que deverá ser ADMINISTRADOR, COMUM, OU VAZIO
        
        if(trim($usuario == '')) {
            $retorno = array('codigo' => 2,
                            'msg' => 'Usuário não informado');
        }else{

            //realiza a instancia da model
            $this->load->model('m_usuario');

            //atributo $retorno recebe array cokm informacoes da validacao do acesso
            $retorno = $this->m_usuario->desativar($usuario);
        }

        echo json_encode($retorno); //json_encode = pega um array e tarnsforma em json
    }

}


?>