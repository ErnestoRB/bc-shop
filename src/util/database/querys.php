<?php

function registerUser($nombre, $apellidos, $cuenta, $pass, $email)
{
    return "INSERT INTO users(nombre, apellidos, cuenta, contraseña, correo, bloqueo) VALUES ('$nombre', '$apellidos', '$cuenta','$pass', '$email', 0);";
}

function updateUserPassword($id, $newHash)
{
    return "UPDATE users SET contraseña = '$newHash' WHERE idusuario = '$id'";
}

function setGeneratedPassword($id)
{
    return "UPDATE users SET passgenerado = 1 WHERE idusuario = '$id'";
}

function unsetGeneratedPassword($id)
{
    return "UPDATE users SET passgenerado = 0 WHERE idusuario = '$id'";
}

function blockUserAccount($id)
{
    return "UPDATE users SET bloqueo = 1 WHERE idusuario = '$id'";
}

function releaseUserAccount($id)
{
    return "UPDATE users SET bloqueo = 0 WHERE idusuario = '$id'";
}

function incrementFailed($id)
{
    return "UPDATE users SET fallidos=fallidos+1 WHERE idusuario = '$id'";
}

function clearFailed($id)
{
    return "UPDATE users SET fallidos = 0 WHERE idusuario = '$id'";
}

function addCategory($name)
{
    return "INSERT INTO categoria(nombre) VALUES ('$name');";
}

function getCategories()
{
    return "SELECT idCategoria, nombre FROM categoria";
}

function deleteCategory($id)
{
    return "DELETE FROM CATEGORIA WHERE idCategoria = $id;";
}

function addCupon($codigo, $porcentaje, $minim, $maximo)
{
    return "INSERT INTO cupones(codigo, porcentaje, minim, maximo) VALUES ('$codigo', $porcentaje, $minim, $maximo)";
}

function deleteCupon($codigo)
{
    return "DELETE FROM cupones WHERE codigo = '$codigo';";
}

function addProduct($nombre, $id_categoria, $descripcion, $existencia, $precio, $rutaImagen)
{
    return "INSERT into productos (nombre, idCategoria,descripcion,existencia, precio, imagen) VALUES ('$nombre', $id_categoria, '$descripcion', $existencia, $precio, '$rutaImagen');";
}

function updateProduct($id, $nombre, $id_categoria, $descripcion, $existencia, $precio)
{
    return "UPDATE productos SET nombre='$nombre', idCategoria=$id_categoria, descripcion='$descripcion', existencia=$existencia, precio=$precio WHERE idProducto = $id";
}

function updateProductWithImage($id, $nombre, $id_categoria, $descripcion, $existencia, $precio, $rutaImagen)
{
    return "UPDATE productos SET nombre='$nombre', idCategoria=$id_categoria, descripcion='$descripcion', existencia=$existencia, precio=$precio, imagen='$rutaImagen' WHERE idProducto = $id";
}

function deleteProduct($id)
{
    return "DELETE FROM productos WHERE idProducto = $id;";
}

function registerSale($idUsuario)
{
    return "INSERT INTO venta(idUsuario, fecha) VALUES ($idUsuario,CURDATE())";
}

function addProductToSale($idProducto, $idVenta, $cantidad)
{
    return "INSERT INTO venta_articulo(idProducto, idVenta, cantidad) VALUES ($idProducto, $idVenta, $cantidad)";
}

function getUserInfo($username)
{
    return "SELECT idusuario, nombre, apellidos, cuenta, contraseña, correo, bloqueo, fallidos, passgenerado FROM users WHERE cuenta = '$username'";
}

function getUserInfoByEmail($email)
{
    return "SELECT idusuario, nombre, apellidos, cuenta, contraseña, correo, bloqueo, fallidos, passgenerado FROM users WHERE correo = '$email'";
}

function getProduct($id)
{
    return "SELECT idProducto, nombre, idCategoria, descripcion, existencia, precio, imagen FROM productos WHERE idProducto = $id";
}


function getProducts()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria";
}


function getLatestProducts()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria ORDER BY agregado LIMIT 5";
}
