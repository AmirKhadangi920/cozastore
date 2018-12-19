<?php

use Illuminate\Database\Seeder;
use Ybazli\Faker\Facades\Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 5)->create()->each( function ($user) {

            $colors = factory(\App\Models\Color::class, 20)->create();
            $orders = factory(\App\Models\Order::class, 20)->create(['buyer' => $user->id]);
            $warranties = factory(\App\Models\Warranty::class, 10)->create();
            $brands = factory(\App\Models\Brand::class, 10)->create();

            factory(\App\Models\Category::class, 5)->create()->each( function ($category) use ($user, $colors, $orders, $warranties, $brands) {
                
                $spec_rows = null;

                $specs = factory(\App\Models\Spec\Spec::class)->create([
                    'category_id' => $category->id
                ])->each( function ($spec) use(&$spec_rows) {

                    factory(\App\Models\Spec\SpecHeader::class, rand(2, 5))->create([
                        'spec_id' => $spec->id
                    ])->each( function ( $spec_header ) use ( $spec, &$spec_rows ) {

                        $spec_rows = factory(\App\Models\Spec\SpecRow::class, rand(1, 5))->create([
                            'spec_header_id' => $spec_header->id
                        ]);
                    });
                });

                $products = factory(\App\Models\Product::class, rand(1, 10))->create([
                    'user_id' => $user->id,
                    'brand_id' => $brands[rand(0, 9)]->id,
                    'parent_category' => $category->id,
                    'category_id' => $category->id
                ])->each(function ($product) use ($user, $colors, $orders, $warranties, $spec_rows) {

                    factory(\App\Models\ProductVariation::class, rand(1, 3))->create([
                        'warranty_id' => $warranties[rand(0, 9)]->id, 
                        'product_id' => $product->id,
                        'color_id' => $colors[rand(0, 19)]->id
                    ])->each( function ($variation) use ($orders) {

                        factory(\App\Models\OrderItem::class, rand(0, 3))->create([
                            'order_id' => $orders[rand(0, 19)]->id,
                            'variation_id' => $variation->id,
                            'price' => $variation->price,
                        ]);
                    });

                    factory(\App\Models\Review::class, rand(0, 20))->create([
                        'product_id' => $product->id,
                        'user_id' => $user->id
                    ]);

                    $spec_rows->each( function ($spec_row) use ($product) {

                        factory(\App\Models\Spec\SpecData::class)->create([
                            'spec_row_id' => $spec_row->id,
                            'product_id' => $product->id,
                            'data' => ($spec_row->values)
                                    ? rand(0, count(json_encode($spec_row->values), true) - 1)
                                    : Faker::fullName()
                        ]);
                    });
                });
            });
        });
    }
}
