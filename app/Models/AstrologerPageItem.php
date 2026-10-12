<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologerPageItem extends Model
{
    use HasFactory;

    protected $table = 'astrologer_page_items';

    /**
     * Page ke repeat hone wale sections.
     * 'folder' = admin views ka folder (admin/chat_with_astrologer/{folder}/index.blade.php).
     * heading / description / icon sirf un sections mein save hote hain jahan yahan unka label diya ho.
     */
    const SECTIONS = [
        'feature' => [
            'label'       => 'Why AstroHero Cards',
            'folder'      => 'why_cards',
            'singular'    => 'Card',
            'title'       => 'Card Title',
            'description' => 'Card Text',
            'icon'        => 'Icon',
        ],
        'verify_step' => [
            'label'       => 'How We Verify Steps',
            'folder'      => 'verify_steps',
            'singular'    => 'Step',
            'title'       => 'Step Title',
            'description' => 'Step Text',
        ],
        'topic' => [
            'label'    => 'Popular Topics',
            'folder'   => 'popular_topics',
            'singular' => 'Topic',
            'title'    => 'Topic',
        ],
        'service_tab' => [
            'label'       => 'Explore Services Tabs',
            'folder'      => 'service_tabs',
            'singular'    => 'Tab',
            'title'       => 'Tab Button Label',
            'heading'     => 'Content Heading',
            'description' => 'Content',
        ],
        'faq' => [
            'label'       => 'FAQs',
            'folder'      => 'faqs',
            'singular'    => 'FAQ',
            'title'       => 'Question',
            'description' => 'Answer',
        ],
    ];

    protected $fillable = [
        'page_slug',
        'section',
        'title',
        'heading',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];
}
