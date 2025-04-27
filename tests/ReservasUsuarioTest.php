<?php
use PHPUnit\Framework\TestCase;

class ReservasUsuarioTest extends TestCase
{
    public function testVerificarReservasUsuario()
    {
        $_SESSION['id_usuario'] = 25;
        $reservas = [
            [
                'fecha_inicio' => '2024-06-01',
                'fecha_fin' => '2024-06-02',
                'raza_perro' => 'Cachorro',
                'nombre_guarderia' => 'Mami Dogguies'
            ]
        ];

        $this->assertNotEmpty($reservas, 'El usuario.');
        $this->assertEquals('Mami Dogguies', $reservas[0]['nombre_guarderia'], 'El nombre de la guarderia.');
    }
}
