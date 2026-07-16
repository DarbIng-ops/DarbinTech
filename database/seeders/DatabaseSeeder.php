<?php
namespace Database\Seeders;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Guard: este seeder solo debe correr en entorno local.
        // Si algún día se ejecuta accidentalmente en producción, no crea usuarios de prueba.
        if (!app()->environment('local')) {
            return;
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@darbintech.test'],
            [
                'name'     => 'Alirio Portilla',
                // Password viene de .env (SEED_ADMIN_PASSWORD). Si no está seteada,
                // genera una aleatoria en vez de exponer un valor fijo en el repo.
                'password' => Hash::make(env('SEED_ADMIN_PASSWORD', Str::random(16))),
                'role'     => 'admin',
            ]
        );
        $client = User::updateOrCreate(
            ['email' => 'cliente@test.com'],
            [
                'name'     => 'Cliente Test',
                'password' => Hash::make(env('SEED_CLIENT_PASSWORD', Str::random(16))),
                'role'     => 'client',
            ]
        );
        Project::updateOrCreate(
            ['name' => 'Web Profesional — Test', 'user_id' => $client->id],
            [
                'stage'            => 'desarrollo',
                'progress'         => 45,
                'revisions_allowed' => 2,
                'revisions_used'   => 0,
            ]
        );
    }
}
