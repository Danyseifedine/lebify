<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Applications;
use App\Models\Page_contents;
use App\Models\PageContents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laratrust\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PageContents::create([
            'type' => 'navbar',
            'items' => [
                'theme' => [
                    'default' => 'dark',
                    'visibility' => true,
                ],
                'logo' => [
                    'url' => 'logo.png',
                    'alt' => 'lebify',
                    'visibility' => true,
                ],
                'menu' => [
                    'Home' => [
                        'id' => 1,
                        'label' => 'Home',
                        'url' => '/',
                        'visibility' => true,
                        'order' => 1,
                    ],
                    'Development' => [
                        'id' => 2,
                        'label' => 'Development',
                        'url' => '/development',
                        'visibility' => true,
                        'order' => 2,
                    ],
                    'Blog' => [
                        'id' => 3,
                        'label' => 'Blog',
                        'url' => '/blog',
                        'visibility' => true,
                        'order' => 3,
                    ],
                ],
                'right-menu' => [
                    'join_us' => [
                        'label' => 'Join Us',
                        'url' => '/join-us',
                        'visibility' => true,
                    ],
                    'get_started' => [
                        'label' => 'Get Started',
                        'visibility' => true,
                    ],
                ],
            ],
            'version' => 1,
        ]);

        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'User with full access to the system'
        ]);
        Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'Regular user with limited access'
        ]);

        User::create([
            'name' => 'danySeifeddine',
            'email' => 'danyseifeddine@lebify.online',
            'email_verified_at' => now(),
            'password' => Hash::make('idkpass881@'),
        ])->addRole('admin');

        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('idkpass881@'),
        ])->addRole('user');


        $applicationTypes = [
            ['label' => 'Design Tools', 'identifier' => 'design'],
            ['label' => 'Text Utilities', 'identifier' => 'text utility'],
            ['label' => 'Encoding & Conversions', 'identifier' => 'encoding-conversion'],
            ['label' => 'Identifiers', 'identifier' => 'identifier'],
            ['label' => 'Compressor', 'identifier' => 'compressor'],
            ['label' => 'Calculators', 'identifier' => 'calculator'],
            ['label' => 'Random Generators', 'identifier' => 'random generator'],
            ['label' => 'Development Tools', 'identifier' => 'development tools'],
        ];

        foreach ($applicationTypes as $type) {
            $count = Applications::where('type', $type['identifier'])->count();
            try {
                \App\Models\ApplicationType::create([
                    'label' => $type['label'],
                    'identifier' => $type['identifier'],
                    'application_count' => $count,
                ]);
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                Log::error("Failed to create ApplicationType: " . $e->getMessage());
            }
        }
    }
}
