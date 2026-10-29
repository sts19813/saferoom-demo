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
            $this->withSession(['demo_user' => 'admin'])->get($route)
                ->assertOk()
                ->assertSee('SafeRoom')
                ->assertSee('DEMO · DATOS FICTICIOS');
        }
    }

    public function test_demo_shell_includes_the_related_state_and_lifecycle_guards(): void
    {
        $response = $this->withSession(['demo_user' => 'admin'])->get('/');

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

    public function test_login_is_public_and_operational_modules_require_a_demo_session(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Cuentas disponibles')
            ->assertSee('Operador C4');

        $this->get('/accesos')
            ->assertRedirect(route('login'));
    }

    public function test_demo_role_permissions_are_enforced_on_direct_urls(): void
    {
        $this->withSession(['demo_user' => 'vault'])->get('/accesos')
            ->assertOk()
            ->assertSee('Sergio Paredes')
            ->assertSee('Encargado de bóveda');

        $this->withSession(['demo_user' => 'vault'])->get('/finanzas')
            ->assertRedirect(route('access.index'));

        $this->withSession(['demo_user' => 'c4'])->get('/accesos')
            ->assertOk()
            ->assertSee('C4 · MONITOREO DE PUERTA')
            ->assertSee('function confirmC4Access')
            ->assertSee('function removeC4Record');

        $this->withSession(['demo_user' => 'finance'])->get('/reportes')
            ->assertOk()
            ->assertSee('Elena Vargas')
            ->assertSee('CURRENT_PERMISSIONS');
    }

    public function test_a_demo_account_can_start_a_session_with_its_credentials(): void
    {
        $this->post('/login', [
            'email' => 'c4@saferoom.demo',
            'password' => 'C4Seguro2026!',
        ])
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('demo_user', 'c4');
    }
}
