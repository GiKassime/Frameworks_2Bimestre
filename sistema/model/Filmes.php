<?php
class Filmes 
{
	private $id_filme;
	private $titulo;
	private $genero;
	private $duracao;
	private $classificacao;
	private $sinopse;

	function getId_filme(){
		return $this->id_filme;
	}
	function setId_filme($id_filme){
		$this->id_filme=$id_filme;
	}
	function getTitulo(){
		return $this->titulo;
	}
	function setTitulo($titulo){
		$this->titulo=$titulo;
	}
	function getGenero(){
		return $this->genero;
	}
	function setGenero($genero){
		$this->genero=$genero;
	}
	function getDuracao(){
		return $this->duracao;
	}
	function setDuracao($duracao){
		$this->duracao=$duracao;
	}
	function getClassificacao(){
		return $this->classificacao;
	}
	function setClassificacao($classificacao){
		$this->classificacao=$classificacao;
	}
	function getSinopse(){
		return $this->sinopse;
	}
	function setSinopse($sinopse){
		$this->sinopse=$sinopse;
	}

}
?>