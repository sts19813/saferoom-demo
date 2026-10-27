# SafeRoom Console UI

Biblioteca Blade reutilizable inspirada en la identidad de **SafeRoom**: superficie cálida, carbón, acento dorado y componentes sobrios para operaciones de seguridad.

Componentes disponibles:

- `x-console.button` — variantes `primary`, `secondary`, `ghost` y `danger`; tamaños `sm`, `md` y `lg`.
- `x-console.card` y `x-console.panel` — contenedores, encabezados y ranura `actions`.
- `x-console.metric` — indicador con etiqueta, valor y tendencia.
- `x-console.badge` — tonos `neutral`, `success`, `warning`, `danger` e `info`.
- `x-console.input`, `x-console.toolbar`, `x-console.progress` y `x-console.empty-state`.

Ejemplo:

```blade
<x-console.panel title="Ocupación" description="Estado actualizado hoy">
    <x-slot:actions><x-console.button size="sm">Ver cajas</x-console.button></x-slot:actions>
    <x-console.progress label="Cajas ocupadas" detail="78%" :value="78" />
</x-console.panel>
```
