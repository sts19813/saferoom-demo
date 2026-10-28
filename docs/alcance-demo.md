# Alcance vigente de la demo SafeRoom

## Qué representa

SafeRoom es una demostración local de una modernización web del sistema operativo mostrado en la grabación de referencia. Usa Laravel + Blade, rutas reales y datos ficticios guardados únicamente en el navegador. No usa base de datos, autenticación, archivos reales ni servicios externos.

## Capacidades mostradas

- Solicitudes de arrendamiento con datos generales, domicilio, fiscal, referencia y autorizado.
- Cajas físicas por tamaño, ubicación, estado, cerradura y dos llaves.
- Arrendatarios, autorizados, contratos, renovación, cambio de caja y cancelación.
- Facturas, garantía, otros ingresos y devolución propuesta de garantía como simulaciones.
- Documentos, reportes CSV, accesos de entrada/salida/rechazo, perfiles y auditoría local. El encargado de bóveda valida y registra firmas; el Operador C4 solo simula abrir/cerrar la puerta.

## Evidencia visual y límites

Las pantallas se basan en la revisión visual de `SafeRoom - ERP - 20261013 1052 CST - Recording.mp4`: solicitudes (4–8 min), catálogos y contratos (10–24 min), renovaciones/cambios (26–34 min), cancelaciones (34 min), reportes (36–42 y 72 min), usuarios (52 min), otros ingresos (54 min), configuración (60 min), accesos (64–68 min) y Kommo manual (76–80 min).

No se trata el audio como confirmación de reglas de negocio. IVA, depósitos, devoluciones, vigencias, acceso, facturación, biometría, archivos, roles, auditoría y conservación de información son comportamientos de demostración o decisiones pendientes de validación.

## Supuestos explícitos

- Una caja es un espacio físico para guardar pertenencias y valores; tiene dos llaves.
- Los importes se guardan en centavos en el estado local de la demo. El IVA del 16% solo permite visualizar una factura de ejemplo; no se presenta como regla fiscal validada ni se timbra un CFDI.
- Al cancelar, la devolución de garantía aparece como movimiento independiente y simulado, no como pago o conciliación real.
- Kommo se usa manualmente y no está conectado a SafeRoom.
- La biometría y el hardware de acceso no se conectan ni capturan datos.

## Pendiente antes de producción

Persistencia en servidor, usuarios/roles reales, permisos, auditoría inmutable, reglas comerciales/fiscales confirmadas, documentos firmables, integraciones de pago/CFDI, gestión segura de expediente, biometría/cerraduras, reportes contables y comunicación externa.

El plan de construcción y los criterios de salida por fase están en [plan-evolucion-demo.md](plan-evolucion-demo.md).
