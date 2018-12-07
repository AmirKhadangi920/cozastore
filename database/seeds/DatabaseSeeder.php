<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create()->each( function ($user) {

            $colors = factory(\App\Color::class, 20)->create();
            $orders = factory(\App\Order::class, 20)->create(['buyer' => $user->id]);
            
            factory(\App\Category::class, 5)->create()->each( function ($category) use ($user, $colors, $orders) {
                
                factory(\App\Product::class, rand(1, 10))->create([
                    'user_id' => $user->id,
                    'parent_category' => $category->id,
                    'category_id' => $category->id
                ])->each(function ($product) use ($user, $colors, $orders) {

                    factory(\App\ProductVariation::class, rand(1, 3))->create([
                        'product_id' => $product->id,
                        'color_id' => $colors[rand(0, 19)]->id
                    ])->each( function ($variation) use ($orders) {

                        factory(\App\OrderItem::class, rand(0, 3))->create([
                            'order_id' => $orders[rand(0, 19)]->id,
                            'variation_id' => $variation->id,
                            'price' => $variation->price,
                        ]);
                    });


                    factory(\App\Review::class, rand(0, 20))->create([
                        'product_id' => $product->id,
                        'user_id' => $user->id
                    ]);
                });
            });
        });
    }
}
