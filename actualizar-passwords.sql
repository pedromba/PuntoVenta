-- =====================================================
-- ACTUALIZAR CONTRASEÑAS CON HASH CORRECTO
-- =====================================================
-- Este script actualiza las contraseñas en texto plano
-- por contraseñas hasheadas con bcrypt
-- 
-- Contraseña original: 11223344
-- Hash generado: $2y$10$MQmSDI.W6aqsnhMgrwSZOudHMekCDFKORWDsh6B4.lHbEWA72KPLS
-- =====================================================

USE puntoventa;

-- Actualizar ambos usuarios con la contraseña hasheada
UPDATE usuarios 
SET password_hash = '$2y$10$MQmSDI.W6aqsnhMgrwSZOudHMekCDFKORWDsh6B4.lHbEWA72KPLS' 
WHERE email IN ('pmba098@gmail.com', 'pmba098@outlook.es');

-- Verificar que se actualizaron
SELECT 
    id,
    nombre,
    email,
    LEFT(password_hash, 20) as hash_preview,
    activo
FROM usuarios
WHERE email IN ('pmba098@gmail.com', 'pmba098@outlook.es');

-- Si ves algo como "$2y$10$MQmSDI.W6aqsn..." entonces está correcto ✅
