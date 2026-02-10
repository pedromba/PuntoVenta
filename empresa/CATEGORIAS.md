# Gestión de Categorías de Productos - Por Empresa

## 📋 Nueva Funcionalidad: Categorías de Productos

### Descripción
Cada empresa puede gestionar sus propias categorías de productos para una mejor organización del catálogo.

### Ubicación
```
/empresa/categorias.php
```

### Acceso desde Navegación
```
Sidebar → Gestión → Categorías
```

## 🗄️ Estructura de BD

### Tabla: `categorias_producto`
```sql
CREATE TABLE IF NOT EXISTS categorias_producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    eliminado_at TIMESTAMP NULL,
    CONSTRAINT fk_cat_prod_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

**Campos importantes:**
- `id`: Identificador único (auto-incremento)
- `empresa_id`: FK a la empresa actual (sesión)
- `nombre`: Nombre de la categoría (requerido)
- `eliminado_at`: Soft delete (auditoría)

## 🎨 Componentes de la Interfaz

### 1. Encabezado
- Título: "Categorías de Productos"
- Subtítulo: "Organiza tus productos por categorías"
- Botón principal: "Nueva Categoría"

### 2. Estadísticas (Tarjetas)
- **Total Categorías**: Cantidad total de categorías
- **Categorías Activas**: Cantidad activas (solo con activo=1)
- **Productos Asociados**: Suma total de productos en todas las categorías

### 3. Filtros
- **Estado**: Dropdown para filtrar activas/inactivas/todas
- **Búsqueda**: Input para buscar por nombre de categoría
- **Limpiar Filtros**: Botón para resetear filtros

### 4. Tabla de Categorías

#### Columnas:
1. **Nombre Categoría**
   - Icono visual (Font Awesome)
   - Nombre de categoría
   - ID interno
   
2. **Productos**
   - Badge con cantidad de productos

3. **Estado**
   - Badge activa (verde) / inactiva (rojo)

4. **Fecha Creación**
   - Fecha de creación de la categoría

5. **Acciones**
   - Botón Editar (lápiz)
   - Botón Eliminar (papelera)

### 5. Modal: Crear/Editar Categoría

#### Campos:
- **Nombre de la Categoría** (requerido, VARCHAR 100)
- **Estado** (Activa/Inactiva)

#### Botones:
- Cancelar
- Guardar Categoría / Actualizar Categoría

## 💾 Operaciones CRUD

### CREATE - Nueva Categoría
```
Usuario hace click en "Nueva Categoría"
    ↓
Modal abre con:
  - Título: "Nueva Categoría"
  - Botón: "Guardar Categoría"
    ↓
Completa formulario:
  - nombre (validación: no vacío, máx 100 caracteres)
  - activo (default: 1)
    ↓
Backend valida y crea:
  INSERT INTO categorias_producto {
    empresa_id: $_SESSION['empresa_id'],
    nombre: $nombre,
    eliminado_at: NULL
  }
```

### READ - Listar Categorías
```
GET /api/categorias/listar (si existe)
    ↓
Filtrado por empresa_id de sesión
    ↓
Puede incluir:
  - Filtro por estado (activo=1/0)
  - Búsqueda por nombre
  - Paginación opcional
```

### UPDATE - Editar Categoría
```
Usuario hace click en botón "Editar"
    ↓
Modal abre con datos precargados:
  - Título: "Editar Categoría"
  - Botón: "Actualizar Categoría"
  - Campos rellenados con datos actuales
    ↓
Modifica nombre y/o estado
    ↓
Backend valida:
  - Categoría pertenece a su empresa
  - Nombre no duplicado en la empresa
    ↓
UPDATE categorias_producto SET
    nombre = $nombre,
    activo = $activo
WHERE id = $category_id AND empresa_id = $_SESSION['empresa_id']
```

### DELETE - Eliminar Categoría
```
Usuario hace click en botón "Eliminar"
    ↓
Confirma con SweetAlert2:
  - Titulo: "¿Eliminar categoría?"
  - Texto: "Esta acción no se puede deshacer"
  - Botones: "Sí, eliminar" / "Cancelar"
    ↓
