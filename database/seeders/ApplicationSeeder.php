<?php

namespace Database\Seeders;

use App\Models\Applications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Applications::create([
            'name' => 'Grid Generator Application',
            'type' => 'design',
            'developer_name' => 'Dany Seifeddine',
            'url' => 'grid-generator',
            'icon' => 'bi bi-grid-3x3-gap',
            'features' => "",
            'description' => 'This grid generator application allows users to create custom CSS grids by specifying columns, rows, and gaps. Users can generate, copy, and export CSS and Tailwind code, including responsive designs for smaller screens. The app also features configuration saving and loading for convenient reuse of grid layouts.',
            'visibility' => 'public',
            'status' => 'available',
            'visitor_count' => 0,
            'created_at' => now(),
        ]);


        $applicationTypes = [
            ['label' => 'Design Tools', 'identifier' => 'design'],
            ['label' => 'Text Utilities', 'identifier' => 'text utility'],
            ['label' => 'Encoding & Conversions', 'identifier' => 'encoding/conversion'],
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

        // Uncomment and modify the following lines to create more applications
        /*
        \App\Models\Applications::create([
            'name' => 'Another Application',
            'type' => 'Mobile',
            'developer_name' => 'Jane Smith',
            'url' => 'https://anotherexample.com',
            'features' => json_encode(['Feature A', 'Feature B', 'Feature C']),
            'description' => 'This is another sample application.',
            'visibility' => 'public',
            'status' => 'available',
            'visitor_count' => 0,
        ]);
        */
    }
}
