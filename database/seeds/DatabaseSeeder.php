<?php

use Illuminate\Database\Seeder;
use Ybazli\Faker\Facades\Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ( !\App\User::find('3g6s316j') )
        {
            \App\User::create([
                'id' => '3g6s316j',
                'first_name' => 'امیر',
                'last_name' => 'خدنگی',
                'phone' => '09105009868',
                'email' => 'AmirKhadangi920@Gmail.com',
                'password' => Hash::make('123456'),
                'state' => 'خراسان رضوی',
                'city' => 'مشهد',
                'address' => 'سناباد 44 ، ساختمان 52',
                'postal_code' => '1234567890',
                'type' => 1
            ]);
        }

        if ( \App\Models\Option::all()->isEmpty() )
        {
            \App\Models\Option::create([
                'name' => 'slider',
                'value' => "[{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062e\\u0631\\u06cc\\u062f \\u06a9\\u0646\\u06cc\\u062f\",\"photo\":\"f9f28eaa.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 2 \\u0627\\u0635\\u0644\\u0627\\u062d \\u0634\\u062f\\u0647\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 2\",\"photo\":\"e8dd6566.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 3\",\"photo\":\"312a4973.jpg\"}]",
            ]);
            \App\Models\Option::create([
                'name' => 'posters',
                'value' => "[{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"photo\":\"3c52cb59.jpeg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 2\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"photo\":\"11d55624.jpg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"photo\":\"27968418.jpg\"}]",
            ]);
            \App\Models\Option::create([
                'name' => 'site_name',
                'value' => 'HiCO Store',
            ]);
            \App\Models\Option::create([
                'name' => 'site_description',
                'value' => 'این یک توضیح خیلی کوتاه و تصادفی درباره فروشگاه و کسب و کار کوچک هایکو استور میباشد که توسط مدیر قابل تعویض است',
            ]);
            \App\Models\Option::create([
                'name' => 'site_logo',
                'value' => 'b0fae1e6.png',
            ]);
            \App\Models\Option::create([
                'name' => 'watermark',
                'value' => 'b0fae1e6.png',
            ]);
            \App\Models\Option::create([
                'name' => 'shop_phone',
                'value' => '09123456789',
            ]);
            \App\Models\Option::create([
                'name' => 'shop_address',
                'value' => 'خراسان رضوی ، مشهد ، بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1',
            ]);
            \App\Models\Option::create([
                'name' => 'social_link',
                'value' => "{\"instagram\":\"https:\\/\\/instagram.com\\/\",\"telegram\":\"https:\\/\\/telegram.com\\/\",\"facebook\":\"https:\\/\\/facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\"}",
            ]);
            \App\Models\Option::create([
                'name' => 'dollar_cost',
                'value' => '14500',
            ]);
            \App\Models\Option::create([
                'name' => 'shipping_cost',
                'value' => "{\"model1\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9\",\"cost\":\"5000\"},\"model2\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648\",\"cost\":\"14000\"},\"model3\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647\",\"cost\":\"8000\"},\"model4\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0686\\u0647\\u0627\\u0631\",\"cost\":\"5000\"}}",
            ]);
        }
        
        factory(\App\User::class, 5)->create()->each( function ($user) {

            factory(\App\Models\Article::class, rand(0, 10))->create([
                'user_id' => $user->id
            ]);

            $colors = factory(\App\Models\Color::class, 20)->create();
            $orders = factory(\App\Models\Order::class, 20)->create(['buyer' => $user->id]);
            $warranties = factory(\App\Models\Warranty::class, 10)->create();
            $brands = factory(\App\Models\Brand::class, 10)->create();
            factory(\App\Models\DiscountCode::class, rand(1, 5))->create([
                'user_id' => $user->id
            ]);

            factory(\App\Models\Category::class, 5)->create()->each( function ($category) use ($user, $colors, $orders, $warranties, $brands) {
                
                $spec_rows = null;

                $specs = factory(\App\Models\Spec\Spec::class)->create([
                    'category_id' => $category->id
                ]);
                $specs->each( function ($spec) use (&$spec_rows) {

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
                    'category_id' => $category->id,
                    'spec_id' => $specs->id
                ])->each(function ($product) use ($user, $colors, $orders, $warranties, $spec_rows) {

                    factory(\App\Models\ProductVariation::class, rand(1, 3))->create([
                        'warranty_id' => $warranties[rand(0, 9)]->id, 
                        'product_id' => $product->id,
                        'color_id' => $colors[rand(0, 19)]->id,
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
                                    ? rand(0, count($spec_row->values, true) - 1)
                                    : Faker::fullName()
                        ]);
                    });
                });
            });
        });
    }
}
