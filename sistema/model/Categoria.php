<?php
class Categoria {
	private $id;
	private $descricao;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getDescricao(){
		return $this->descricao;
	}
	function setDescricao($descricao){
		$this->descricao=$descricao;
	}

}
?>