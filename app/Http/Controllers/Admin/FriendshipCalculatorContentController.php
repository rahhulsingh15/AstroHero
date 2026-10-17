<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FriendshipCalculatorContent;
use App\Models\FriendshipReportContent;

class FriendshipCalculatorContentController extends Controller
{
    public function edit()
    {
        $content = FriendshipCalculatorContent::first();
        return view('admin.friendship.page_content.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = FriendshipCalculatorContent::first();
        if (!$content) {
            $content = new FriendshipCalculatorContent();
        }

        $content->heading = $request->input('heading');
        $content->description = $request->input('description');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->back()->with('success', 'Friendship Calculator page content updated successfully.');
    }

    public function reportEdit()
    {
        $content = FriendshipReportContent::first();
        return view('admin.friendship.report_page.index', compact('content'));
    }

    public function reportUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'main_content' => 'nullable|string',
            'faq_content' => 'nullable|string',
        ]);

        $content = FriendshipReportContent::first();
        if (!$content) {
            $content = new FriendshipReportContent();
        }

        $content->heading = $request->input('heading');
        $content->main_content = $request->input('main_content');
        $content->faq_content = $request->input('faq_content');
        $content->save();

        return redirect()->route('admin.friendship-calculator.report.edit')->with('success', 'Friendship Calculator report page updated successfully.');
    }
}
