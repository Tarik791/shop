<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateDummyShopData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-dummy-shop-data 
                            {--products=10 : Number of products} 
                            {--variants=30 : Number of variants} 
                            {--images=20 : Number of images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        config([
            'database.connections.mysql.host' => '127.0.0.1',
            'database.connections.mysql.port' => '3305',
        ]);

        $productCount = (int) $this->option('products');
        $variantCount = (int) $this->option('variants');
        $imageCount = (int) $this->option('images');

        Log::info("🛒 Generating $productCount products...");
        $products = [];

        for ($i = 1; $i <= $productCount; $i++) {
            $handle = Str::slug("Product $i") . '-' . rand(1, 1000); 
        
            $products[] = Product::create([
                'uuid' => (string) Str::uuid(),
                'title' => "Product $i",
                'handle' => $handle,
                'price' => rand(10, 500),
            ]);
        }
        

        Log::info("🖼️ Generating $imageCount images...");
        $images = [];

        for ($i = 1; $i <= $imageCount; $i++) {
            $images[] = Image::create([
                'uuid' => (string) Str::uuid(),
                'url' => "https://picsum.photos/200?random=" . rand(1, 1000),
            ]);
        }

        $productUuids = collect($products)->pluck('uuid')->toArray();
        $imageUuids = collect($images)->pluck('uuid')->toArray();

        Log::info("🧬 Generating $variantCount variants...");
        for ($i = 1; $i <= $variantCount; $i++) {
            // Dodavanje nasumičnog broja u handle da bi bio jedinstven
            $handle = "variant-" . $i . '-' . rand(1000, 9999); // Dodajte nasumičan broj na variant handle
        
            Variant::create([
                'uuid' => (string) Str::uuid(),
                'product_id' => $productUuids[array_rand($productUuids)],
                'price' => rand(5, 300),
                'handle' => $handle, // Jedinstveni handle sa nasumičnim brojem
                'image_id' => $imageUuids[array_rand($imageUuids)],
            ]);
        }        

        Log::info('✅ Dummy data successfully generated.');
    }
}
