# Adaptación del Módulo Admin a Estructura de Base de Datos

## Estado de Adaptación

### ✅ COMPLETADO

#### 1. **usuarios.php**
- **Campos del formulario ajustados:**
  - `nombre` (not null)
  - `email` (not null)
  - `password` / `password_confirm` (becomes password_hash)
  - `empresa_id` (FK a empresas)
  - `rol` (ENUM: superadmin, admin, finanzas, almacen, vendedor)
  - `activo` (boolean)

- **Tabla actualizada:**
  - Columnas: Nombre, Email, Empresa, Rol, Estado, Acciones
  - Eliminada columna: "Último Acceso" (no existe en BD)
  - Badges de rol mapeados correctamente: superadmin (rojo), finanzas (azul), almacén (amarillo)

#### 2. **empresas.php**
- **Campos del formulario ajustados:**
  - `nombre_comercial` (not null)
  - `nif_cif` (not null, unique)
  - `email_contacto` (not null)
  - `telefono`
  - `direccion`
  - `web` (URL)
  - `categoria_negocio` (ENUM: Alimentos, Moda, Electronica, Ferreteria, Libros, Farmacia, Clinica, Vehiculos)
  - `horario_atencion`
  - `cuenta_bancaria`
  - `logo_url`
  - `estado` (ENUM: activo, inactivo, suspendido)

- **Nota:** Grid de tarjetas es apropiado para visualizar empresas

#### 3. **Rutas/Paths**
- ✅ Todas las rutas a `../recursos` (bootstrap.min.css, bootstrap.bundle.min.js) correctas
- ✅ Todas las rutas a `./componentes/aside.php` correctas (relativas)
- ✅ Todas las rutas a `./recursos` para CSS y JS locales correctas

### 🔄 POR VERIFICAR/AJUSTAR

#### 4. **categoria.php**
- **Estructura actual:** Tabla + Grid con view toggle
- **Campos de BD esperados:**
  - `id`
  - `empresa_id` (FK)
  - `nombre` (not null)
  - `eliminado_at` (soft delete)
- **Acciones necesarias:**
  - Verificar que formulario tenga solo campo `nombre`
  - No incluir campo `categoria_padre_id` (no existe en BD)
  - Mostrar `eliminado_at` en tabla (para visibilidad de registros softdeleted)

#### 5. **marcas.php**
- **Estructura esperada:** Similar a categorias
- **Campos de BD:**
  - `id`
  - `empresa_id` (FK)
  - `nombre` (not null)
  - `eliminado_at`
- **Acciones:** Revisar que no tenga campos adicionales

#### 6. **productos.php** ⚠️ PRIORITARIO
- **Campos de BD esperados:**
  - `sku_interno` (unique per empresa) - CRÍTICO
  - `nombre`
  - `unidad_id` (FK a unidades_medida)
  - `categoria_id` (FK a categorias)
  - `marca_id` (FK a marcas)
  - `precio_compra_actual` (decimal)
  - `precio_venta_estandar` (decimal)
  - `stock_actual` (decimal - permite decimales según unidad)
  - `stock_minimo` (decimal)
  - `activo` (boolean)
  - `eliminado_at`
- **Acciones necesarias:**
  - Tabla: Mostrar SKU, Nombre, Categoría, Marca, Stock Actual, Stock Mínimo, Precio Venta, Estado, Acciones
  - Formulario: Incluir campos unidad_id (select), categoria_id (select), marca_id (select)
  - Badge: Mostrar estado de stock (bajo si stock_actual < stock_minimo)

#### 7. **impuestos.php**
- **Campos de BD esperados:**
  - `id`
  - `empresa_id` (FK)
  - `nombre` (not null) - Ej: "IVA 21%"
  - `porcentaje` (decimal 5,2) - Ej: 21.00
  - `activo` (boolean)
- **Acciones necesarias:**
  - Tabla: Mostrar Nombre, Porcentaje (%), Estado, Acciones
  - Formulario: campos `nombre`, `porcentaje`, `activo`

#### 8. **Otros módulos** (requieren verificación):
- `stock.php` - Tabla stock_movimientos
- `cajas.php` - Tabla cajas (abierta/cerrada con arqueo)
- `facturas.php` - Tabla facturas
- `ventas.php` - Admin view de tabla ventas
- `configuracion.php` - Configuraciones del sistema

### Campos Comunes a Todos (Soft Delete Pattern)
```
- eliminado_at TIMESTAMP NULL
```

Cuando `eliminado_at IS NULL` = registros activos
Cuando `eliminado_at IS NOT NULL` = registros eliminados (soft delete)

**En tablas/grids:** Opcionalmente mostrar badge "Eliminado" para registros con `eliminado_at` no null

### Ejemplo de Tabla Completa (Referencia: usuarios.php)
```html
<table class="table table-hover table-modern">
    <thead>
        <tr>
            <th><input type="checkbox" class="form-check-input"></th>
            <th>Información Principal</th>
            <th>Relación/Clasificación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
</table>
```

### Pattern de Badges por Tipo
- **Rol (usuarios):** superadmin (bg-danger), admin (bg-dark), finanzas (bg-info), almacen (bg-warning), vendedor (bg-secondary)
- **Estado Empresa:** activo (bg-success), inactivo (bg-secondary), suspendido (bg-danger)
- **Stock:** bajo (bg-warning), normal (bg-success)

### Próximos Pasos
1. Verificar y ajustar categoria.php, marcas.php
2. Profundizar en productos.php (campo SK es crítico)
3. Revisar impuestos.php
4. Validar otros módulos
5. Crear documentación HTML de campos por módulo
