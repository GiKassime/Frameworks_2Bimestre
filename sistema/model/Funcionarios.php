<?php
class Funcionarios 
{
	private $id_funcionario;
	private $nome;
	private $cargo;
	private $salario;

	function getId_funcionario(){
		return $this->id_funcionario;
	}
	function setId_funcionario($id_funcionario){
		$this->id_funcionario=$id_funcionario;
	}
	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome=$nome;
	}
	function getCargo(){
		return $this->cargo;
	}
	function setCargo($cargo){
		$this->cargo=$cargo;
	}
	function getSalario(){
		return $this->salario;
	}
	function setSalario($salario){
		$this->salario=$salario;
	}

}
?>