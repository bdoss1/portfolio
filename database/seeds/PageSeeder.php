<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Page::whereSlug('main')->count() < 1) {
            $page = new Page();
            $page->title = [
                'ru' => 'Больше <br><span>чем агенство</span>',
                'en' => 'More of <br><span>an agency</span>'
            ];
            $page->content = [
                'ru' => '<p class="top_45">Мы дизайнерское агентство в Лос-Анджелесе. Мы<br> роектируем <span class="element" data-text1="web interface." data-text2="branding identity." data-text3="logo." data-loop="true" data-backdelay="1500">logo.</span><span class="typed-cursor">|</span></p>',
                'en' => '<p class="top_45">We are a design agency in Los Angeles. We are<br> designing <span class="element" data-text1="web interface." data-text2="branding identity." data-text3="logo." data-loop="true" data-backdelay="1500">logo.</span><span class="typed-cursor">|</span></p>'
            ];
            $page->template = 'main';
            $page->name = 'Main';
            $page->slug = 'main';
            $page->save();
        }

        if (Page::whereSlug('about')->count() < 1) {
            $page = new Page();
            $page->title = [
                'ru' => 'Обо мне',
                'en' => 'About me'
            ];
            $page->content = [
                'ru' => "
                        <h2>It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.</h2>
                        <p>&nbsp;</p>
                        
                        <p>What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.</p>
                        
                        <p>&nbsp;</p>
                        
                        <p>A collection of textile samples lay spread out on the table and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p>
                        
                        <p>What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.</p>

                    ",
                'en' => "
                        <h2>It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.</h2>
                        <p>&nbsp;</p>
                        
                        <p>What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.</p>
                        
                        <p>&nbsp;</p>
                        
                        <p>A collection of textile samples lay spread out on the table and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p>
                        
                        <p>What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.</p>
                    "
            ];
            $page->template = 'about';
            $page->name = 'About';
            $page->slug = 'about';
            $page->save();
        }

        if (Page::whereSlug('contact')->count() < 1) {
            $page = new Page([
                'title' => [
                    'ru' => 'Контакты',
                    'en' => 'Contact'
                ],
                'content' => [
                    'ru' => "
                        <p>1444 S. Alameda Street Los Angeles, California 90021</p>

                        <p><a href=\"hi@gorge.com\">hi@gorge.com</a></p>
                        
                        <p>0800 123 456789</p>
                    ",
                    'en' => "
                        <p>1444 S. Alameda Street Los Angeles, California 90021</p>

                        <p><a href=\"hi@gorge.com\">hi@gorge.com</a></p>
                        
                        <p>0800 123 456789</p>
                    "
                ],
                'template' => 'contact',
                'name' => 'Contact',
                'slug' => 'contact'
            ]);

            $page->save();
        }

        if (Page::whereSlug('blog')->count() < 1) {
            $page = new Page([
                'title' => [
                    'ru' => 'Блог',
                    'en' => 'Blof'
                ],
                'template' => 'service',
                'name' => 'Blog',
                'slug' => 'blog'
            ]);

            $page->save();
        }

        if (Page::whereSlug('portfolio')->count() < 1) {
            $page = new Page([
                'title' => [
                    'ru' => 'Портфолио',
                    'en' => 'Portfolio'
                ],
                'template' => 'service',
                'name' => 'Portfolio',
                'slug' => 'portfolio'
            ]);

            $page->save();
        }

    }
}
