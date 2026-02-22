<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $user = User::create([
        'name' => 'Admin AORTA',
        'email' => 'admin@aorta.com',
        'password' => Hash::make('password123'),
    ]);
    
    echo "User created successfully: " . $user->email;
} catch (\Exception $e) {
    echo "Error creating user: " . $e->getMessage();
}
