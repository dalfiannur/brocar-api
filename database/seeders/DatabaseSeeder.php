<?php

namespace Database\Seeders;

use App\Models\SellerReviewItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->callOnce([
            AreaSeeder::class,

            RolesSeeder::class,
            UsersSeeder::class,
            SellersSeeder::class,
            AgentsSeeder::class,
            ProfilesSeeder::class,
            UserAddressesSeeder::class,
            RanksSeeder::class,
            ReferalsSeeder::class,
            ContactsSeeder::class,

            BanksSeeder::class,
            UserBanksSeeder::class,

            BrandsSeeder::class,
            ModelsSeeder::class,
            SeriesSeeder::class,
            TransmissionsSeeder::class,
            DriveWheelsSeeder::class,
            FuelsSeeder::class,
            BodyTypesSeeder::class,
            CarsSeeder::class,

            CheckLocationsSeeder::class,
            AdminFeesSeeder::class,
            CommissionsSeeder::class,

            AdsSeeder::class,
            AdImagesSeeder::class,
            ViewCountersSeeder::class,

            AgenciesSeeder::class,

            OrderStatusesSeeder::class,
            BuyersSeeder::class,
            BookingsSeeder::class,

            ShopItemsSeeder::class,
            ShopOrdersSeeder::class,
            QuotaLotsSeeder::class,

            WalletsSeeder::class,
            WithdrawStatusesSeeder::class,
            WithdrawsSeeder::class,

            ReviewsSeeder::class,
            SellerReviewsSeeder::class
        ]);
    }
}
