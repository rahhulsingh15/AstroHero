<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MangalDoshaCalculatorContent;
use App\Models\MangalDoshaReportContent;

class MangalDoshaCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = MangalDoshaCalculatorContent::first();
        return view('admin.mangal_dosha.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = MangalDoshaCalculatorContent::first();
        if (!$content) {
            $content = new MangalDoshaCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Mangal Dosha page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = MangalDoshaReportContent::first();
        return view('admin.mangal_dosha.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = MangalDoshaReportContent::first();
        if (!$content) {
            $content = new MangalDoshaReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.mangal-dosha-calculator.report.edit')->with('success', 'Mangal Dosha report page updated successfully.');
    }
}
