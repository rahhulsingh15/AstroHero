<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RisingAscendantCalculatorContent;
use App\Models\RisingAscendantReportContent;
use App\Models\LoveCalculatorContent;

class RisingAscendantCalculatorContentController extends Controller
{
    public function edit()
    {
        $content =RisingAscendantCalculatorContent::first();
        return view('admin.rising_ascendant_calculator.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'main_content' => 'required|string',
            'faq_content' => 'required|string',
        ]);

        $content = RisingAscendantCalculatorContent::first();
        if (!$content) {
            $content = new RisingAscendantCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Rising Ascendant Calculator content updated successfully.');
    }

    // Report page: alag table (RisingAscendantReportContent), content page jaisa
    public function reportEdit()
    {
        $content = RisingAscendantReportContent::first();
        return view('admin.rising_ascendant_calculator.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = RisingAscendantReportContent::first();
        if (!$content) {
            $content = new RisingAscendantReportContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = LoveCalculatorContent::cleanHtml($request->input('main_content'));
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.rising-ascendant-calculator.report.edit')->with('success', 'Rising Ascendant report page updated successfully.');
    }
}
