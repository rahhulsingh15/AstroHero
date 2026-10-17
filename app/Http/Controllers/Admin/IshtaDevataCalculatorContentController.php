<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IshtaDevataCalculatorContent;
use App\Models\IshtaDevataReportContent;

class IshtaDevataCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = IshtaDevataCalculatorContent::first();
        return view('admin.ishta_devata.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = IshtaDevataCalculatorContent::first();
        if (!$content) {
            $content = new IshtaDevataCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Ishta Devata page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = IshtaDevataReportContent::first();
        return view('admin.ishta_devata.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = IshtaDevataReportContent::first();
        if (!$content) {
            $content = new IshtaDevataReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.ishta-devata-calculator.report.edit')->with('success', 'Ishta Devata report page updated successfully.');
    }
}
