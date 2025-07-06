<?php
require_once("../model/Autor.php");
require_once("../dao/AutorDao.php");
class AutorControl {
    private $autor;
    private $acao;
    private $dao;
    public function __construct(){
       $this->autor=new Autor();
      $this->dao=new AutorDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Autor $autor){}
    function buscaTodos(){}

}
new AutorControl();
?>