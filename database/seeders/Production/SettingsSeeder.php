<?php

namespace Database\Seeders\Production;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            //Site
            ['key' => 'site_name', 'value' => 'ITkha'],
            ['key' => 'site_description', 'value' => 'IT blog with articles, tutorials, and more.'],
            ['key' => 'site_keywords', 'value' => 'IT, tutorials, blog, technology'],


            //Comment
            ['key' => 'comments_enabled', 'value' => '1'],
            ['key' => 'comments_auto_approve', 'value' => '1'],
            ['key' => 'comments_filter_words', 'value' => 'www, .com, .net, .ru, .xyz, click here, buy now, free money, work from home, earn cash, visit site, subscribe now, promo, discount, deal, sale, crypto, bitcoin, nft, investment, forex, casino, gambling, bet now, 1xbet, telegram, whatsapp, t.me, bit.ly'],
            ['key' => 'comments_links_policy', 'value' => 'allow'],

            //User
            ['key' => 'user_default_status', 'value' => 'Active'],
            ['key' => 'user_default_role', 'value' => '3'], // id ролі "user"
            ['key' => 'user_require_email_verification', 'value' => '1'],

            //Telegram
            ['key' => 'telegram_enabled', 'value' => '0'],
            ['key' => 'telegram_token', 'value' => ''],
            ['key' => 'telegram_chat_id', 'value' => ''],
            ['key' => 'telegram_send_without_sound', 'value' => '0'],
            ['key' => 'telegram_template', 'value' => '
<b>{{title}}</b>

{{excerpt}}'],
            ['key' => 'telegram_message_limit', 'value' => '450'],
            ['key' => 'telegram_button_text', 'value' => 'Read more...'],

            ['key' => 'site_email', 'value' => 'admin@example.com'],
            ['key' => 'site_phone', 'value' => '+1 234 567 890'],
            ['key' => 'site_address', 'value' => 'Kyiv, Ukraine'],


        ];
        foreach ($data as $item) {
            Setting::firstOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value']]
            );
        }
    }
}
