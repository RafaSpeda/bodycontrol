<?php

/*
        //PDO("DRIVER:host=HOST;dbname=BANCO", "USER","SENHA");
$link = new PDO("mysql:host=localhost;dbname=MercadoDB", "root", "");
$link->exec("SET NAMES utf8");

$query = $link->prepare("select * from MercadoDB.Clientes where nome_cliente like :valor AND cpf > :num");
$query->bindValue(':valor','%Maria%');
$query->bindValue(':num', 1);


$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);
*/

require './DB.php';

$db = new DB;
$sql = " select * from Clientes where nome_cliente like :nome and :valor > 2 ";

$params = array(
    ':nome'=> 'celular',
    ':valor' => 'cpf'
);

$db->executeSQL($sql);

//var_dump($db->listData());

foreach( $db->listData() as $lista)
{
    echo "<br>";
    echo $lista['nome_cliente'] . "-" . $lista['cpf'];
}