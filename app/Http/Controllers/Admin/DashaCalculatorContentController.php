<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DashaCalculatorContent;
use App\Models\DashaReportContent;
use App\Models\LoveCalculatorContent;

class DashaCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = DashaCalculatorContent::first();
        return view('admin.dasha_calculator.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = DashaCalculatorContent::first();
        if (!$content) {
            $content = new DashaCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Content updated successfully.');
    }

    // Report page: alag table (DashaReportContent), content page jaisa
    public function reportEdit()
    {
        $content = DashaReportContent::first();
        return view('admin.dasha_calculator.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = DashaReportContent::first();
        if (!$content) {
            $content = new DashaReportContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = LoveCalculatorContent::cleanHtml($request->input('main_content'));
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.dasha-calculator.report.edit')->with('success', 'Dasha report page updated successfully.');
    }
}
