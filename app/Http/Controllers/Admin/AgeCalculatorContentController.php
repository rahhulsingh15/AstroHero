<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgeCalculatorContent;
use App\Models\AgeReportContent;

class AgeCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = AgeCalculatorContent::first();
        return view('admin.age.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = AgeCalculatorContent::first();
        if (!$content) {
            $content = new AgeCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Age Calculator page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = AgeReportContent::first();
        return view('admin.age.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = AgeReportContent::first();
        if (!$content) {
            $content = new AgeReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.age-calculator.report.edit')->with('success', 'Age Calculator report page updated successfully.');
    }
}
