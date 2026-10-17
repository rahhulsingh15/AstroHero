<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransitChartCalculatorContent;
use App\Models\TransitChartReportContent;

class TransitChartCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = TransitChartCalculatorContent::first();
        return view('admin.transit_chart.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = TransitChartCalculatorContent::first();
        if (!$content) {
            $content = new TransitChartCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Transit Chart page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = TransitChartReportContent::first();
        return view('admin.transit_chart.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = TransitChartReportContent::first();
        if (!$content) {
            $content = new TransitChartReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.transit-chart-calculator.report.edit')->with('success', 'Transit Chart report page updated successfully.');
    }
}
