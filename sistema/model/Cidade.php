<?php
class Cidade {
	private $id;
	private $nome;
	private $habitantes;
	private $id_estado;

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
	function getHabitantes(){
		return $this->habitantes;
	}
	function setHabitantes($habitantes){
		$this->habitantes=$habitantes;
	}
	function getId_estado(){
		return $this->id_estado;
	}
	function setId_estado($id_estado){
		$this->id_estado=$id_estado;
	}

}
?>