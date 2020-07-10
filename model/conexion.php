<?php
class Conexion{
	public function conectar(){ 
		$link = new PDO("pgsql:host=localhost;port=5432;dbname=codevi_dev;user=postgres;password=junior");
		$link->exec("set names utf8");
		return $link;
	}
}
?>