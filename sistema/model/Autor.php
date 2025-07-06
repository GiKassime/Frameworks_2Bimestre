<?php
class Autor {
	private $id;
	private $nome;
	private $nacionalidade;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome=$nome;
	}
	function getNacionalidade(){
		return $this->nacionalidade;
	}
	function setNacionalidade($nacionalidade){
		$this->nacionalidade=$nacionalidade;
	}

}
?>