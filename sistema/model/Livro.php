<?php
class Livro {
	private $id;
	private $titulo;
	private $ano_publicacao;
	private $id_autor;
	private $id_categoria;
	private $preco;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getTitulo(){
		return $this->titulo;
	}
	function setTitulo($titulo){
		$this->titulo=$titulo;
	}
	function getAno_publicacao(){
		return $this->ano_publicacao;
	}
	function setAno_publicacao($ano_publicacao){
		$this->ano_publicacao=$ano_publicacao;
	}
	function getId_autor(){
		return $this->id_autor;
	}
	function setId_autor($id_autor){
		$this->id_autor=$id_autor;
	}
	function getId_categoria(){
		return $this->id_categoria;
	}
	function setId_categoria($id_categoria){
		$this->id_categoria=$id_categoria;
	}
	function getPreco(){
		return $this->preco;
	}
	function setPreco($preco){
		$this->preco=$preco;
	}

}
?>