Backend ejecuta SOFT DELETE:
  UPDATE categorias_producto SET
      eliminado_at = NOW()
  WHERE id = $category_id AND empresa_id = $_SESSION['empresa_id']
    ↓
Nota: Los productos NO se eliminan, pierden la categoría
```

## 🔒 Consideraciones de Seguridad

1. **empresa_id**: SIEMPRE desde sesión (`$_SESSION['empresa_id']`), NUNCA del formulario
2. **Validación Frontend**: Bootstrap validation con novalidate
3. **Validación Backend**: 
   - Validar que categoría pertenece a la empresa actual
   - Email duplicate check (si aplica)
4. **Soft Delete**: Campo `eliminado_at` para auditoría (no borrado físico)
5. **Permiso**: Solo usuarios 'admin' de la empresa pueden gestionar categorías

## 🔗 Relación con Otros Módulos

### Productos
- Los productos tienen `categoria_id` FK a `categorias_producto`
- Cuando se edita un producto, muestra las categorías de su empresa
- Si una categoría se elimina (soft delete), los productos mantienen referencia pero categoría aparece como "Eliminada"

### Tabla productos
```sql
CREATE TABLE IF NOT EXISTS productos (
    ...
    categoria_id INT NOT NULL,
    ...
    CONSTRAINT fk_prod_cat FOREIGN KEY (categoria_id) REFERENCES categorias_producto(id),
)
```

## 📊 Datos de Ejemplo en Tabla

| ID | nombre | empresa_id | Productos | Estado | Fecha |
|----|--------|-----------|-----------|--------|-------|
| 1 | Laptops | 1 | 12 | Activa | 15/02/2025 |
| 2 | Móviles | 1 | 8 | Activa | 15/02/2025 |
| 3 | Accesorios | 1 | 5 | Activa | 15/02/2025 |
| 4 | Tablets | 1 | 3 | Activa | 15/02/2025 |
| 5 | Wearables | 1 | 0 | Inactiva | 10/02/2025 |

## 🎯 Flujo de Usuario

```
1. Admin entra a empresa/categorias.php
    ↓
2. Ve tabla con categorías actuales
    ↓
3. Opciones:
   a) Crear nueva → Click "Nueva Categoría" → Modal
   b) Editar → Click icono editar → Modal precargado
   c) Eliminar → Click icono eliminar → Confirmación
   d) Filtrar → Usar dropdown estado/búsqueda
    ↓
4. Después de acción → Tabla se actualiza
```

## 📁 Archivos Creados/Modificados

### Creados:
- ✅ `empresa/categorias.php` - Interfaz principal
- ✅ `empresa/recursos/css/categorias.css` - Estilos específicos

### Modificados:
- ✅ `empresa/componentes/aside.php` - Agregado enlace en navegación

## 🎨 Estilos CSS

### Clases principales:
- `.categories-table` - Tabla principal
- `.category-cell` - Celda con icono y nombre
- `.category-icon` - Icono de categoría (circulo con gradiente)
- `.status-badge` - Badge de estado (verde/rojo)
- `.stat-card` - Tarjeta de estadística
- `.action-buttons` - Botones de acción en fila

### Responsive:
- En tablet (768px): Menos columnas visibles
- En móvil (480px): Solo muestra nombre, estado y acciones

## ✅ Checklist Backend Implementation

### Endpoints requeridos:
- [ ] POST `/api/categorias/crear` - Crear categoría
- [ ] GET `/api/categorias/listar` - Listar por empresa (con filtros)
- [ ] POST `/api/categorias/editar/{id}` - Editar categoría
- [ ] DELETE `/api/categorias/{id}` - Soft delete categoría

### Validaciones Backend:
- [ ] Validar empresa_id desde sesión
- [ ] Nombre no vacío (1-100 caracteres)
- [ ] Validar que categoría pertenece a la empresa
- [ ] Soft delete (no borrado físico)
- [ ] Validar permisos (solo admin)

### Funcionalidad:
- [ ] Contar productos por categoría automáticamente
- [ ] Generar estadísticas de categorías activas
- [ ] Búsqueda y filtrado funcional
- [ ] Enviar respuestas JSON estructuradas

---
**Versión:** 1.0
**Fecha:** 10 de Febrero de 2026
**Estado:** Interfaces completadas, **Awaiting Backend Implementation**
