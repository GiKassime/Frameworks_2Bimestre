<?php
require_once '../model/Filmes.php';
require_once '../dao/FilmesDAO.php';

class FilmesControl 
{
	private $dao;
	private $filmes;
	private $acao;

	public function __construct() {
		$this->filmes = new Filmes();
		$this->dao = new FilmesDAO();
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
	public function buscarPorId(Filmes $filmes) {
	}

}
new FilmesControl();
?>