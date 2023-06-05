<?php

require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=api','root',''));


Flight::route('GET /alumnos', function () {
   
  
   $sentencia=Flight::db()->prepare("SELECT * FROM alumnos ");
   
    $sentencia->execute();
    $datos=$sentencia->fetchAll();
    Flight::json($datos);
});

Flight::route('POST /alumnos', function () {

    $nombre=(Flight::request()->data->nombre);
    $apellidos=(Flight::request()->data->apellidos);
   
    $sql="INSERT INTO alumnos (nombre,apellidos) VALUES(?,?)";
    $sentencia=Flight::db()->prepare($sql);
    $sentencia->bindParam(1,$nombre);
    $sentencia->bindParam(2,$apellidos);
    
     $sentencia->execute();
    // $datos=$sentencia->fetchAll();
     Flight::jsonp(["alumno agregado"]);
 });

 Flight::route('DELETE /alumnos', function (){
  $id=(Flight::request()->data->id);
  $sql="DELETE FROM alumnos WHERE id=?";
  $sentencia=Flight::db()->prepare($sql);
  $sentencia->bindParam(1,$id);
  $sentencia->execute();
  Flight::jsonp(["borrado"]);
  
 });
 Flight::route('PUT /alumnos', function (){
    $id=(Flight::request()->data->id);
    $nombre=(Flight::request()->data->nombre);
    $apellidos=(Flight::request()->data->apellidos);
    $sql="UPDATE alumnos SET nombre=?,apellidos=? WHERE id=?";
    $sentencia=Flight::db()->prepare($sql);
    $sentencia->bindParam(3,$id);
    $sentencia->bindParam(1,$nombre);
    $sentencia->bindParam(2,$apellidos);
    $sentencia->execute();
    Flight::jsonp(["editado"]);






 });






Flight::start();
