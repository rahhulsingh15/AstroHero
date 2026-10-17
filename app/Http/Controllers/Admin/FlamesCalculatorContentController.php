<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlamesCalculatorContent;
use App\Models\FlamesReportContent;

class FlamesCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = FlamesCalculatorContent::first();
        return view('admin.flames.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = FlamesCalculatorContent::first();
        if (!$content) {
            $content = new FlamesCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'FLAMES page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = FlamesReportContent::first();
        return view('admin.flames.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = FlamesReportContent::first();
        if (!$content) {
            $content = new FlamesReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.flames-calculator.report.edit')->with('success', 'FLAMES report page updated successfully.');
    }
}
