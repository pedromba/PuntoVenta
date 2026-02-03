-- Active: 1769673830758@@127.0.0.1@3306@puntoventa
DROP DATABASE IF EXISTS puntoventa;
CREATE DATABASE IF NOT EXISTS puntoventa
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE puntoventa;

-- =============================================
-- 1. ESTRUCTURA DE EMPRESA Y PERSONALIZACIÓN
-- =============================================

CREATE TABLE IF NOT EXISTS empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_comercial VARCHAR(150) NOT NULL,
    nif_cif VARCHAR(20) UNIQUE NOT NULL,
    direccion TEXT,
    telefono VARCHAR(20),
    email_contacto VARCHAR(100),
    web VARCHAR(100),
    cuenta_bancaria VARCHAR(50),
    horario_atencion VARCHAR(255),
    logo_url VARCHAR(255),
    categoria_negocio ENUM('Alimentos', 'Moda', 'Electronica', 'Ferreteria', 'Libros', 'Farmacia', 'Clinica', 'Vehiculos') NOT NULL,
    estado ENUM('activo', 'inactivo', 'suspendido') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- White Labeling: Para que cada negocio tenga su propia identidad visual
CREATE TABLE IF NOT EXISTS configuracion_apariencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    color_primario VARCHAR(7) DEFAULT '#3498db', -- Azul por defecto
    color_secundario VARCHAR(7) DEFAULT '#2c3e50',
    fuente_familia VARCHAR(50) DEFAULT 'Inter, sans-serif',
    modo_oscuro_activado BOOLEAN DEFAULT FALSE,
    CONSTRAINT fk_apariencia_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 2. GESTIÓN FISCAL Y UNIDADES
-- =============================================

CREATE TABLE IF NOT EXISTS unidades_medida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL, -- Ej: Kilogramos, Metros, Unidades
    abreviatura VARCHAR(10) NOT NULL, -- Ej: kg, m, pza
    permite_decimales BOOLEAN DEFAULT FALSE,
    CONSTRAINT fk_uom_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS impuestos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    porcentaje DECIMAL(5, 2) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    CONSTRAINT fk_impuestos_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 3. CLASIFICACIÓN Y PRODUCTOS
-- =============================================

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT fk_cat_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT fk_marcas_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    unidad_id INT NOT NULL,
    categoria_id INT,
    marca_id INT,
    sku_interno VARCHAR(50) NOT NULL,
    nombre VARCHAR(200) NOT NULL,
    precio_compra_actual DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    precio_venta_estandar DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    stock_actual DECIMAL(12, 3) DEFAULT 0.000, -- Soporte para peso/volumen
    stock_minimo DECIMAL(12, 3) DEFAULT 0.000,
    activo BOOLEAN DEFAULT TRUE,
    CONSTRAINT fk_prod_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    CONSTRAINT fk_prod_unidad FOREIGN KEY (unidad_id) REFERENCES unidades_medida(id),
    CONSTRAINT fk_prod_cat FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL,
    CONSTRAINT fk_prod_marca FOREIGN KEY (marca_id) REFERENCES marcas(id) ON DELETE SET NULL,
    UNIQUE KEY ux_sku_empresa (empresa_id, sku_interno)
) ENGINE=InnoDB;

-- =============================================
-- 4. USUARIOS Y ENTIDADES
-- =============================================

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('superadmin', 'admin', 'finanzas', 'almacen', 'vendedor') DEFAULT 'vendedor',
    activo BOOLEAN DEFAULT TRUE,
    CONSTRAINT fk_usuarios_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    UNIQUE KEY ux_empresa_email (empresa_id, email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS entidades_externas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    tipo ENUM('proveedor', 'cliente') NOT NULL,
    nombre_razon_social VARCHAR(150) NOT NULL,
    identificacion VARCHAR(20), -- NIF, CIF, DNI
    CONSTRAINT fk_entidades_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 5. VENTAS Y CAJA
-- =============================================

CREATE TABLE IF NOT EXISTS cajas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    usuario_id INT,
    monto_apertura DECIMAL(12,2) DEFAULT 0.00,
    monto_cierre_sistema DECIMAL(12,2) DEFAULT NULL,
    monto_cierre_fisico DECIMAL(12,2) DEFAULT NULL,
    diferencia_arqueo DECIMAL(12,2) AS (monto_cierre_fisico - monto_cierre_sistema) STORED,
    estado ENUM('abierta','cerrada') DEFAULT 'abierta',
    fecha_apertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_cierre TIMESTAMP NULL,
    CONSTRAINT fk_cajas_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    usuario_id INT,
    caja_id INT,
    cliente_id INT,
    total_neto DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    total_impuestos DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    total_general DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    metodo_pago ENUM('efectivo', 'tarjeta', 'transferencia', 'credito') DEFAULT 'efectivo',
    estado ENUM('completada','anulada') DEFAULT 'completada',
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ventas_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    CONSTRAINT fk_ventas_cliente FOREIGN KEY (cliente_id) REFERENCES entidades_externas(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS venta_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad DECIMAL(12, 3) NOT NULL,
    precio_compra_momento DECIMAL(12, 2) NOT NULL,
    precio_unitario_venta DECIMAL(12, 2) NOT NULL,
    subtotal_linea DECIMAL(12, 2) AS (cantidad * precio_unitario_venta) STORED,
    CONSTRAINT fk_vd_ventas FOREIGN KEY (venta_id) REFERENCES ventas(id) ON DELETE CASCADE,
    CONSTRAINT fk_vd_prod FOREIGN KEY (producto_id) REFERENCES productos(id)
) ENGINE=InnoDB;

-- =============================================
-- 6. TRAZABILIDAD Y AUDITORÍA
-- =============================================

CREATE TABLE IF NOT EXISTS stock_movimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo_movimiento ENUM('entrada_compra', 'salida_venta', 'devolucion', 'ajuste_inventario') NOT NULL,
    cantidad DECIMAL(12, 3) NOT NULL,
    referencia_id INT, 
    usuario_id INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_stock_prod FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS logs_auditoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT,
    usuario_id INT,
    accion VARCHAR(100) NOT NULL,
    detalles TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_logs_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- =============================================
-- 7. LÓGICA DE NEGOCIO (TRIGGERS)
-- =============================================

DELIMITER //

-- Validación de Stock y captura de costos históricos
CREATE TRIGGER tr_venta_detalles_bi
BEFORE INSERT ON venta_detalles
FOR EACH ROW
BEGIN
    DECLARE v_costo DECIMAL(12,2);
    DECLARE v_stock DECIMAL(12,3);

    SELECT precio_compra_actual, stock_actual INTO v_costo, v_stock
    FROM productos WHERE id = NEW.producto_id FOR UPDATE;

    IF v_stock < NEW.cantidad THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ERROR: Stock insuficiente para la operación.';
    END IF;

    SET NEW.precio_compra_momento = v_costo;
END //

-- Actualización automática de stock y Kardex
CREATE TRIGGER tr_venta_detalles_ai
AFTER INSERT ON venta_detalles
FOR EACH ROW
BEGIN
    UPDATE productos SET stock_actual = stock_actual - NEW.cantidad WHERE id = NEW.producto_id;
    
    INSERT INTO stock_movimientos (producto_id, tipo_movimiento, cantidad, referencia_id)
    VALUES (NEW.producto_id, 'salida_venta', NEW.cantidad, NEW.venta_id);
END //

DELIMITER ;