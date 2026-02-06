<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Image::truncate();
        Product::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csv = fopen(base_path('database/data/product.csv'), 'r');
        $firstline = true;

        while (($data = fgetcsv($csv, 0, ',', '"', '\\')) !== false) {


            if ($firstline) {
                $firstline = false;
                continue;
            }

            $product = Product::create([
                'name'        => $data[5]  ?? null,
                'brand'       => $data[8]  ?? null,
                'code'        => $data[9]  ?? null,
                'availability' => $data[10] ?? null,
                'description' => $data[11] ?? null,
                'category_id' => $data[21] ?? null,
                'price'       => $data[24] ?? null,
            ]);

            $imageIndexes = [17, 18, 19, 20];

            $tagIndexes = [12, 13, 14, 15, 16];

            foreach ($imageIndexes as $i) {
                $img = trim($data[$i] ?? '');

                if ($img !== '') {
                    Image::create([
                        'product_id' => $product->id,
                        'name' => $img,
                    ]);
                }
            }

            foreach ($tagIndexes as $i) {
                $tagCsv = trim($data[$i] ?? '');


                if ($tagCsv !== '') {
                    $tag = Tag::create([
                        "name" => $tagCsv
                    ]);
                    ProductTag::create([
                        'product_id' => $product->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            }
        }

        fclose($csv);
    }
}
