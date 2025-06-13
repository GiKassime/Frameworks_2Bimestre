<?php
require_once '../model/Clientes.php';
require_once '../dao/ClientesDAO.php';

class ClientesControl 
{
	private $dao;
	private $clientes;
	private $acao;

	public function __construct() {
		$this->clientes = new Clientes();
		$this->dao = new ClientesDAO();
		$this->verificaAcao();
		$this->acao=$_GET['a'];
	}
	public function verificaAcao() {
	}
	public function listar() {
	}
	public function inserir() {
	}
	public function alterar() {
	}
	public function excluir() {
	}
	public function buscarTodos() {
	}
	public function buscarPorId(Clientes $clientes) {
	}

}
new ClientesControl();
?>