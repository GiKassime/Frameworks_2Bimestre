<?php
require_once("../model/Categoria.php");
require_once("../dao/CategoriaDao.php");
class CategoriaControl {
    private $categoria;
    private $acao;
    private $dao;
    public function __construct(){
       $this->categoria=new Categoria();
      $this->dao=new CategoriaDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Categoria $categoria){}
    function buscaTodos(){}

}
new CategoriaControl();
?>