<?php
require_once '../model/Cidade.php';
require_once '../dao/CidadeDAO.php';

class CidadeControl 
{
	private $dao;
	private $cidade;
	private $acao;

	public function __construct() {
		$this->cidade = new Cidade();
		$this->dao = new CidadeDAO();
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
	public function buscarPorId(Cidade $cidade) {
	}

}
new CidadeControl();
?>