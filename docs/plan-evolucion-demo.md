# Plan de evolución de la demo SafeRoom

## Base de análisis

Este plan combina la revisión visual de la grabación `SafeRoom - ERP - 20261013 1052 CST - Recording.mp4` (95 min aprox.) con las prioridades de presentación solicitadas. No hay transcripción verificable del audio; por lo tanto, los campos y módulos visibles se toman como evidencia de interfaz, pero las reglas de negocio siguen siendo hipótesis hasta validarlas con operación.

Hallazgos visuales que guían la demo: solicitud con datos generales, referencias, empresa, factura, expediente y autorización (4–8 min); catálogos de arrendatarios/cajas/contratos (10–24 min); renovación y cambio de caja (26–34 min); cancelación y devolución de llaves/depósito (34 min); reportes (36–42 y 72 min); usuarios/permisos (52 min); otros ingresos (54 min); configuración (60 min); accesos (64–68 min); y uso manual, no sincronizado, de Kommo (76–80 min).

## Principios de la iteración

- Mantener Laravel + Blade, rutas existentes, logotipo e identidad actual.
- Usar únicamente información ficticia, coherente y persistida en el navegador; no hay timbrado, CFDI, biometría, cerraduras ni servicios externos reales.
- Modelar relaciones por identificadores, no por nombres o una variable global de arrendatario.
- Conservar una selección explícita en URL y almacenamiento local, para que cada pantalla abra el registro correcto tras recargar.
- Mostrar de forma permanente y discreta `Demo · datos ficticios`; distinguir simulación fiscal y biométrica sin repetir avisos largos.
- Escapar las entradas antes de mostrarlas y evitar interpolarlas como HTML.

## Fase 7 — Fundamento de datos y recorridos (prioridad actual)

1. Definir estado local versionado: arrendatarios, autorizados, solicitudes, cajas, contratos, historial, facturas/movimientos, documentos y accesos.
2. Agregar recuperación segura de `localStorage`, guardado centralizado y restablecimiento con confirmación.
3. Sustituir el registro activo único por `selectedTenantId`, `selectedContractId` y `selectedRequestId`; pasar esas selecciones en la URL.
4. Volver dinámicos solicitudes, arrendatarios y contratos; enlazar cada acción al registro seleccionado.
5. Corregir el alta y edición de solicitudes, la asignación de caja y la generación idempotente de contrato/factura/documentos.

**Criterios de salida:** dos arrendatarios pueden coexistir, cada ficha conserva sus propios datos y una recarga conserva el recorrido actual.

## Fase 8 — Ciclo de contrato y finanzas simuladas

1. Renovar conservando la misma caja sin bloquear el flujo; permitir cambio únicamente a otra caja disponible y revalidarla al confirmar.
2. Guardar cada operación en historial y calcular fecha final real, incluidos meses cortos y finales de mes.
3. Cancelar por folio seleccionado, liberar únicamente su caja y crear un movimiento separado de devolución de garantía bajo un supuesto explícito de demostración.
4. Impedir renovar/cancelar contratos ya cancelados.
5. Calcular tablero, ocupación, vencimientos, facturas, garantía, IVA y otros ingresos desde las mismas colecciones, con importes en centavos.

**Criterios de salida:** se puede renovar un contrato, cambiar otro de caja y cancelar uno tercero sin mezclar datos ni estados.

## Fase 9 — Ficha, documentos, accesos y reportes — realizada en la demo

1. Completar la ficha por pestañas con contratos, caja, facturas, documentos y eventos de acceso relacionados.
2. Generar vistas previas imprimibles de contrato, entrega de llaves, depósito y factura con folio, datos, importes, logo y firmas de demostración.
3. Validar entradas/salidas/rechazos contra titular/autorizados, caja y contrato vigente del estado local.
4. Hacer que filtros de fecha y selección modifiquen realmente los reportes y exportar los mismos resultados en CSV.
5. Conectar configuración/alertas y formularios locales de nueva factura/nuevo usuario cuando esas acciones se muestren.

**Criterios de salida:** los eventos aparecen en ficha y reporte; la descarga CSV coincide con la vista previa.

Implementado también en esta fase: previsualizaciones imprimibles de los formatos operativos, alta local de facturas y usuarios, y ajustes de alerta que se reflejan en el tablero. Todos siguen identificados como simulación; no producen documentos legales, CFDI, cobros ni credenciales.

Compatibilidad corregida: la plantilla Blade interpreta el operador JavaScript de propagación (`...`) de forma no compatible al renderizar el script inline. La demo usa equivalentes con `Object.assign`, `Array.from` y `concat` hasta extraer el código a Vite en la fase 10.

## Fase 10 — Pulido, accesibilidad y mantenimiento

1. Extraer progresivamente JavaScript, estilos y fragmentos Blade desde `demo.blade.php` hacia Vite y componentes existentes.
2. Revisar escritorio, tablet, móvil y modo oscuro; estados vacíos, errores, foco y cierre de diálogos con Escape.
3. Añadir pruebas de rutas y pruebas de regresión para los recorridos con mayor riesgo; documentar cómo ejecutar y presentar la demo.
4. Revisar con responsables las reglas no confirmadas: vigencia/adeudos para acceso, depósitos, prorrateos, impuestos, expedientes, biometría, roles y auditoría.

## Supuestos de demostración pendientes de confirmar

- Cada caja física tiene cerradura y dos llaves; el tamaño y la asignación sí son capacidades mostradas.
- Renta, garantía e IVA son ejemplos visuales. No constituyen reglas fiscales/comerciales confirmadas.
- Una devolución de garantía se representará como movimiento separado, no como CFDI, conciliación ni pago real.
- Kommo es una herramienta de operación manual externa y no tendrá sincronización.
- Los criterios definitivos para acceso, morosidad, descuentos, notificaciones, auditoría y archivos siguen abiertos.
