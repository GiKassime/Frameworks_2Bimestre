<?php
class Clientes 
{
	private $id_cliente;
	private $nome;
	private $email;
	private $telefone;

	function getId_cliente(){
		return $this->id_cliente;
	}
	function setId_cliente($id_cliente){
		$this->id_cliente=$id_cliente;
	}
	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome=$nome;
	}
	function getEmail(){
		return $this->email;
	}
	function setEmail($email){
		$this->email=$email;
	}
	function getTelefone(){
		return $this->telefone;
	}
	function setTelefone($telefone){
		$this->telefone=$telefone;
	}

}
?>