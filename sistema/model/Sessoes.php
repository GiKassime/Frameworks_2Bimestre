<?php
class Sessoes 
{
	private $id_sessao;
	private $id_filme;
	private $id_sala;
	private $data;
	private $horario;
	private $preco;

	function getId_sessao(){
		return $this->id_sessao;
	}
	function setId_sessao($id_sessao){
		$this->id_sessao=$id_sessao;
	}
	function getId_filme(){
		return $this->id_filme;
	}
	function setId_filme($id_filme){
		$this->id_filme=$id_filme;
	}
	function getId_sala(){
		return $this->id_sala;
	}
	function setId_sala($id_sala){
		$this->id_sala=$id_sala;
	}
	function getData(){
		return $this->data;
	}
	function setData($data){
		$this->data=$data;
	}
	function getHorario(){
		return $this->horario;
	}
	function setHorario($horario){
		$this->horario=$horario;
	}
	function getPreco(){
		return $this->preco;
	}
	function setPreco($preco){
		$this->preco=$preco;
	}

}
?>