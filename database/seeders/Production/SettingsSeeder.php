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
            ['key' => 'site_name', 'default' => 'Example'],
            ['key' => 'site_description', 'default' => 'A professional IT platform featuring technical articles, analytical insights, and practical solutions for developers and system administrators.'],
            ['key' => 'site_keywords', 'default' => null],

            //Comment
            ['key' => 'comments_enabled', 'default' => '1'],
            ['key' => 'comments_auto_approve', 'default' => '1'],
            ['key' => 'comments_filter_words', 'default' => 'www, .com, .net, .ru, .xyz, click here, buy now, free money, work from home, earn cash, visit site, subscribe now, promo, discount, deal, sale, crypto, bitcoin, nft, investment, forex, casino, gambling, bet now, 1xbet, telegram, whatsapp, t.me, bit.ly'],
            ['key' => 'comments_links_policy', 'default' => 'allow'],

            //User
            ['key' => 'user_default_status', 'default' => 'Active'],
            ['key' => 'user_default_role', 'default' => '3'], // id ролі "user"
            ['key' => 'user_require_email_verification', 'default' => '1'],

            //Telegram
            ['key' => 'telegram_enabled', 'default' => '0'],
            ['key' => 'telegram_token', 'default' => null],
            ['key' => 'telegram_chat_id', 'default' => null],
            ['key' => 'telegram_send_without_sound', 'default' => '0'],
            ['key' => 'telegram_template', 'default' => '
<b>{{title}}</b>

{{ category }}
{{excerpt}}

{{ tags }} 
<a href="{{ author_url }}">{{ author }}</a> - {{ data }}'],
            ['key' => 'telegram_message_limit', 'default' => '450'],
            ['key' => 'telegram_button_text', 'default' => 'Read more...'],

            ['key' => 'site_email', 'default' => null],
            ['key' => 'site_phone', 'default' => null],
            ['key' => 'site_address', 'default' => null],


        ];
        foreach ($data as $item) {
            Setting::firstOrCreate(
                ['key' => $item['key']],
                ['default' => $item['default']]
            );
        }
    }
}
