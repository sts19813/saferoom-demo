<?php

namespace Tests\Feature;

use Tests\TestCase;

class DemoRoutesTest extends TestCase
{
    public function test_operational_screens_render_the_safe_room_demo(): void
    {
        $routes = [
            '/',
            '/solicitudes',
            '/solicitudes/nueva',
            '/cajas',
            '/arrendatarios',
            '/arrendatarios/ficha?tenant=tenant-carlos&contract=contract-0149',
            '/contratos',
            '/renovaciones?contract=contract-0148',
            '/cancelaciones?contract=contract-0141',
            '/accesos',
            '/documentos',
            '/reportes',
            '/finanzas',
            '/configuracion',
            '/usuarios',
        ];

        foreach ($routes as $route) {
            $this->get($route)
                ->assertOk()
                ->assertSee('SafeRoom')
                ->assertSee('DEMO · DATOS FICTICIOS');
        }
    }

    public function test_demo_shell_includes_the_related_state_and_lifecycle_guards(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('saferoom-demo-state')
            ->assertSee('function addMonthsMinusOne')
            ->assertSee('function completeRenewal')
            ->assertSee('function completeCancellation')
            ->assertSee('function registerAccessExit')
            ->assertSee('function exportReport')
            ->assertSee('function grantC4Access')
            ->assertSee('function closeC4Door');
    }
}
