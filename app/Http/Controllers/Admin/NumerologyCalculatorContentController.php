<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoveCalculatorContent;
use App\Models\NumerologyCalculatorContent;

class NumerologyCalculatorContentController extends Controller
{
    // Numerology calculator page: hero, form heading, promo, Jodit content, FAQ heading
    public function edit()
    {
        $content = NumerologyCalculatorContent::current();
        return view('admin.numerology_calculator.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title'       => 'nullable|string|max:255',
            'breadcrumb_label' => 'nullable|string|max:100',
            'hero_title'       => 'required|string|max:255',
            'hero_intro'       => 'nullable|string',
            'form_title'       => 'nullable|string|max:255',
            'promo_text'       => 'nullable|string|max:255',
            'main_content'     => 'nullable|string',
            'faq_subtitle'     => 'nullable|string|max:255',
            'faq_title'        => 'nullable|string|max:255',
        ]);

        // Jodit HTML ki safai love calculator wale rules se hi
        $validated['main_content'] = LoveCalculatorContent::cleanHtml($validated['main_content'] ?? '');

        // FAQ heading mein sirf highlight (span) aur line break chalega
        $validated['faq_title'] = strip_tags($validated['faq_title'] ?? '', '<span><br>');

        NumerologyCalculatorContent::current()->fill($validated)->save();

        return redirect()->route('admin.numerology_calculator.content.edit')->with('success', 'Page content updated successfully.');
    }

    // Numerology report page: banner aur neeche ka content
    public function reportEdit()
    {
        $content = NumerologyCalculatorContent::current();
        return view('admin.numerology_calculator.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $validated = $request->validate([
            'report_banner_title' => 'nullable|string|max:255',
            'report_banner_text'  => 'nullable|string|max:255',
            'report_content'      => 'nullable|string',
        ]);

        $validated['report_content'] = LoveCalculatorContent::cleanHtml($validated['report_content'] ?? '');

        NumerologyCalculatorContent::current()->fill($validated)->save();

        return redirect()->route('admin.numerology_calculator.report.edit')->with('success', 'Report page updated successfully.');
    }
}
