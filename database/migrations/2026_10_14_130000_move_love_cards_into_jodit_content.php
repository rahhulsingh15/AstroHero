<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Love calculator: % cards aur tools cards ab alag sections nahi, Jodit content ka hi hissa hain.
 * Page Content ke 2 Jodit editors mein poora section aata hai.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $content = DB::table('love_calculator_contents')->first();

        if ($content) {
            $e = fn ($text) => e((string) $text);

            // 1. Pehla Jodit: main content + "What Does Your Love Percentage Say?" + 4 cards
            $cards = '';
            foreach (DB::table('love_calculator_bands')->orderByDesc('min_percent')->get() as $band) {
                $cards .= "\n<div class=\"p-card\">\n<div class=\"p-range\">{$e($band->range_label)}</div>\n"
                    . "<h4>{$e($band->title)}</h4>\n<p>{$e($band->card_text)}</p>\n</div>";
            }
            $main = trim((string) $content->main_content);
            if ($cards !== '') {
                $main .= "\n<h3>{$e($content->bands_title)}</h3>\n<div class=\"percentage-cards\">{$cards}\n</div>";
            }

            // 2. Doosra Jodit: zodiac table ... + "Other Compatibility Tools" + cards
            $tools = '';
            foreach (DB::table('love_calculator_tools')->where('is_active', 1)->orderBy('id')->get() as $tool) {
                // Relative link (jaise "kundli-matching"), taaki localhost subfolder aur live dono par chale
                $link = $tool->link ? ltrim($tool->link, '/') : '#';
                $tools .= "\n<a class=\"tool-card\" href=\"{$e($link)}\" style=\"text-decoration: none; color: inherit;\">\n"
                    . "<div class=\"t-icon\">{$e($tool->icon)}</div>\n"
                    . "<div>\n<h5>{$e($tool->title)}</h5>\n<p>{$e($tool->description)}</p>\n</div>\n</a>";
            }
            $extra = trim((string) $content->extra_content);
            if ($tools !== '') {
                $extra .= "\n<h3>{$e($content->tools_title)}</h3>\n<div class=\"tools-cards\">{$tools}\n</div>";
            }

            DB::table('love_calculator_contents')->where('id', $content->id)->update([
                'main_content'  => $main,
                'extra_content' => $extra,
            ]);
        }

        Schema::table('love_calculator_contents', function (Blueprint $table) {
            $table->dropColumn(['bands_title', 'tools_title']);
        });

        // Bands ab sirf report page ke result ke liye (title + report text)
        Schema::table('love_calculator_bands', function (Blueprint $table) {
            $table->dropColumn(['range_label', 'card_text']);
        });

        Schema::dropIfExists('love_calculator_tools');
    }

    /**
     * Reverse the migrations. (Columns/table wapas bante hain, data Jodit content mein hi rehta hai.)
     */
    public function down(): void
    {
        Schema::table('love_calculator_contents', function (Blueprint $table) {
            $table->string('bands_title')->nullable()->after('main_content');
            $table->string('tools_title')->nullable()->after('extra_content');
        });

        Schema::table('love_calculator_bands', function (Blueprint $table) {
            $table->string('range_label')->default('')->after('min_percent');
            $table->text('card_text')->nullable()->after('title');
        });

        Schema::create('love_calculator_tools', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }
};
