<?php
require_once '../model/Ingressos.php';
require_once '../dao/IngressosDAO.php';

class IngressosControl 
{
	private $dao;
	private $ingressos;
	private $acao;

	public function __construct() {
		$this->ingressos = new Ingressos();
		$this->dao = new IngressosDAO();
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
	public function buscarPorId(Ingressos $ingressos) {
	}

}
new IngressosControl();
?>