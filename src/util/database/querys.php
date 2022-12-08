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

function addProductWithDiscountToSale()
{
    return "INSERT INTO venta_producto(idProducto, idVenta, cantidad, precio_oferta) VALUES (?,?,?,?)";
}

function decreaseExistencias()
{
    return "UPDATE productos SET existencia=existencia-? WHERE idProducto = ?;";
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

function getProductsId()
{
    return "SELECT idProducto FROM productos";
}

function getLatestProducts()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria ORDER BY agregado LIMIT 5";
}

function getProductsByCategory()
{
    return "SELECT idProducto, p.nombre, c.nombre as categoria, descripcion, existencia, precio, imagen FROM productos as p JOIN categoria as c on c.idCategoria = p.idCategoria WHERE p.idCategoria = ? ORDER BY agregado LIMIT 5";
}

function getProductsFromVenta()
{
    return "SELECT v.idVenta, p.nombre, p.precio, vp.cantidad, (IFNULL(vp.precio_oferta,p.precio) * vp.cantidad) total, c.nombre categoria from venta v JOIN venta_producto vp on v.idVenta = vp.idVenta JOIN productos p on p.idProducto = vp.idProducto JOIN categoria c on c.idCategoria = p.idCategoria WHERE v.idVenta = ?";
}

function getNumberProductsFromVenta()
{
    return "SELECT COUNT(*) Numero_Articulos from venta v JOIN venta_producto vp on vp.idVenta = v.idVenta WHERE v.idVenta = 2 GROUP BY v.idVenta";
}

function getDetallesFromVenta()
{
    return "SELECT v.idVenta, v.fecha, v.pago, e.nombre nombre_envio, e.costo costo_envio from venta v JOIN envio e on e.id = v.idEnvio WHERE idVenta = ?;";
}

function getTotalesFromVenta()
{
    return "SELECT v.idVenta, IFNULL(SUM(porcentaje),0) descuento_cupones, SUM(v.precio_total) subtotal, SUM(v.precio_total) * (1-IFNULL(SUM(porcentaje),0)) subtotal_descuentos , (SUM(v.precio_total) * (1-IFNULL(SUM(porcentaje),0)) * .16) iva, (SUM(v.precio_total) * (1-IFNULL(SUM(porcentaje),0)) * 1.16) subtotal_iva, e.costo costo_envio, (SUM(v.precio_total) * (1-IFNULL(SUM(porcentaje),0)) * 1.16 + e.costo) total FROM (SELECT v.idVenta, IFNULL(vp.precio_oferta, p.precio) precio, (IFNULL(vp.precio_oferta, p.precio) * cantidad) precio_total, v.idEnvio FROM venta v JOIN venta_producto vp on v.idVenta = vp.idVenta JOIN  productos p on p.idProducto = vp.idProducto) v LEFT JOIN venta_cupon vc on vc.idVenta = v.idVenta LEFT JOIN (SELECT cupones.codigo, (cupones.porcentaje/100) porcentaje from cupones ) cp ON cp.codigo = vc.idCupon JOIN envio e on e.id = v.idEnvio WHERE v.idVenta = ? GROUP BY v.idVenta;";
}

function getNumeroVentasByEnvios()
{
    return "SELECT e.nombre envio, COUNT(*) numero_ventas from envio e join venta v on v.idEnvio = e.id group by e.id";
}

function getNumeroVentasByCategoria()
{
    return "SELECT c.nombre categoria, COUNT(*) ventas from venta v join venta_producto vp on vp.idVenta = v.idVenta JOIN productos p on p.idProducto = vp.idProducto JOIN categoria c on c.idCategoria = p.idCategoria GROUP BY p.idCategoria, c.nombre;";
}
function getOrdenesFromUsuario()
{
    return "SELECT idVenta, fecha, e.nombre envio, pago FROM venta v JOIN envio e on e.id = v.idEnvio WHERE idUsuario = ?";
}
