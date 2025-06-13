<?php
class Salas 
{
	private $id_sala;
	private $nome;
	private $capacidade;

	function getId_sala(){
		return $this->id_sala;
	}
	function setId_sala($id_sala){
		$this->id_sala=$id_sala;
	}
	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome=$nome;
	}
	function getCapacidade(){
		return $this->capacidade;
	}
	function setCapacidade($capacidade){
		$this->capacidade=$capacidade;
	}

}
?>