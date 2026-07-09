<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$ads = \App\Models\Advertisement::all();
echo "Total ads: " . $ads->count() . PHP_EOL;
foreach ($ads as $ad) {
    echo "ID: {$ad->id}, Title: {$ad->title}, Type: {$ad->type}, Placement: {$ad->placement}, Status: {$ad->status}, Image: {$ad->image_url}, Link: {$ad->link}" . PHP_EOL;
}
