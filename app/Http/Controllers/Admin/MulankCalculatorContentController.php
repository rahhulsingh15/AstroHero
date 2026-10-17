<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MulankCalculatorContent;
use App\Models\MulankReportContent;

class MulankCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = MulankCalculatorContent::first();
        return view('admin.mulank.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = MulankCalculatorContent::first();
        if (!$content) {
            $content = new MulankCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Mulank page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = MulankReportContent::first();
        return view('admin.mulank.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = MulankReportContent::first();
        if (!$content) {
            $content = new MulankReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.mulank-calculator.report.edit')->with('success', 'Mulank report page updated successfully.');
    }
}
