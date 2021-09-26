<?php

require_once('./source/rastrear.class.php');

/**
 * Abaixo segue exemplo de uso desta classe. 
 * Usando como parametros um codigo de rastreamento 
 * hipotetico, e os dados de conexao que são encontrados 
 * nas documentacoes do sistema.
 */

// FORM
$user = isset($_POST['user']) ? $_POST['user'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$code = isset($_POST['code']) ? $_POST['code'] : '';

# setando os parametros de inicialização
// Ex: array( 'user' => 'ECT', 'pass' => 'SRO', 'tipo' => 'L', 'resultado' => 'T', 'idioma' => 101)
$_params = array('user' => $user, 'pass' => $password, 'tipo' => 'L', 'resultado' => 'T', 'idioma' => 101);

# iniciando objeto. 
# note que: mesmo que nao sejam passados parametros, 
# a classe deve funcionar corretamente com os parametros defaults.
Rastrear::init($_params);

# rastreando um objeto hipotetico ex: 'QF566633470BR'
$obj = Rastrear::get($code);

$_REQUEST["objetoRastreio"] = $obj;

require("index.php");