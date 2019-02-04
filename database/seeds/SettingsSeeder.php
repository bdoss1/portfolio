<?php

use Illuminate\Database\Seeder;
use \Backpack\Settings\app\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('logo', 'browse', '', 'Logo for your site');
        $this->create('email', 'email', 'test@mail.com', 'E-mail, that user can view on the site');
        $this->create('email_feedback', 'email', 'test@mail.com', 'E-mail on which applications will come');
        $this->create('copy', 'text', '© 2019 Copy ', 'Copyright');
        $this->create('socials', 'table', json_encode([
            ['icon' => 'fa-facebook', 'url' => 'https://fb.com'],
            ['icon' => 'fa-twitter', 'url' => 'https://twitter.com'],
            ['icon' => 'fa-instagram', 'url' => 'https://instagram.com'],
            ['icon' => 'fa-vk', 'url' => 'https://vk.com']
        ]), 'Socials for contact with you', [ // Table
            'name' => 'value',
            'label' => 'Value',
            'type' => 'table',
            'entity_singular' => 'social', // used on the "Add X" button
            'columns' => [
                'icon' => 'Icon',
                'url' => 'Url'
            ],
            'min' => 1
        ]);
    }

    private function create($key, $type, $value, $description = null, $field = null)
    {
        if (!empty($field)) $field = json_encode($field);

        if (!Setting::where('key', $key)->count() > 0) {
            $setting = new Setting([
                'key' => $key,
                'name' => ucfirst($key),
                'description' => $description,
                'value' => $value,
                'field' => $field ?? '{"name":"value","label":"Value","type":"' . $type . '"}',
                'active' => 1,
            ]);
            return $setting->save();
        }

        return false;
    }
}
