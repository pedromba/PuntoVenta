<?php

/**
 * CONFIGURACIÓN DE BASE DE DATOS
 * PuntoVenta - Sistema de Gestión Integral
 */

// Definiciones de conexión
define("HOST", "localhost");
define("USUARIO", "root");
define("PASSWD", "");
define("BBDD", "puntoventa");
define("PUERTO", 3306);

// Configuraciones del sistema
define("APP_NAME", "PuntoVenta");
define("APP_VERSION", "2.0");
define("APP_ENV", "development"); // development, staging, production

/**
 * Clase Database - Gestión de conexión mejorada
 */
class Database {
    private static $instance = null;
    private $conexion;
    private $error;
    
    private function __construct() {
        $this->conectar();
    }
    
    /**
     * Obtener instancia única de la base de datos (Singleton)
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Establecer conexión a la base de datos
     */
    private function conectar() {
        try {
            $this->conexion = new mysqli(HOST, USUARIO, PASSWD, BBDD, PUERTO);
            
            if ($this->conexion->connect_error) {
                throw new Exception("Error de conexión: " . $this->conexion->connect_error);
            }
            
            $this->conexion->set_charset("utf8mb4");
            $this->conexion->query("SET NAMES utf8mb4");
            
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $this->registrarError($e->getMessage());
            die($this->error);
        }
    }
    
    /**
     * Obtener objeto de conexión
     */
    public function getConnection() {
        return $this->conexion;
    }
    
    /**
     * Ejecutar consulta segura con prepared statements
     */
    public function query($sql, $tipos = "", $parametros = []) {
        try {
            $stmt = $this->conexion->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Error en la preparación: " . $this->conexion->error);
            }
            
            if (!empty($parametros)) {
                $stmt->bind_param($tipos, ...$parametros);
            }
            
            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución: " . $stmt->error);
            }
            
            return $stmt;
            
        } catch (Exception $e) {
            $this->registrarError($e->getMessage());
            return false;
        }
    }
    
    /**
     * Obtener resultados como array asociativo
     */
    public function obtener($sql, $tipos = "", $parametros = []) {
        $stmt = $this->query($sql, $tipos, $parametros);
        
        if (!$stmt) {
            return [];
        }
        
        $resultado = $stmt->get_result();
        $datos = [];
        
        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
        
        $stmt->close();
        return $datos;
    }
    
    /**
     * Obtener un solo registro
     */
    public function obtenerUno($sql, $tipos = "", $parametros = []) {
        $resultado = $this->obtener($sql, $tipos, $parametros);
        return !empty($resultado) ? $resultado[0] : null;
    }
    
    /**
     * Insertar registro
     */
    public function insertar($tabla, $datos) {
        $columnas = array_keys($datos);
        $valores = array_values($datos);
        $placeholders = str_repeat('?,', count($datos) - 1) . '?';
        $tipos = $this->determinarTipos($valores);
        
        $sql = "INSERT INTO $tabla (" . implode(',', $columnas) . ") VALUES ($placeholders)";
        $stmt = $this->query($sql, $tipos, $valores);
        
        return $stmt ? $this->conexion->insert_id : false;
    }
    
    /**
     * Actualizar registros
     */
    public function actualizar($tabla, $datos, $condicion, $tiposCondicion = "", $parametrosCondicion = []) {
        $set = [];
        $valores = [];
        
        foreach ($datos as $columna => $valor) {
            $set[] = "$columna = ?";
            $valores[] = $valor;
        }
        
        $tipos = $this->determinarTipos($valores) . $tiposCondicion;
        $valores = array_merge($valores, $parametrosCondicion);
        
        $sql = "UPDATE $tabla SET " . implode(', ', $set) . " WHERE $condicion";
        
        return $this->query($sql, $tipos, $valores) ? true : false;
    }
    
    /**
     * Eliminar registros (Soft Delete)
     */
    public function eliminar($tabla, $condicion, $tiposCondicion = "", $parametrosCondicion = []) {
        $sql = "UPDATE $tabla SET eliminado_at = NOW() WHERE $condicion";
        return $this->query($sql, $tiposCondicion, $parametrosCondicion) ? true : false;
    }
    
    /**
     * Contar registros
     */
    public function contar($tabla, $condicion = "", $tiposCondicion = "", $parametrosCondicion = []) {
        $sql = "SELECT COUNT(*) as total FROM $tabla";
        
        if (!empty($condicion)) {
            $sql .= " WHERE $condicion";
        }
        
        $resultado = $this->obtenerUno($sql, $tiposCondicion, $parametrosCondicion);
        return $resultado ? $resultado['total'] : 0;
    }
    
    /**
     * Determinar tipos de parámetros automáticamente
     */
    private function determinarTipos($valores) {
        $tipos = "";
        foreach ($valores as $valor) {
            if (is_int($valor)) {
                $tipos .= 'i';
            } elseif (is_float($valor)) {
                $tipos .= 'd';
            } else {
                $tipos .= 's';
            }
        }
        return $tipos;
    }
    
    /**
     * Registrar errores en log
     */
    private function registrarError($mensaje) {
        $archivo_log = __DIR__ . '/errores.log';
        $timestamp = date('Y-m-d H:i:s');
        error_log("[$timestamp] " . APP_NAME . " - " . $mensaje . "\n", 3, $archivo_log);
    }
    
    /**
     * Cerrar conexión
     */
    public function cerrar() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}

// Crear instancia global de la base de datos
$db = Database::getInstance();
$conexion = $db->getConnection();

// Registrar cierre de conexión al finalizar
register_shutdown_function(function() {
    global $db;
    if ($db) {
        $db->cerrar();
    }
});
