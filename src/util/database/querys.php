<?php

function registerUser($nombre, $apellidos, $cuenta, $pass, $email)
{
    return "INSERT INTO users (nombre, apellidos, cuenta, contraseña, correo, bloqueo) VALUES ('$nombre', '$apellidos', '$cuenta', '$pass', '$email', 0)";
}

function updateUserPassword($id, $newHash)
{
    return "UPDATE users SET contraseña = '$newHash' WHERE idusuario = '$id'";
}

function blockUserAccount($id)
{
    return "UPDATE users SET bloqueo = 1 WHERE idusuario = '$id'";
}

function releaseUserAccount($id)
{
    return "UPDATE users SET bloqueado=0 WHERE idusuario = $id";
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
    return "INSERT INTO categoria(nombre) VALUES ($name);";
}

function getCategories()
{
    return "SELECT idCategoria, nombre FROM CATEGORIA";
}

function deleteCategory($id)
{
    return "DELETE FROM CATEGORIA WHERE idCategoria = $id;";
}

function addCupon($codigo, $porcentaje, $minim, $maximo)
{
    return "INSERT INTO cupones(codigo, porcentaje, minim, maximo) VALUES ($codigo, $porcentaje, $minim, $maximo)";
}

function deleteCupon($codigo)
{
    return "DELETE FROM cupones WHERE codigo = $codigo;";
}

function addProduct($nombre, $id_categoria, $descripcion, $existencia, $precio, $rutaImagen)
{
    return "INSERT into productos (nombre, id_categoría,descripción,existencia, precio, imagen) VALUES ($nombre, $id_categoria, $descripcion, $existencia, $precio, $rutaImagen);";
}

function updateProduct($id, $nombre, $id_categoria, $descripcion, $existencia, $precio, $rutaImagen)
{
    return "UPDATE productos SET nombre=$nombre, id_categoria=$id_categoria, descripción=$descripcion, existencia=$existencia, precio=$precio, imagen=$rutaImagen WHERE idProducto = $id";
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
    return "SELECT idusuario, nombre, apellidos, cuenta, contraseña, correo, bloqueo, fallidos FROM users WHERE cuenta = '$username'";
}
