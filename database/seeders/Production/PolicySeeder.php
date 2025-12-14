<?php

namespace Database\Seeders\Production;

use App\Models\Policy;
use App\Models\PolicyTranslation;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policy = Policy::updateOrCreate(
            [
                'key' => 'policy',
                'version' => 1,
            ],
            [
                'is_active' => true,
            ]
        );

        $translations = [
            'en' => [
                'title' => 'Privacy Policy',
                'content' => $this->privacyPolicyEn(),
            ],
            'uk' => [
                'title' => 'Політика конфіденційності',
                'content' => $this->privacyPolicyUk(),
            ],
        ];

        foreach ($translations as $locale => $data) {
            PolicyTranslation::updateOrCreate(
                [
                    'policy_id' => $policy->id,
                    'locale' => $locale,
                ],
                [
                    'title' => $data['title'],
                    'content' => $data['content'],
                ]
            );
        }
    }

    private function privacyPolicyEn(): string
    {
        return "<h1><strong>1. General Provisions</strong></h1><div>This Privacy Policy governs the procedure for the collection, use, storage, disclosure, and protection of personal data of users who use this website.</div><div>By using the Website, the User agrees to the processing of personal data in accordance with this Policy.</div><h1><strong>2. Definitions</strong></h1><ul><li>Personal Data — information relating to an identifiable individual.</li><li>Processing — any operation performed on personal data</li><li>Controller — the entity determining purposes of processing.</li></ul><h1><strong>3. Personal Data We Collect</strong></h1><ol><li>Name and surname</li><li>Email address</li><li>Phone number (if provided)</li><li>IP address</li><li>Browser and device data</li><li>Cookies</li></ol><h1><strong>4. Purposes of Processing</strong></h1><ul><li>Providing Website functionality</li><li>User authentication</li><li>Communication</li><li>Security and fraud prevention</li><li>Legal compliance</li></ul><h1><strong>5. Legal Basis</strong></h1><div>Processing is carried out based on user consent, contractual necessity, legal obligations, or legitimate interests.</div><h1><strong>6. Data Retention</strong></h1><div>Personal data is stored only as long as necessary for the stated purposes.</div><h1><strong>7. Data Protection</strong></h1><div>Appropriate technical and organizational measures are applied to protect personal data.</div><h1><strong>8. Third Parties&nbsp;</strong></h1><div>Data is not transferred to third parties except as required by law or service provision.</div><h1><strong>9. Cookies</strong></h1><div>The Website uses cookies to ensure proper operation and analytics.</div><h1><strong>10. User Rights</strong></h1><div>Access personal data<br>Request correction or deletion<br>Withdraw consent</div><h1><strong>11. Policy Changes</strong></h1><div>The Policy may be updated at any time and becomes effective upon publication.</div><h1><strong>12. Contact</strong></h1><div>Questions regarding this Policy may be submitted via the Website.<br></div>";
    }

    private function privacyPolicyUk(): string
    {
        return "<h1><strong>1. Загальні положення&nbsp;</strong></h1><div>Ця Політика визначає порядок обробки персональних даних користувачів Сайту.<br>Користуючись Сайтом, Користувач надає згоду на обробку персональних даних.</div><h1><strong>2. Терміни</strong></h1><ul><li><strong>Персональні дані</strong> — інформація про фізичну особу.</li><li><strong>Обробка</strong> — будь-які дії з персональними даними.</li><li><strong>Володілець</strong> — особа, що визначає мету обробки.</li></ul><h1><strong>3. Дані, які ми збираємо</strong></h1><ul><li>Імʼя та прізвище</li><li>Email</li><li>Телефон (за наявності)</li><li>IP-адреса</li><li>Дані браузера</li><li>Cookie</li></ul><h1><strong>4. Мета обробки</strong></h1><ul><li>Робота Сайту&nbsp;</li><li>Авторизація</li><li>Звʼязок з Користувачем</li><li>Безпека</li><li>Виконання вимог законодавства</li></ul><h1><strong>5. Правові підстави</strong></h1><div>Обробка здійснюється на підставі згоди, договору або вимог закону.</div><h1><strong>6. Зберігання&nbsp;</strong></h1><div>Дані зберігаються не довше, ніж це необхідно.</div><h1><strong>7. Захист</strong></h1><div>Ми застосовуємо технічні та організаційні заходи захисту.</div><h1>&nbsp;<strong>8. Передача даних</strong></h1><div>Передача третім особам можлива лише у випадках, передбачених законом.</div><h1><strong>9. Cookie</strong></h1><div>Cookie використовуються для коректної роботи Сайту.</div><h1><strong>10. Права Користувача</strong></h1><ul><li>Доступ до даних</li><li>Видалення або виправлення</li><li>Відкликання згоди</li></ul><h1><strong>11. Зміни</strong></h1><div>Політика може змінюватися без попереднього повідомлення.</div><h1><strong>12. Контакти</strong></h1><div>З усіх питань звертайтесь через Сайт.<br></div>";
    }
}
