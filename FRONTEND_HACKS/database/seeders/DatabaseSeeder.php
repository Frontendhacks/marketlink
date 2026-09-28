<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FarmerProfile;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(['email' => 'admin@marketlink.com'], [
            'name' => 'MarketLink Admin', 'contact' => '03000000000', 'address' => 'Karachi, Pakistan',
            'password' => Hash::make('admin12345'), 'role' => 'admin', 'status' => 'active', 'approval_status' => 'approved',
        ]);

        $markets = collect([
            ['market_name'=>'Central Valley Market','address'=>'Karachi, Sindh','day'=>'Monday','timing'=>'8:00 AM - 6:00 PM'],
            ['market_name'=>'Fresh Farm Market','address'=>'Lahore, Punjab','day'=>'Wednesday','timing'=>'9:00 AM - 7:00 PM'],
            ['market_name'=>'Local Farmers Market','address'=>'Islamabad, ICT','day'=>'Saturday','timing'=>'8:00 AM - 5:00 PM'],
        ])->mapWithKeys(function ($data) {
            return [$data['market_name'] => Market::updateOrCreate(['market_name'=>$data['market_name']], array_merge($data, ['latitude'=>24.8607,'longitude'=>67.0011,'map_provider'=>'OpenStreetMap','status'=>'active']))];
        });

        $categories = collect([
            ['name'=>'Vegetables','description'=>'Fresh seasonal vegetables'],
            ['name'=>'Fruits','description'=>'Fresh local and orchard fruits'],
            ['name'=>'Nuts','description'=>'Quality nuts and dry produce'],
            ['name'=>'Organic','description'=>'Naturally grown farm produce'],
            ['name'=>'Grains','description'=>'Farm sourced grains'],
            ['name'=>'Dairy','description'=>'Fresh dairy products'],
        ])->mapWithKeys(fn($data) => [$data['name'] => Category::updateOrCreate(['name'=>$data['name']], $data + ['status'=>'active'])]);

        $farmerData = [
            ['name'=>'Ali Khan','email'=>'ali.farmer@marketlink.com','farm'=>'Green Farm','type'=>'Vegetable','city'=>'Karachi','size'=>'12 acres'],
            ['name'=>'Sara Raza','email'=>'sara.farmer@marketlink.com','farm'=>'Fresh Farm','type'=>'Fruit','city'=>'Lahore','size'=>'18 acres'],
            ['name'=>'Hassan Ali','email'=>'hassan.farmer@marketlink.com','farm'=>'Organic Farm','type'=>'Mixed','city'=>'Islamabad','size'=>'10 acres'],
        ];
        $farmers=[];
        foreach ($farmerData as $i=>$data) {
            $user=User::updateOrCreate(['email'=>$data['email']], [
                'name'=>$data['name'],'contact'=>'03'.(100000000+$i),'address'=>$data['city'].', Pakistan',
                'password'=>Hash::make('farmer12345'),'role'=>'farmer','status'=>'active','approval_status'=>'approved',
            ]);
            $market=$markets->values()->get($i % $markets->count());
            FarmerProfile::updateOrCreate(['farmer_id'=>$user->id], [
                'market_id'=>$market->market_id,'stall_name'=>$data['farm'],'stall_description'=>$data['type'].' farm producing fresh MarketLink products',
                'farm_type'=>$data['type'],'farm_size'=>$data['size'],'city'=>$data['city'],'status'=>'approved',
            ]);
            $farmers[]=$user;
        }

        // Demo registration that is still waiting for admin approval (cannot log in until approved).
        $pending = User::updateOrCreate(['email' => 'pending.farmer@marketlink.com'], [
            'name' => 'Bilal Pending', 'contact' => '03400000000', 'address' => 'Multan, Pakistan',
            'password' => Hash::make('farmer12345'), 'role' => 'farmer', 'status' => 'active', 'approval_status' => 'pending',
        ]);
        FarmerProfile::updateOrCreate(['farmer_id' => $pending->id], [
            'market_id' => $markets->values()->first()->market_id, 'stall_name' => 'Sunrise Orchard', 'stall_description' => 'Fruit',
            'farm_type' => 'Fruit', 'farm_size' => '6 acres', 'city' => 'Multan', 'status' => 'pending',
        ]);

        $customerData=[
            ['name'=>'Ahmed Khan','email'=>'ahmed.customer@marketlink.com','city'=>'Karachi'],
            ['name'=>'Fatima Ali','email'=>'fatima.customer@marketlink.com','city'=>'Lahore'],
            ['name'=>'Hamza Ahmed','email'=>'hamza.customer@marketlink.com','city'=>'Islamabad'],
        ];
        $customers=[];
        foreach($customerData as $data){
            $customers[]=User::updateOrCreate(['email'=>$data['email']],['name'=>$data['name'],'contact'=>'03200000000','address'=>$data['city'].', Pakistan','password'=>Hash::make('customer12345'),'role'=>'customer','status'=>'active','approval_status'=>'approved']);
        }

        $products=[
            ['Fresh Tomatoes','Vegetables',180,60,0],['Fresh Carrots','Vegetables',120,75,0],['Fresh Apples','Fruits',350,50,1],['Fresh Kiwi','Fruits',480,40,1],
            ['Fresh Bananas','Fruits',220,80,0],['Fresh Pineapples','Fruits',320,35,1],['Fresh Strawberries','Fruits',550,25,2],['Fresh Walnuts','Nuts',1200,30,2],
            ['Fresh Almonds','Nuts',1400,25,2],['Fresh Peaches','Fruits',420,35,1],['Fresh Blueberries','Fruits',650,20,2],['Fresh Mangoes','Fruits',280,70,0],
        ];
        $productModels=[];
        foreach($products as $i=>$data){
            [$name,$cat,$price,$stock,$farmerIndex]=$data;
            $farmer=$farmers[$farmerIndex % count($farmers)];
            $market=$markets->values()->get($farmerIndex % $markets->count());
            $productModels[]=Product::updateOrCreate(['name'=>$name,'farmer_id'=>$farmer->id],[
                'description'=>'Fresh quality '.$name.' supplied by '.$farmer->name.'.','price'=>$price,'stock_quantity'=>$stock,'available_day'=>$market->day,
                'status'=>'active','category_id'=>$categories[$cat]->category_id,'market_id'=>$market->market_id,
            ]);
        }

        if (Order::count() === 0) {
            foreach (array_slice($productModels,0,6) as $i=>$product) {
                $customer=$customers[$i % count($customers)];
                Order::create(['customer_id'=>$customer->id,'product_id'=>$product->product_id,'total_amount'=>$product->price*2,'quantity'=>2,'order_status'=>$i%3===0?'completed':($i%3===1?'confirmed':'pending'),'order_type'=>'normal','order_date'=>now()->subDays($i)]);
            }
        }
    }
}
