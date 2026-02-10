<?php

/**
 * GENERADOR DE SLUGS - URLs Amigables
 * Convierte nombres comerciales a slugs para URLs
 */

class SlugManager {
    
    /**
     * Generar slug desde un nombre
     * Ej: "Mi Empresa, S.L." → "mi-empresa-sl"
     */
    public static function generateSlug($nombre) {
        // Convertir a minúsculas
        $slug = strtolower($nombre);
        
        // Reemplazar caracteres especiales
        $slug = str_replace([
            'á', 'à', 'ä', 'â',
            'é', 'è', 'ë', 'ê',
            'í', 'ì', 'ï', 'î',
            'ó', 'ò', 'ö', 'ô',
            'ú', 'ù', 'ü', 'û',
            'ñ', 'ç'
        ], [
            'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'n', 'c'
        ], $slug);
        
        // Reemplazar espacios y caracteres especiales con guiones
        $slug = preg_replace('/[^a-z0-9\-]+/', '-', $slug);
        
        // Eliminar guiones al inicio y final
        $slug = trim($slug, '-');
        
        // Eliminar guiones múltiples
        $slug = preg_replace('/-+/', '-', $slug);
        
        return $slug;
    }
    
    /**
     * Obtener slug de una empresa por ID desde la BD
     */
    public static function getSlugById($empresa_id) {
        try {
            $db = Database::getInstance();
            $stmt = $db->getConnection()->prepare("
                SELECT nombre_comercial FROM empresas WHERE id = ? LIMIT 1
            ");
            $stmt->bind_param("i", $empresa_id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado && $fila = $resultado->fetch_assoc()) {
                return self::generateSlug($fila['nombre_comercial']);
            }
        } catch (Exception $e) {
            error_log("Error obteniendo slug: " . $e->getMessage());
        }
        
        return null;
    }
    
    /**
     * Obtener ID de empresa desde su slug
     */
    public static function getIdBySlug($slug) {
        try {
            $db = Database::getInstance();
            $stmt = $db->getConnection()->prepare("
                SELECT id, nombre_comercial FROM empresas WHERE estado = 'activo'
            ");
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            while ($fila = $resultado->fetch_assoc()) {
                if (self::generateSlug($fila['nombre_comercial']) === $slug) {
                    return $fila['id'];
                }
            }
        } catch (Exception $e) {
            error_log("Error obteniendo ID desde slug: " . $e->getMessage());
        }
        
        return null;
    }
    
    /**
     * Obtener datos completos de empresa desde slug
     */
    public static function getEmpresaBySlug($slug) {
        try {
            $db = Database::getInstance();
            $stmt = $db->getConnection()->prepare("
                SELECT id, nombre_comercial, logo_url, nif_cif FROM empresas 
                WHERE estado = 'activo'
            ");
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            while ($fila = $resultado->fetch_assoc()) {
                if (self::generateSlug($fila['nombre_comercial']) === $slug) {
                    return $fila;
                }
            }
        } catch (Exception $e) {
            error_log("Error obteniendo empresa desde slug: " . $e->getMessage());
        }
        
        return null;
    }
}
?>
