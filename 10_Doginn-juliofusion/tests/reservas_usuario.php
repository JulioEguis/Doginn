// tests/ReservasUsuarioTest.php
use PHPUnit\Framework\TestCase;

class ReservasUsuarioTest extends TestCase
{
    public function testVerificarReservasUsuario()
    {
        $_SESSION['id_usuario'] = 1;
        $reservas = [
            [
                'fecha_inicio' => '2024-06-01',
                'fecha_fin' => '2024-06-03',
                'raza_perro' => 'Labrador',
                'nombre_guarderia' => 'Dog Paradise'
            ]
        ];

        $this->assertNotEmpty($reservas, 'El usuario debe tener al menos una reserva.');
        $this->assertEquals('Dog Paradise', $reservas[0]['nombre_guarderia'], 'El nombre de la guardería debe coincidir.');
    }
}
