<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoveCalculatorContent;

class LoveCalculatorContentController extends Controller
{
    // Love calculator page: hero, form heading, Jodit content, section headings
    public function edit()
    {
        $content = LoveCalculatorContent::current();
        return view('admin.love_calculator.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title'       => 'nullable|string|max:255',
            'breadcrumb_label' => 'nullable|string|max:100',
            'hero_title'       => 'required|string|max:255',
            'hero_highlight'   => 'nullable|string|max:255',
            'hero_intro'       => 'nullable|string',
            'hero_more'        => 'nullable|string',
            'form_title'       => 'nullable|string|max:255',
            'form_highlight'   => 'nullable|string|max:255',
            'main_content'     => 'nullable|string',
            'extra_content'    => 'nullable|string',
            'faq_subtitle'     => 'nullable|string|max:255',
            'faq_title'        => 'nullable|string|max:255',
        ]);

        foreach (['main_content', 'extra_content'] as $field) {
            $validated[$field] = LoveCalculatorContent::cleanHtml($validated[$field] ?? '');
        }

        // FAQ heading mein sirf highlight (span) aur line break chalega
        $validated['faq_title'] = strip_tags($validated['faq_title'] ?? '', '<span><br>');

        LoveCalculatorContent::current()->fill($validated)->save();

        return redirect()->route('admin.love_calculator.content.edit')->with('success', 'Page content updated successfully.');
    }

    // Love report page: banner aur experts heading
    public function reportEdit()
    {
        $content = LoveCalculatorContent::current();
        return view('admin.love_calculator.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $validated = $request->validate([
            'report_meta_title'    => 'nullable|string|max:255',
            'report_banner_tag'    => 'nullable|string|max:100',
            'report_banner_title'  => 'nullable|string|max:255',
            'report_banner_text'   => 'nullable|string',
            'report_banner_button' => 'nullable|string|max:100',
            'report_experts_title' => 'nullable|string|max:255',
        ]);

        LoveCalculatorContent::current()->fill($validated)->save();

        return redirect()->route('admin.love_calculator.report.edit')->with('success', 'Report page updated successfully.');
    }
}
