# 🔐 Sistema de URLs con Slug de Empresa

## 📋 Descripción

Sistema de URLs amigables que permite que cada empresa tenga una URL única basada en su nombre comercial. Cuando una empresa inicia sesión, su nombre aparece en la URL para mayor claridad y profesionalismo.

**Ejemplo:**
```
https://mi-dominio.com/PuntoVenta/empresa/techstore/dashboard
https://mi-dominio.com/PuntoVenta/empresa/mi-empresa-sl/productos
https://mi-dominio.com/PuntoVenta/empresa/tienda-online/ventas
```

---

## 🔧 Componentes

### 1. **Generador de Slugs** (`config/slug.php`)
- Convierte nombres comerciales a slugs URL-safe
- Ej: "Mi Empresa, S.L." → `mi-empresa-sl`
- Maneja tildes y caracteres especiales
- Incluye funciones para:
  - `generateSlug($nombre)` - Generar slug desde texto
  - `getSlugById($empresa_id)` - Obtener slug desde BD
  - `getIdBySlug($slug)` - Obtener ID desde slug
  - `getEmpresaBySlug($slug)` - Obtener datos completos

### 2. **Procesamiento de Login** (`config/process_login.php`)
- Valida credenciales de usuario
- Detecta si es login de empresa o administrador
- Crea sesión con datos de empresa
- **Guarda el slug en `$_SESSION['empresa_slug']`**
- Retorna JSON con URL de redirección correcta
- Ejemplo de respuesta exitosa:
  ```json
  {
    "success": true,
    "message": "Bienvenido Juan",
    "redirect": "/PuntoVenta/empresa/techstore/dashboard",
    "empresa": "TechStore Ltda"
  }
  ```

### 3. **URL Rewriting** (`.htaccess`)
- Reescribe URLs para que se vean amigables
- Internamente mapea a archivos PHP reales
- **URL pública:** `/empresa/techstore/dashboard`
- **Archivo real:** `/empresa/dashboard.php?slug=techstore`
- El parámetro `slug` se pasa a través de `$_GET['slug']`

### 4. **Inicializador de Sesión** (`empresa/init.php`)
- **DEBE incluirse al inicio de cada página de empresa**
- Verifica que haya sesión activa
- Valida que el slug en la URL coincida con el slug de la sesión
- Proporciona funciones helper:
  - `urlEmpresa($pagina)` - Genera URLs internas correctas
  - `logoutEmpresa()` - Logout seguro
- Variables disponibles globalmente:
  - `$empresa_id` - ID de la empresa autenticada
  - `$empresa_nombre` - Nombre comercial
  - `$empresa_slug` - Slug de la URL
  - `$usuario_nombre` - Nombre del usuario
  - `$usuario_email` - Email del usuario

### 5. **Logout** (`config/process_logout.php`)
- Destruye la sesión completamente
- Limpia cookies de sesión
- Responde con JSON

### 6. **Frontend Login** (`recursos/js/login.js`)
- Maneja formulario de login con AJAX
- Envía POST a `process_login.php`
- Procesa respuesta JSON
- Redirige a la URL con slug correcta
- Muestra notificaciones de éxito/error

---

## 🚀 Uso

### Para Usuarios (Login)

1. Usuario ingresa en `index.php`
2. Selecciona "Empresa" como tipo de acceso
3. Ingresa email y contraseña
4. Click en "Acceder"
5. JavaScript envía solicitud AJAX
6. Servidor autentica y devuelve JSON con URL
7. Redirige automáticamente a: `/empresa/[slug]/dashboard`

### Para Desarrolladores

**En cada archivo de empresa (dashboard.php, ventas.php, etc.), iniciar con:**

```php
<?php 
// IMPORTANTE: Incluir al inicio del archivo
include './init.php'; 
?>
<!DOCTYPE html>
...
<?php echo htmlspecialchars($empresa_nombre); ?> <!-- ✅ Disponible -->
...
<?php echo htmlspecialchars($usuario_nombre); ?> <!-- ✅ Disponible -->
...
<a href="<?php echo urlEmpresa('productos'); ?>">Productos</a> <!-- ✅ URLs correctas -->
...
```

**Para función logout:**
```html
<a href="javascript:logout();">Cerrar Sesión</a>
```

---

## 🔐 Seguridad

### Implementado:
- ✅ Sessions regeneradas tras login (previene session fixation)
- ✅ Validación de slug en cada página (previene URL tampering)
- ✅ Passwords hasheadas con `password_hash()` y `password_verify()`
- ✅ Prepared statements para prevenir SQL injection
- ✅ CORS headers en responses JSON
- ✅ Soft-delete pattern (nunca borrar registros)
- ✅ Multi-tenant isolation (cada empresa solo ve sus datos)

### Verificaciones Realizadas:
```php
// En init.php se verifica que:
if (!isset($_SESSION['empresa_id']) || $_SESSION['rol'] !== 'empresa') {
    // Redirigir al login si no autenticado
}

if ($slug_url !== $slug_sesion) {
    // Redirigir a URL correcta si slug no coincide
}
```

