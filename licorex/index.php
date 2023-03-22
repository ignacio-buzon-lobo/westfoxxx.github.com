<?php
require_once 'usuario.php';
$usuario=new Usuario();
print_r($usuario->getAll());
//$usuario->usuario_id=1; SI QUEREMOS ACTUALIZAR UN REGISTRO HAY QUE INDICAR EL ID
$usuario->nombre='Nacho';
$usuario->email='nbl1314@gmail.com';
$usuario->password='prueba1';

$usuario->create();
//$usuario->delete(1); PARA BORRAR
//$usuario->update(); PARA ACTUALIZAR
?>