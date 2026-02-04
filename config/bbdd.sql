-- Active: 1769673830758@@127.0.0.1@3306
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
    logo_url VARCHAR(255),
    nombre_comercial VARCHAR(150) NOT NULL,
    nif_cif VARCHAR(20) UNIQUE NOT NULL,
    direccion TEXT,
    telefono VARCHAR(20),
    email_contacto VARCHAR(100),
    web VARCHAR(100),
    cuenta_bancaria VARCHAR(50),
    horario_atencion VARCHAR(255),
    categoria_negocio ENUM('Alimentos', 'Moda', 'Electronica', 'Ferreteria', 'Libros', 'Farmacia', 'Clinica', 'Vehiculos') NOT NULL,
    estado ENUM('activo', 'inactivo', 'suspendido') DEFAULT 'activo',
    eliminado_at TIMESTAMP NULL, -- Soft Delete
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS configuracion_apariencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    color_primario VARCHAR(7) DEFAULT '#3498db',
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
    nombre VARCHAR(50) NOT NULL,
    abreviatura VARCHAR(10) NOT NULL,
    permite_decimales BOOLEAN DEFAULT FALSE,
    eliminado_at TIMESTAMP NULL,
    CONSTRAINT fk_uom_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS impuestos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    porcentaje DECIMAL(5, 2) NOT NULL, -- Ej: 15.00
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
    eliminado_at TIMESTAMP NULL,
    CONSTRAINT fk_cat_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    eliminado_at TIMESTAMP NULL,
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
    stock_actual DECIMAL(12, 3) DEFAULT 0.000,
    stock_minimo DECIMAL(12, 3) DEFAULT 0.000,
    activo BOOLEAN DEFAULT TRUE,
    eliminado_at TIMESTAMP NULL,
    CONSTRAINT fk_prod_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    CONSTRAINT fk_prod_unidad FOREIGN KEY (unidad_id) REFERENCES unidades_medida(id),
    CONSTRAINT fk_prod_cat FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL,
    CONSTRAINT fk_prod_marca FOREIGN KEY (marca_id) REFERENCES marcas(id) ON DELETE SET NULL,
    UNIQUE KEY ux_sku_empresa (empresa_id, sku_interno),
    INDEX (sku_interno)
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
    eliminado_at TIMESTAMP NULL,
    CONSTRAINT fk_usuarios_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    UNIQUE KEY ux_empresa_email (empresa_id, email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS entidades_externas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    tipo ENUM('proveedor', 'cliente') NOT NULL,
    nombre_razon_social VARCHAR(150) NOT NULL,
    identificacion VARCHAR(20), -- NIF, CIF, DNI
    eliminado_at TIMESTAMP NULL,
    CONSTRAINT fk_entidades_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- 5. VENTAS, CAJA Y FACTURACIÓN
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
    folio_venta VARCHAR(20), -- Referencia interna
    total_neto DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    total_impuestos DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    total_general DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    metodo_pago ENUM('efectivo', 'tarjeta', 'transferencia', 'credito') DEFAULT 'efectivo',
    estado ENUM('presupuesto', 'completada', 'anulada') DEFAULT 'presupuesto',
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ventas_empresas FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    CONSTRAINT fk_ventas_cliente FOREIGN KEY (cliente_id) REFERENCES entidades_externas(id) ON DELETE SET NULL,
    INDEX (folio_venta)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS venta_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad DECIMAL(12, 3) NOT NULL,
    precio_compra_momento DECIMAL(12, 2) NOT NULL,
    precio_unitario_venta DECIMAL(12, 2) NOT NULL,
    impuesto_porcentaje_momento DECIMAL(5,2) NOT NULL DEFAULT 0.00, -- Snapshot fiscal
    subtotal_linea DECIMAL(12, 2) AS (cantidad * precio_unitario_venta) STORED,
    CONSTRAINT fk_vd_ventas FOREIGN KEY (venta_id) REFERENCES ventas(id) ON DELETE CASCADE,
    CONSTRAINT fk_vd_prod FOREIGN KEY (producto_id) REFERENCES productos(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    venta_id INT NOT NULL UNIQUE,
    serie VARCHAR(10) DEFAULT 'F',
    correlativo INT NOT NULL,
    numero_factura_formateado VARCHAR(50) AS (CONCAT(serie, '-', LPAD(correlativo, 8, '0'))) STORED,
    fecha_emision TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    pdf_url VARCHAR(255),
    CONSTRAINT fk_factura_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id),
    CONSTRAINT fk_factura_venta FOREIGN KEY (venta_id) REFERENCES ventas(id)
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

-- =============================================
-- 7. LÓGICA DE NEGOCIO (TRIGGERS)
-- =============================================

DELIMITER //

-- 1. Capturar costos e impuestos al insertar detalle
CREATE TRIGGER tr_venta_detalles_bi
BEFORE INSERT ON venta_detalles
FOR EACH ROW
BEGIN
    DECLARE v_costo DECIMAL(12,2);
    DECLARE v_stock DECIMAL(12,3);

    SELECT precio_compra_actual, stock_actual INTO v_costo, v_stock
    FROM productos WHERE id = NEW.producto_id FOR UPDATE;

    SET NEW.precio_compra_momento = v_costo;
END //

-- 2. Actualizar totales de la cabecera automáticamente
CREATE TRIGGER tr_venta_detalles_ai
AFTER INSERT ON venta_detalles
FOR EACH ROW
BEGIN
    -- Recalcular totales en la cabecera
    UPDATE ventas 
    SET total_neto = (SELECT IFNULL(SUM(subtotal_linea), 0) FROM venta_detalles WHERE venta_id = NEW.venta_id),
        total_impuestos = (SELECT IFNULL(SUM(subtotal_linea * (impuesto_porcentaje_momento / 100)), 0) FROM venta_detalles WHERE venta_id = NEW.venta_id),
        total_general = total_neto + total_impuestos
    WHERE id = NEW.venta_id;
END //

-- 3. Descontar stock SOLO cuando la venta se marca como completada
CREATE TRIGGER tr_ventas_bu
BEFORE UPDATE ON ventas
FOR EACH ROW
BEGIN
    -- Si el estado cambia de presupuesto a completada
    IF OLD.estado = 'presupuesto' AND NEW.estado = 'completada' THEN
        -- Insertar movimientos de stock para cada producto de la venta
        INSERT INTO stock_movimientos (producto_id, tipo_movimiento, cantidad, referencia_id, usuario_id)
        SELECT producto_id, 'salida_venta', cantidad, NEW.id, NEW.usuario_id
        FROM venta_detalles WHERE venta_id = NEW.id;

        -- Actualizar el stock actual en productos
        UPDATE productos p
        INNER JOIN venta_detalles vd ON p.id = vd.producto_id
        SET p.stock_actual = p.stock_actual - vd.cantidad
        WHERE vd.venta_id = NEW.id;
    END IF;
END //

DELIMITER ;