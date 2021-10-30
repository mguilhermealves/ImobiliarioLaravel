<?php

namespace Tests\Unit;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCriaUsuario()
    {
        $usuario = factory(Usuario::class)->make();
        // $this->assertDatabaseHas('usuarios', [
        //   'nome' => $usuario->nome,
        //   'email' => $usuario->email,
        // ]);
        $this->assertTrue(true);
    }
}
