<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $client = new Client();
        $response = $client->request('GET', 'https://raw.githubusercontent.com/dalfiannur/gudang-data/master/bank/bank.json');

        $ignores = ['BANK JASA JAKARTA', 'TELKOMSEL TCASH'];

        if ($response->getStatusCode() === 200) {
            $banks = json_decode($response->getBody()->getContents());

            foreach ($banks as $bank) {
                if (in_array($bank->name, $ignores)) {
                    continue;
                }

                Bank::query()->create([
                    'code' => $bank->code,
                    'name' => $bank->name,
                ]);
            }
        }
    }
}
