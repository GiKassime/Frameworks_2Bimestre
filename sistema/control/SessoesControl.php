<?php
require_once '../model/Sessoes.php';
require_once '../dao/SessoesDAO.php';

class SessoesControl 
{
	private $dao;
	private $sessoes;
	private $acao;

	public function __construct() {
		$this->sessoes = new Sessoes();
		$this->dao = new SessoesDAO();
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
	public function buscarPorId(Sessoes $sessoes) {
	}

}
new SessoesControl();
?>