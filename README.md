# SafeRoom · demo operativa

Demo Laravel + Blade para presentar una versión web moderna de SafeRoom. Representa la operación de cajas físicas, arrendatarios, contratos, finanzas, documentos y accesos con datos ficticios guardados localmente en el navegador.

## Abrir la demo

Requisitos: PHP 8.5+, Composer y Node.js.

```bash
composer install
npm install
php artisan serve
```

Abre la URL indicada por Laravel, normalmente `http://127.0.0.1:8000`.

## Recorrido recomendado para presentar

1. En **Inicio**, explica ocupación, vencimientos y actividad calculados desde la demo.
2. Abre **Solicitudes** y crea una solicitud; selecciona una caja disponible.
3. Continúa a **Generar contrato**, revisa renta, IVA estimado y garantía, y confirma.
4. Consulta la **Ficha del arrendatario**: contratos, caja, facturas, documentos y accesos están relacionados.
5. Desde **Contratos**, abre un registro y demuéstralo en **Renovaciones** conservando caja o cambiándola por una disponible.
6. En **Accesos**, usa el perfil **Encargado de bóveda** para validar una entrada y registrar salida/firma; el perfil **Operador C4** solo concede el acceso físico y cierra la puerta.
7. En **Reportes**, filtra un periodo y descarga el CSV correspondiente.
8. Usa **Restablecer datos de demo** en el menú lateral para volver al escenario inicial.

## Estado y reinicio

La demo usa `localStorage` con versión de esquema. Al recargar, conserva registros, selección y operaciones de la sesión. Si el estado almacenado es inválido o pertenece a otra versión, se recupera el escenario inicial. Restablecer solicita confirmación y elimina los datos locales de SafeRoom.

## Límites de la demostración

No existe autenticación, base de datos, timbrado CFDI, pagos, conciliación, firma legal, almacenamiento de expedientes, biometría, control de cerraduras, ni conexión con Kommo. Las reglas fiscales y comerciales son visualizaciones de ejemplo. Consulta [docs/alcance-demo.md](docs/alcance-demo.md) y [docs/plan-evolucion-demo.md](docs/plan-evolucion-demo.md) para evidencia, supuestos y pendientes.

## Verificación

```bash
php artisan test
php artisan view:cache
```
