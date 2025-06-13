<?php
require_once '../model/Salas.php';
require_once '../dao/SalasDAO.php';

class SalasControl 
{
	private $dao;
	private $salas;
	private $acao;

	public function __construct() {
		$this->salas = new Salas();
		$this->dao = new SalasDAO();
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
	public function buscarPorId(Salas $salas) {
	}

}
new SalasControl();
?>