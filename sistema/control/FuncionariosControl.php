<?php
require_once '../model/Funcionarios.php';
require_once '../dao/FuncionariosDAO.php';

class FuncionariosControl 
{
	private $dao;
	private $funcionarios;
	private $acao;

	public function __construct() {
		$this->funcionarios = new Funcionarios();
		$this->dao = new FuncionariosDAO();
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
	public function buscarPorId(Funcionarios $funcionarios) {
	}

}
new FuncionariosControl();
?>