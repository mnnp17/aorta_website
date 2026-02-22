<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $user = User::where('email', 'admin@aorta.com')->first();
    
    if ($user) {
        $user->password = Hash::make('admin123');
        $user->save();
        echo "Password updated successfully for: " . $user->email;
    } else {
        // Create if not exists (just in case)
        $user = User::create([
            'name' => 'Admin AORTA',
            'email' => 'admin@aorta.com',
            'password' => Hash::make('admin123'),
        ]);
        echo "User created with new password: " . $user->email;
    }
} catch (\Exception $e) {
    echo "Error updating password: " . $e->getMessage();
}
