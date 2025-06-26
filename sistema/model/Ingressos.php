<?php
class Ingressos 
{
	private $id_ingresso;
	private $id_sessao;
	private $id_cliente;
	private $quantidade;
	private $data_compra;

	function getId_ingresso(){
		return $this->id_ingresso;
	}
	function setId_ingresso($id_ingresso){
		$this->id_ingresso=$id_ingresso;
	}
	function getId_sessao(){
		return $this->id_sessao;
	}
	function setId_sessao($id_sessao){
		$this->id_sessao=$id_sessao;
	}
	function getId_cliente(){
		return $this->id_cliente;
	}
	function setId_cliente($id_cliente){
		$this->id_cliente=$id_cliente;
	}
	function getQuantidade(){
		return $this->quantidade;
	}
	function setQuantidade($quantidade){
		$this->quantidade=$quantidade;
	}
	function getData_compra(){
		return $this->data_compra;
	}
	function setData_compra($data_compra){
		$this->data_compra=$data_compra;
	}

}
?>