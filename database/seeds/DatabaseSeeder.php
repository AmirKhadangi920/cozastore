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
        echo "\n\n";

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
            echo "\e[31mAmir Khadangi user \e[39mwith id=\e[30m\e[101m3g6s316j\e[49m \e[39mwas \e[32mcreated\n";
        }
        
        if ( \App\Models\Option::all()->isEmpty() )
        {
            $data = [
                [
                    'name' => 'slider',
                    'value' => "[{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06f1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062e\\u0631\\u06cc\\u062f \\u06a9\\u0646\\u06cc\\u062f\",\"photo\":\"f9f28eaa.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 2 \\u0627\\u0635\\u0644\\u0627\\u062d \\u0634\\u062f\\u0647\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 2\",\"photo\":\"e8dd6566.jpg\"},{\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u062a\\u0635\\u0627\\u062f\\u0641\\u06cc \\u0627\\u0633\\u0644\\u0627\\u06cc\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 3\",\"photo\":\"312a4973.jpg\"}]",
                ], [
                    'name' => 'posters',
                    'value' => "[{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 1\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"link\":\"http:\\/\\/hicostore\\/link1\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 1\",\"photo\":\"3c52cb59.jpeg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 2\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"link\":\"http:\\/\\/hicostore\\/link2\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 2\",\"photo\":\"11d55624.jpg\"},{\"title\":\"\\u067e\\u0648\\u0633\\u062a\\u0631 3\",\"description\":\"\\u062a\\u0648\\u0636\\u06cc\\u062d \\u067e\\u0648\\u0633\\u062a\\u0631 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"link\":\"http:\\/\\/hicostore\\/link3\",\"button\":\"\\u062f\\u06a9\\u0645\\u0647 \\u0634\\u0645\\u0627\\u0631\\u0647 3\",\"photo\":\"27968418.jpg\"}]",
                ], [
                    'name' => 'site_name',
                    'value' => 'HiCO Store',
                ], [
                    'name' => 'site_description',
                    'value' => 'این یک توضیح خیلی کوتاه و تصادفی درباره فروشگاه و کسب و کار کوچک هایکو استور میباشد که توسط مدیر قابل تعویض است',
                ], [
                    'name' => 'site_logo',
                    'value' => 'b0fae1e6.png',
                ], [
                    'name' => 'watermark',
                    'value' => 'b0fae1e6.png',
                ], [
                    'name' => 'watermark',
                    'value' => 'b0fae1e6.png',
                ], [
                    'name' => 'watermark',
                    'value' => 'b0fae1e6.png',
                ], [
                    'name' => 'shop_phone',
                    'value' => '09123456789',
                ], [
                    'name' => 'min_total',
                    'value' => '100000',
                ], [
                    'name' => 'shop_address',
                    'value' => 'خراسان رضوی ، مشهد ، بین دستغیب 15 و 17 ، پلاک 231 ، واحد 1',
                ], [
                    'name' => 'social_link',
                    'value' => "{\"instagram\":\"https:\\/\\/instagram.com\\/\",\"telegram\":\"https:\\/\\/telegram.com\\/\",\"facebook\":\"https:\\/\\/facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\"}",
                ], [
                    'name' => 'dollar_cost',
                    'value' => '14500',
                ], [
                    'name' => 'shipping_cost',
                    'value' => "{\"model1\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u06cc\\u06a9\",\"cost\":\"5000\"},\"model2\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u062f\\u0648\",\"cost\":\"14000\"},\"model3\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0633\\u0647\",\"cost\":\"8000\"},\"model4\":{\"name\":\"\\u0645\\u062a\\u062f \\u0634\\u0645\\u0627\\u0631\\u0647 \\u0686\\u0647\\u0627\\u0631\",\"cost\":\"5000\"}}",
                ]
            ];

            foreach ( $data as $item )
                \App\Models\Option::create(['name' => $item['name'], 'value' => $item['value']]);

            echo "\e[31mWebsite options \e[39mwas \e[32mcreated\n";
        }
        
        factory(\App\User::class, 5)->create()->each( function ($user) {
            echo "\e[31mUser \e[39mwith id=\e[30m\e[101m{$user->id}\e[49m \e[39mwas \e[32mcreated\n";

            $articles = factory(\App\Models\Article::class, rand(0, 10))->create([
                'user_id' => $user->id
            ]);
            echo "\e[31m\e[1m\e[100m{$articles->count()}\e[49m Articles \e[39mwas \e[32mcreated\n";

            $colors = factory(\App\Models\Color::class, 20)->create();
            echo "\e[31m\e[1m\e[100m{$colors->count()}\e[49m Colors \e[39mwas \e[32mcreated\n";

            $orders = factory(\App\Models\Order::class, 20)->create(['buyer' => $user->id]);
            echo "\e[31m\e[1m\e[100m{$orders->count()}\e[49m Orders \e[39mwas \e[32mcreated\n";

            $warranties = factory(\App\Models\Warranty::class, 10)->create();
            echo "\e[31m\e[1m\e[100m{$warranties->count()}\e[49m Warranties \e[39mwas \e[32mcreated\n";

            $brands = factory(\App\Models\Brand::class, 10)->create();
            echo "\e[31m\e[1m\e[100m{$brands->count()}\e[49m Brands \e[39mwas \e[32mcreated\n";
            
            $discount_codes = factory(\App\Models\DiscountCode::class, rand(1, 5))->create([
                'user_id' => $user->id
            ]);
            echo "\e[31m\e[1m\e[100m{$discount_codes->count()}\e[49m Discount codes \e[39mwas \e[32mcreated\n";

            factory(\App\Models\Category::class, 5)->create()->each( function ($category) use ($user, $colors, $orders, $warranties, $brands) {
                echo "\e[31mCategory \e[39mwith id=\e[30m\e[101m{$category->id}\e[49m \e[39mwas \e[32mcreated\n";

                $spec_rows = null;

                $specs = factory(\App\Models\Spec\Spec::class)->create([
                    'category_id' => $category->id
                ]);
                echo "\e[31mSpecification table \e[39mfor category=\e[30m\e[101m{$category->title}\e[49m \e[39mwas \e[32mcreated\n";

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
                    echo "\e[31mProduct \e[39mwith id=\e[30m\e[101m{$product->id}\e[49m \e[39mwas \e[32mcreated\n";

                    factory(\App\Models\ProductVariation::class, rand(1, 3))->create([
                        'warranty_id' => $warranties[rand(0, 9)]->id, 
                        'product_id' => $product->id,
                        'color_id' => $colors[rand(0, 19)]->id,
                    ])->each( function ($variation) use ( $orders, $product ) {
                        echo "\e[31mVariation \e[39mfor product=\e[30m\e[101m{$product->name}\e[49m \e[39mwas \e[32mcreated\n";
                        
                        $order_items = factory(\App\Models\OrderItem::class, rand(0, 3))->create([
                            'order_id' => $orders[rand(0, 19)]->id,
                            'variation_id' => $variation->id,
                            'price' => $variation->price,
                        ]);
                        echo "\e[31m\e[1m\e[100m{$order_items->count()}\e[49m Order item \e[39mfor variation=\e[30m\e[101m{$variation->id}\e[49m \e[39mwas \e[32mcreated\n";
                    });

                    $reviews = factory(\App\Models\Review::class, rand(0, 20))->create([
                        'product_id' => $product->id,
                        'user_id' => $user->id
                    ]);
                    echo "\e[31m\e[1m\e[100m{$reviews->count()}\e[49m Order item \e[39mfor product=\e[30m\e[101m{$product->name}\e[49m \e[39mwas \e[32mcreated\n";

                    $spec_rows->each( function ($spec_row) use ($product) {

                        factory(\App\Models\Spec\SpecData::class)->create([
                            'spec_row_id' => $spec_row->id,
                            'product_id' => $product->id,
                            'data' => ($spec_row->values)
                                    ? rand(0, count($spec_row->values, true) - 1)
                                    : Faker::fullName()
                        ]);
                    });
                    echo "\e[31m\e[1m\e[100m?\e[49m specefication table data \e[39mfor product=\e[30m\e[101m{$product->name}\e[49m \e[39mwas \e[32mcreated\n";
                });
            });
        });
        echo "\n\n";
    }
}
