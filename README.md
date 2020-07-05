# Reto Carcool

Generalmente los tokens se deben guardar en las variables de entorno, ya que son datos muy sensibles, laravel nos proporciona el archivo .env para insertar nuestras variables, ya sea tokens, credenciales para  acceder a servicios como correo, buckets s3, etc.

### Especificaciones del proyecto
#### Feature tests
El proyecto tiene una suit de feature test para validar las funcionalidades del Player Model.

#### Relaciones
Se ha generado una relación de many to many ficticio (Player, Team, PlayerTeam Models).

#### Método que retorne todos los clubes en los cuales ha jugado anteriormente. 
El metodo se encuentra en PlayerController@getAllTeamsPlayer

***url => /players/teams/all***
