<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Article;
use App\Models\Project;

$out = "--- ARTICLES ---\n";
foreach(Article::all() as $a) {
    $out .= "ID: {$a->id} | Title: {$a->title}\n";
    $out .= "Content:\n{$a->content}\n";
    $out .= "----------------\n";
}

$out .= "\n--- PROJECTS ---\n";
foreach(Project::all() as $p) {
    $out .= "ID: {$p->id} | Title: {$p->title}\n";
    $out .= "Description:\n{$p->description}\n";
    $out .= "----------------\n";
}

file_put_contents('full_db_dump.txt', $out);
echo "Dumped to full_db_dump.txt\n";
