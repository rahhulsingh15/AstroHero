<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // "Chat with Astrologers" aur "Talk to Astrologers" pages ka single content (har page ki ek row)
        Schema::create('astrologer_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();                     // chat | talk

            // Hero (top banner)
            $table->string('breadcrumb_label')->nullable();
            $table->string('hero_title');
            $table->text('hero_description')->nullable();
            $table->string('hero_astrologer_name')->nullable();   // right side widget
            $table->string('hero_astrologer_image')->nullable();
            $table->string('hero_status_text')->nullable();       // Calling / Typing
            $table->string('hero_pill_text')->nullable();         // talk: timer, chat: message bubble

            // Section headings
            $table->string('why_title')->nullable();
            $table->string('verify_title')->nullable();
            $table->string('verify_badge')->nullable();
            $table->string('connect_title')->nullable();
            $table->text('connect_description')->nullable();
            $table->string('topics_title')->nullable();
            $table->string('services_title')->nullable();
            $table->string('services_subtitle')->nullable();

            $table->timestamps();
        });

        // Dono pages ki repeat hone wali cheezein: cards, steps, topics, tabs, FAQs
        Schema::create('astrologer_page_items', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug');                          // chat | talk
            $table->string('section');                            // feature | verify_step | topic | service_tab | faq
            $table->string('title');
            $table->string('heading')->nullable();                // sirf service_tab: pane ki heading
            $table->text('description')->nullable();
            $table->string('icon')->nullable();                   // sirf feature: config/home_icons.php ki key
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->index(['page_slug', 'section']);
        });

        // Jo content pehle dono pages par static likha tha, wahi shuruaati data
        $now = now();

        foreach ($this->defaultContent() as $slug => $content) {
            DB::table('astrologer_pages')->insert($content['page'] + ['created_at' => $now, 'updated_at' => $now]);

            foreach ($content['items'] as $i => $item) {
                DB::table('astrologer_page_items')->insert($item + [
                    'page_slug' => $slug, 'sort_order' => $i + 1, 'is_active' => 1,
                    'created_at' => $now, 'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('astrologer_page_items');
        Schema::dropIfExists('astrologer_pages');
    }

    private function defaultContent(): array
    {
        return [
          'chat' => [
            'page' => [
              'slug' => 'chat',
              'breadcrumb_label' => 'CHAT WITH ASTROLOGERS',
              'hero_title' => 'Chat with Astrologer',
              'hero_description' => 'Chat with an astrologer to get instant solutions to all your astrology needs. Be it personal life issues or professional life challenges, Astrotalk has got you covered. Avail <strong>24*7</strong> online chat service from the comfort of your house, provided by over <strong>48,000+</strong> expert astrologers. What\'s more, all your information will be kept confidential. Try now!',
              'why_title' => 'Why AstroHero?',
              'verify_title' => 'How we verify astrologers',
              'verify_badge' => 'Our 4-Step Process',
              'connect_title' => 'Instantly Connect With Top Astrologers',
              'topics_title' => 'POPULAR TOPICS',
              'services_title' => 'Explore AstroHero Services',
              'services_subtitle' => 'Everything you need to know about chatting with astrologers online.',
              'connect_description' => 'AstroHero brings the wisdom of Vedic astrology, Tarot reading, Numerology, and Vastu experts directly to your fingertips. Filter our curated list of professionals by expertise, language, or ratings to find the perfect match. Engage in a secure, 1-on-1 private chat to receive clear, actionable insights for your life\'s biggest questions.' . "\n\n" . 'Experience our premium service risk-free with your first chat completely on us! There are no hidden subscription fees—you simply pay for the minutes you use. If you aren\'t fully satisfied, you can seamlessly switch to another expert, and our 24-hour refund policy protects your peace of mind.',
              'hero_astrologer_name' => 'Sarvika Tiwari',
              'hero_status_text' => 'Typing',
              'hero_pill_text' => 'Namaste! How can I help you today?',
            ],
            'items' => [
              [
                'section' => 'feature',
                'title' => '100% Genuine',
                'heading' => null,
                'description' => 'Only verified experts with a proven track record. Trusted for over <strong>2 Million+</strong> consultations worldwide.',
                'icon' => 'star',
              ],
              [
                'section' => 'feature',
                'title' => 'Master Astrologers',
                'heading' => null,
                'description' => 'Selected through a strict <strong>4-step interview process</strong> to ensure accurate predictions every single time.',
                'icon' => 'graduation',
              ],
              [
                'section' => 'feature',
                'title' => 'First Chat Free',
                'heading' => null,
                'description' => 'Talk to our best experts for free. Get 100% secure, private, and <strong>confidential guidance</strong> anytime.',
                'icon' => 'check-circle',
              ],
              [
                'section' => 'verify_step',
                'title' => 'Background & KYC Checks',
                'heading' => null,
                'description' => 'We strictly verify government documents, real identity, and address before any astrologer is considered.',
                'icon' => null,
              ],
              [
                'section' => 'verify_step',
                'title' => 'Certification Review',
                'heading' => null,
                'description' => 'Astrological degrees, authentic lineage proof, and years of valid experience are thoroughly evaluated.',
                'icon' => null,
              ],
              [
                'section' => 'verify_step',
                'title' => 'Live Assessment Panel',
                'heading' => null,
                'description' => 'Candidates face a tough, real-time consultation test conducted by our in-house veteran astrologers.',
                'icon' => null,
              ],
              [
                'section' => 'verify_step',
                'title' => 'Quality Monitoring',
                'heading' => null,
                'description' => 'Approved experts undergo a strict trial period where consultations are continuously audited for accuracy.',
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Finding true love & soulmate compatibility',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Perfect timing for marriage & Kundli analysis',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Navigating career shifts & promotion timelines',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Wealth creation & strategic business investments',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Resolving family conflicts & Vastu corrections',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Effective everyday remedies & spiritual healing',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'Why Chat Online?',
                'heading' => 'Why choose online astrology chat over a phone call?',
                'description' => 'Free chat consultation provides a level of ease that many people don\'t find in phone calls. You can chat with an astrologer discreetly from the comfort of your house or even at your workplace without the fear of being overheard. What\'s more is that you get to keep a written record of all your predictions and remedies that you can revisit whenever you want. It is a stress-free private astrology consultation option for those with speaking difficulties or people trying to avoid background noise.',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'Love & Relationship',
                'heading' => 'Chat With An Astrologer For Love And Relationship',
                'description' => 'Chat with an astrologer for love advice, relationship guidance, and to find the \'perfect one.\' Restore harmony in your relationship with free chat. Whether you are planning to tie the knot, avail Kundli Matching chat to find your life partner, or check compatibility with just one chat with an expert astrologer.',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'Career & Finance',
                'heading' => 'Chat With An Astrologer For Career And Finance',
                'description' => 'Career astrology chat can help you out of a professional rut. Chat now and find the right time to start a new job or business, or know the exact time of promotion. Confused about where to invest your money or struggling to save up for the future? Financial astrology chat is all you need. Start chat now!',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'How To Start?',
                'heading' => 'How To Chat With An Astrologer On AstroHero?',
                'description' => 'Chat with an astrologer online for quick solutions to your problems. How? In four simple steps, and in under a minute, you can set up your account and start chatting:' . "\n\n" . '<ul><li>Sign up or log in to your account.</li><li>Browse verified astrologers by expertise, rating, or language.</li><li>Select your astrologer and start your free consultation.</li><li>Get a personalized consultation and save it for reference.</li></ul>',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'India\'s #1 Platform',
                'heading' => 'Why AstroHero Is India\'s #1 Platform',
                'description' => 'With thousands of verified astrologers on the platform, we are committed to providing top-notch services. All astrologers go through a rigorous screening process. Our chat option is available 24*7 in multiple languages, ensuring you always find the right expert without language barriers. We provide end-to-end encrypted, 100% confidential chat support.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'Is my first astrology chat session completely free?',
                'heading' => null,
                'description' => 'Yes! As a new user on AstroHero, you get a complimentary first chat session. You can connect with our premium astrologers instantly to experience our guidance without any upfront payment.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'How do I know if an astrologer is genuine?',
                'heading' => null,
                'description' => 'Every astrologer on our platform goes through a strict 4-step verification process. We conduct thorough background checks and live panel interviews to ensure you only speak with authentic, highly qualified experts.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'Are chat consultations as effective as phone calls?',
                'heading' => null,
                'description' => 'Absolutely. Chat sessions offer the exact same level of accuracy as calls. In fact, they provide more privacy and give you a written record of all predictions and remedies that you can refer back to anytime.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'Will I receive specific remedies during the chat?',
                'heading' => null,
                'description' => 'Yes, our astrologers provide highly personalized and practical remedies—such as specific gemstone advice, powerful mantras, and easy daily rituals—tailored precisely to your unique birth chart.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'What details do I need to provide for a consultation?',
                'heading' => null,
                'description' => 'For the most accurate reading, you simply need to share your exact date of birth, time of birth, and place of birth. Our experts will use these details to generate your Kundli instantly and answer your queries.',
                'icon' => null,
              ],
            ],
          ],
          'talk' => [
            'page' => [
              'slug' => 'talk',
              'breadcrumb_label' => 'TALK TO ASTROLOGERS',
              'hero_title' => 'Talk to Astrologers Online',
              'hero_description' => 'Talk to astrologer online to get detailed and accurate guidance for every issue in life. This includes love, marriage, finances, health, and even education-related problems. The <strong>24*7</strong> online consultation service by AstroHero will help you relish your life by guiding you through every challenge and hurdle. With over <strong>48,000+</strong> verified astrologers that provide personalised solutions, you can ask any questions that come to your mind. Try now!',
              'why_title' => 'Why AstroHero?',
              'verify_title' => 'How we verify astrologers',
              'verify_badge' => 'Our 4-Step Process',
              'connect_title' => 'Instantly Connect With Top Astrologers',
              'topics_title' => 'POPULAR TOPICS',
              'services_title' => 'Explore AstroHero Services',
              'services_subtitle' => 'Everything you need to know about calling astrologers online.',
              'connect_description' => 'AstroHero brings the wisdom of Vedic astrology, Tarot reading, Numerology, and Vastu experts directly to your fingertips. Filter our curated list of professionals by expertise, language, or ratings to find the perfect match. Engage in a secure, 1-on-1 private call to receive clear, actionable insights for your life\'s biggest questions.' . "\n\n" . 'Experience our premium service risk-free with your first call completely on us! There are no hidden subscription fees—you simply pay for the minutes you use. If you aren\'t fully satisfied, you can seamlessly switch to another expert, and our 24-hour refund policy protects your peace of mind.',
              'hero_astrologer_name' => 'Sarvika Tiwari',
              'hero_status_text' => 'Calling',
              'hero_pill_text' => '06:54',
            ],
            'items' => [
              [
                'section' => 'feature',
                'title' => 'Verified',
                'heading' => null,
                'description' => 'Real astrologers trusted by <strong>5Cr+</strong> users across India and <strong>60+</strong> countries.',
                'icon' => 'star',
              ],
              [
                'section' => 'feature',
                'title' => 'Experienced',
                'heading' => null,
                'description' => 'Every astrologer clears a rigorous <strong>4-step verification</strong> before taking a single call.',
                'icon' => 'graduation',
              ],
              [
                'section' => 'feature',
                'title' => 'Trusted',
                'heading' => null,
                'description' => 'Your first call is free. Not satisfied? Switch to another astrologer anytime.',
                'icon' => 'check-circle',
              ],
              [
                'section' => 'verify_step',
                'title' => 'Background & KYC Checks',
                'heading' => null,
                'description' => 'We strictly verify government documents, real identity, and address before any astrologer is considered.',
                'icon' => null,
              ],
              [
                'section' => 'verify_step',
                'title' => 'Certification Review',
                'heading' => null,
                'description' => 'Astrological degrees, authentic lineage proof, and years of valid experience are thoroughly evaluated.',
                'icon' => null,
              ],
              [
                'section' => 'verify_step',
                'title' => 'Live Assessment Panel',
                'heading' => null,
                'description' => 'Candidates face a tough, real-time consultation test conducted by our in-house veteran astrologers.',
                'icon' => null,
              ],
              [
                'section' => 'verify_step',
                'title' => 'Quality Monitoring',
                'heading' => null,
                'description' => 'Approved experts undergo a strict trial period where consultations are continuously audited for accuracy.',
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Finding true love & soulmate compatibility',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Perfect timing for marriage & Kundli analysis',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Navigating career shifts & promotion timelines',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Wealth creation & strategic business investments',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Resolving family conflicts & Vastu corrections',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'topic',
                'title' => 'Effective everyday remedies & spiritual healing',
                'heading' => null,
                'description' => null,
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'Why Call Online?',
                'heading' => 'Why choose an online astrology call over a physical meeting?',
                'description' => 'Free call consultation provides a level of ease that many people don\'t find elsewhere. You can call an astrologer discreetly from the comfort of your house or even at your workplace. What\'s more is that you get to keep an audio record of all your predictions and remedies that you can revisit whenever you want. It is a stress-free private astrology consultation option.',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'Love & Relationship',
                'heading' => 'Call An Astrologer For Love And Relationship',
                'description' => 'Call an astrologer for love advice, relationship guidance, and to find the \'perfect one.\' Restore harmony in your relationship with a free call. Whether you are planning to tie the knot, avail Kundli Matching on a call to find your life partner, or check compatibility with just one call with an expert astrologer.',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'Career & Finance',
                'heading' => 'Call An Astrologer For Career And Finance',
                'description' => 'Career astrology call can help you out of a professional rut. Call now and find the right time to start a new job or business, or know the exact time of promotion. Confused about where to invest your money or struggling to save up for the future? Financial astrology on call is all you need. Start calling now!',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'How To Start?',
                'heading' => 'How To Call An Astrologer On AstroHero?',
                'description' => 'Call an astrologer online for quick solutions to your problems. How? In four simple steps, and in under a minute, you can set up your account and start calling:' . "\n\n" . '<ul><li>Sign up or log in to your account.</li><li>Browse verified astrologers by expertise, rating, or language.</li><li>Select your astrologer and start your free consultation.</li><li>Get a personalized consultation and save it for reference.</li></ul>',
                'icon' => null,
              ],
              [
                'section' => 'service_tab',
                'title' => 'India\'s #1 Platform',
                'heading' => 'Why AstroHero Is India\'s #1 Platform',
                'description' => 'With thousands of verified astrologers on the platform, we are committed to providing top-notch services. All astrologers go through a rigorous screening process. Our calling option is available 24*7 in multiple languages, ensuring you always find the right expert without language barriers. We provide end-to-end encrypted, 100% confidential call support.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'Is my first astrology call session completely free?',
                'heading' => null,
                'description' => 'Yes! As a new user on AstroHero, you get a complimentary first call session. You can connect with our premium astrologers instantly to experience our guidance without any upfront payment.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'How do I know if an astrologer is genuine?',
                'heading' => null,
                'description' => 'Every astrologer on our platform goes through a strict 4-step verification process. We conduct thorough background checks and live panel interviews to ensure you only speak with authentic, highly qualified experts.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'Are online call consultations as effective as physical meetings?',
                'heading' => null,
                'description' => 'Absolutely. Online call sessions offer the exact same level of accuracy as face-to-face meetings. In fact, they provide more privacy and give you the flexibility to get predictions and remedies that you can refer back to anytime.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'Will I receive specific remedies during the call?',
                'heading' => null,
                'description' => 'Yes, our astrologers provide highly personalized and practical remedies—such as specific gemstone advice, powerful mantras, and easy daily rituals—tailored precisely to your unique birth chart.',
                'icon' => null,
              ],
              [
                'section' => 'faq',
                'title' => 'What details do I need to provide for a consultation?',
                'heading' => null,
                'description' => 'For the most accurate reading, you simply need to share your exact date of birth, time of birth, and place of birth. Our experts will use these details to generate your Kundli instantly and answer your queries.',
                'icon' => null,
              ],
            ],
          ],
        ];
    }
};
