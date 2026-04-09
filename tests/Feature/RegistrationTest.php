<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_with_jakarta_pusat()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'city' => 'Jakarta Pusat',
            'address_detail' => 'Jl. Cikini Raya No. 73, RT 01/RW 02, Kel. Cikini, Kec. Menteng, Jakarta Pusat',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Register berhasil, silakan login!');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
    }

    /** @test */
    public function user_can_register_with_jakarta_utara()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'city' => 'Jakarta Utara',
            'address_detail' => 'Jl. Pluit Karang Ayu No. 1, RT 01/RW 02, Kel. Pluit, Kec. Penjaringan, Jakarta Utara',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Register berhasil, silakan login!');
        $this->assertDatabaseHas('users', [
            'email' => 'test2@example.com',
            'name' => 'Test User',
        ]);
    }

    /** @test */
    public function user_cannot_register_with_non_jakarta_city()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'city' => 'Bandung',
            'address_detail' => 'Jl. Sudirman No. 123, Bandung',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['city' => 'Maaf, registrasi hanya diperbolehkan untuk pengguna yang berlokasi di wilayah Jakarta (Jakarta Pusat, Jakarta Utara, Jakarta Timur, Jakarta Selatan, Jakarta Barat). Lokasi perpustakaan kami berada di Jakarta Pusat.']);
        $this->assertDatabaseMissing('users', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function user_cannot_register_when_address_detail_is_not_matching_jakarta_location()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'invalid-address@example.com',
            'city' => 'Jakarta Timur',
            'address_detail' => 'Wanaherang',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['address_detail' => 'Maaf, lokasi Anda tidak sesuai.']);
        $this->assertDatabaseMissing('users', [
            'email' => 'invalid-address@example.com',
        ]);
    }
}