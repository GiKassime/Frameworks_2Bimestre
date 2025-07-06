<?php
require_once("../model/Livro.php");
require_once("../dao/LivroDao.php");
class LivroControl {
    private $livro;
    private $acao;
    private $dao;
    public function __construct(){
       $this->livro=new Livro();
      $this->dao=new LivroDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Livro $livro){}
    function buscaTodos(){}

}
new LivroControl();
?>