---

## 📝 Checklist de Implementación

- ✅ `config/slug.php` - Generador de slugs
- ✅ `config/process_login.php` - Autenticación AJAX
- ✅ `config/process_logout.php` - Logout
- ✅ `.htaccess` - URL rewriting
- ✅ `empresa/init.php` - Inicializador con helpers
- ✅ `index.php` - Login con selector de rol
- ✅ `recursos/js/login.js` - AJAX login
- ✅ `recursos/css/estilosLogin.css` - Estilos rol selector
- ✅ `empresa/dashboard.php` - Ejemplo integrado

### Por integrar en otros archivos:
```
empresa/dashboard.php        ✅ DONE
empresa/ventas.php          ⏳ PENDIENTE
empresa/productos.php       ⏳ PENDIENTE
empresa/facturas.php        ⏳ PENDIENTE
empresa/cajas.php           ⏳ PENDIENTE
empresa/clientes.php        ⏳ PENDIENTE
empresa/stock.php           ⏳ PENDIENTE
empresa/reportes.php        ⏳ PENDIENTE
empresa/configuracion.php   ⏳ PENDIENTE
```

**Para cada archivo pendiente, agregar al inicio:**
```php
<?php include './init.php'; ?>
```

**Y actualizar:**
- `<title>` con nombre de empresa
- Referencias a usuario autenticado
- URLs internas con `urlEmpresa()`

---

## 🐛 Troubleshooting

### "Empty slug in URL error"
- Verificar que `.htaccess` está en la carpeta raíz de PuntoVenta
- Verificar que `mod_rewrite` está habilitado en Apache
- Verificar que las carpetas tienen `.htaccess` permitido

### "Sesión expirada - redirigir a login"
- Verificar que `session.cookie_httponly` está activo en php.ini
- Verificar que no hay errores en `process_login.php` (revisar logs)

### "Slug no coincide con sesión"
- Verificar que la URL tiene el slug correcto
- `init.php` redirige automáticamente si hay discrepancia
- Verificar que `empresa_slug` está en sesión

### URLs no se reescriben (404)
1. Verificar que `.htaccess` existe en raíz
2. Ejecutar: `php -S localhost:8000` desde raíz para desarrollo
3. Verificar permisos del archivo `.htaccess`
4. En producción, verificar configuración Apache

---

## 📊 Flujo de Autenticación

```
┌─────────────────────────────────────────────────────┐
│ 1. Usuario llega a index.php                        │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 2. Completa formulario de login                     │
│    - Email                                          │
│    - Password                                       │
│    - Rol (Empresa/Admin) [NUEVO]                    │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 3. JavaScript AJAX submit (login.js)                │
│    - preventDefault()                               │
│    - fetch('config/process_login.php')              │
│    - POST: email, password, rol                     │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 4. process_login.php                                │
│    - Valida credenciales en BD                      │
│    - Obtiene empresa_id                             │
│    - Genera slug: SlugManager::generateSlug()       │
│    - Crea sesión con keys:                          │
│      * user_id, user_name, user_email               │
│      * empresa_id, empresa_nombre                   │
│      * empresa_slug [NUEVO]                         │
│    - Retorna JSON con redirect URL                  │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 5. JavaScript recibe JSON exitoso                   │
│    - URL: /empresa/[empresa_slug]/dashboard         │
│    - Redirige automáticamente (window.location.href)│
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 6. .htaccess reescribe la URL                       │
│    De: /empresa/techstore/dashboard                 │
│    A:  /empresa/dashboard.php?slug=techstore        │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 7. dashboard.php está ubicado                       │
│    - include './init.php'                           │
│    - init.php valida:                               │
│      * Sesión activa ✅                             │
│      * Slug en URL = Slug en sesión ✅              │
│    - Variables globales disponibles:                │
│      * $empresa_nombre, $usuario_nombre, etc       │
│    - Página renderiza correctamente ✅              │
└────────────────────┬────────────────────────────────┘
                     │
┌────────────────────▼────────────────────────────────┐
│ 8. Usuario ve: "Dashboard - TechStore"              │
│    Hola Juan Pérez                                  │
│    URL: https://domain.com/empresa/techstore/...    │
└─────────────────────────────────────────────────────┘
```

---

## 🎯 Beneficios

1. **URLs Profesionales** - `empresa/techstore/dashboard` es más legible
2. **Multi-tenant Claro** - Cada empresa tiene su "subdomain-like" URL
3. **SEO Friendly** - Slugs son keywords (aunque no es índexable)
4. **UX Mejorado** - El usuario sabe qué empresa está usando
5. **Seguridad** - Validación en cada página previene tampering
6. **Escalable** - Fácil agregar más empresas sin cambios de código

---

## 📞 Soporte

Para problemas con el sistema de slugs:
1. Revisar logs en `error_log`
2. Verificar que `mod_rewrite` está activo: `apache2ctl -M | grep rewrite`
3. Verificar sesiones en `php.ini`
4. Revisar consola JavaScript para errores AJAX
