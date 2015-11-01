<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeProductos
 *
 * @author Jorge M. Izquierdo N
 */
class FacadeProductos {
    //put your code here
    
    private $productosDAO;
    private $conexion;
    
    function __construct() {
        $this->productosDAO = new ProductosDAO();
        $this->conexion = Conexion::getConexion();
    }
    
    function agregarProducto($productoDTO){
        return $this->productosDAO->agregarProducto($productoDTO, $this->conexion);
        
    }
            
    function listarProductos(){
        
        return $this->productosDAO->listarProductos($this->conexion);
    }
    
    function consecutivoProducto(){
        
        return $this->productosDAO->consecutivoProductos($this->conexion);
    }
    function inactivarProducto($idInactivar){
        
        return $this->productosDAO->inactivarProducto($idInactivar,  $this->conexion);
    }
    function activarProducto($idActivar){
        
        return $this->productosDAO->activarProducto($idActivar,  $this->conexion);
    }
    function consultarProducto($idProducto){
        
        return $this->productosDAO->consultarProductos($idProducto, $this->conexion);
    }
    function asociarInsumos($iDTO, $pDTO, $cantidad){
        
        return $this->productosDAO->asociarInsumos($iDTO, $pDTO, $cantidad, $this->conexion);
    }

}
