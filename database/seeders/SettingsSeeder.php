<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['key' => 'comments_enabled', 'value' => '1'],
            ['key' => 'comments_auto_approve', 'value' => '1'],
            ['key' => 'comments_filter_words', 'value' => 'www, .com, .net, .ru, .xyz, click here, buy now, free money, work from home, earn cash, visit site, subscribe now, promo, discount, deal, sale, crypto, bitcoin, nft, investment, forex, casino, gambling, bet now, 1xbet, telegram, whatsapp, t.me, bit.ly'],
            ['key' => 'comments_links_policy', 'value' => 'allow'],
        ];
        foreach ($data as $item) {
            Setting::firstOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value']]
            );
        }
    }
}
