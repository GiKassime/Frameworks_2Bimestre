<?php
require_once '../model/Estado.php';
require_once '../dao/EstadoDAO.php';

class EstadoControl 
{
	private $dao;
	private $estado;
	private $acao;

	public function __construct() {
		$this->estado = new Estado();
		$this->dao = new EstadoDAO();
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
	public function buscarPorId(Estado $estado) {
	}

}
new EstadoControl();
?>