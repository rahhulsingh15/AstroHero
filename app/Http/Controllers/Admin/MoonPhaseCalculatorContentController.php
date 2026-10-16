<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoonPhaseCalculatorContent;
use App\Models\MoonPhaseReportContent;

class MoonPhaseCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = MoonPhaseCalculatorContent::first();
        return view('admin.moon_phase.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = MoonPhaseCalculatorContent::first();
        if (!$content) {
            $content = new MoonPhaseCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Moon Phase page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = MoonPhaseReportContent::first();
        return view('admin.moon_phase.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = MoonPhaseReportContent::first();
        if (!$content) {
            $content = new MoonPhaseReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.moon-phase-calculator.report.edit')->with('success', 'Moon Phase report page updated successfully.');
    }
}
