<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'alirioportilla96@gmail.com'],
            [
                'name'     => 'Alirio Portilla',
                'password' => Hash::make('admin1234'),
                'role'     => 'admin',
            ]
        );

        $client = User::updateOrCreate(
            ['email' => 'cliente@test.com'],
            [
                'name'     => 'Cliente Test',
                'password' => Hash::make('cliente1234'),
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
