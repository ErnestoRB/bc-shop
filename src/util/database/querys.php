<?php

function registerUser()
{
    return "INSERT INTO users(nombre, apellidos, cuenta, contraseña, correo, bloqueo) VALUES (?, ?, ?, ?, ?, 0);";
}

function updateUserPassword()
{
    return "UPDATE users SET contraseña = ? WHERE idusuario = ?";
}

function setGeneratedPassword()
{
    return "UPDATE users SET passgenerado = 1 WHERE idusuario = ?";
}

function unsetGeneratedPassword()
{
    return "UPDATE users SET passgenerado = 0 WHERE idusuario = ?";
}

function blockUserAccount()
{
    return "UPDATE users SET bloqueo = 1 WHERE idusuario = ?";
}

function releaseUserAccount()
{
    return "UPDATE users SET bloqueo = 0 WHERE idusuario = ?";
}

function incrementFailed()
{
    return "UPDATE users SET fallidos=fallidos+1 WHERE idusuario = ?";
}

function clearFailed()
{
    return "UPDATE users SET fallidos = 0 WHERE idusuario = ?";
}

function addCategory()
{
    return "INSERT INTO categoria(nombre) VALUES (?);";
}

function getCategories()
{
    return "SELECT idCategoria, nombre FROM categoria";
}

function deleteCategory()
{
    return "DELETE FROM CATEGORIA WHERE idCategoria = ?;";
}

function addCupon()
{
    return "INSERT INTO cupones(codigo, porcentaje, minim, maximo) VALUES (?, ?, ?, ?)";
}

function deleteCupon()
{
    return "DELETE FROM cupones WHERE codigo = ?;";
}

function addProduct()
{
    return "INSERT into productos (nombre, idCategoria,descripcion,existencia, precio, imagen) VALUES (?,?,?,?,?,?);";
}

function updateProduct()
{
    return "UPDATE productos SET nombre=?, idCategoria=?, descripcion=?, existencia=?, precio=? WHERE idProducto = ?";
}

function updateProductWithImage()
{
    return "UPDATE productos SET nombre=?, idCategoria=?, descripcion=?, existencia=?, precio=?, imagen=? WHERE idProducto = ?";
}

function deleteProduct()
{
    return "DELETE FROM productos WHERE idProducto = ?;";
}

function registerSale()
{
    return "INSERT INTO venta(idUsuario, fecha, idEnvio, pago) VALUES (?,CURDATE(), ?, ?)";
}

function addProductToSale()
{
    return "INSERT INTO venta_producto(idProducto, idVenta, cantidad) VALUES (?,?,?)";
}

function addCouponToSale()
{
    return "INSERT INTO venta_cupon(idVenta, idCupon) VALUES (?,?)";
}

function getUserInfo()
{
    return "SELECT idusuario, nombre, apellidos, cuenta, contraseña, correo, bloqueo, fallidos, passgenerado FROM users WHERE cuenta = ?";
}

function getUserInfoByEmail()
{
    return "SELECT idusuario, nombre, apellidos, cuenta, contraseña, correo, `admin`, bloqueo, fallidos, passgenerado FROM users WHERE correo = ?";
}

function getProduct()
{
    return "SELECT idProducto, nombre, idCategoria, descripcion, existencia, precio, imagen FROM productos WHERE idProducto = ?";
}

function getProductCantidad()
{
    return "SELECT idProducto, nombre, idCategoria, descripcion, existencia, ? cantidad, precio, imagen FROM productos WHERE idProducto = ?";
}

function getCuponByCodigo()
{
    return "SELECT codigo, porcentaje, minim, maximo FROM cupones WHERE codigo = ?";
}

function getEnvios()
{
    return "SELECT id, nombre, costo FROM envio";
}

function getProducts()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria";
}


function getLatestProducts()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria ORDER BY agregado LIMIT 5";
}

function getProductsByCategory()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria WHERE p.idCategoria = ? ORDER BY agregado LIMIT 5";
}
