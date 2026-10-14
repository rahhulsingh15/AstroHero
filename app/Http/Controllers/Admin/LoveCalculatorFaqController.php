<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoveCalculatorContent;
use App\Models\LoveCalculatorFaq;

class LoveCalculatorFaqController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $faqs = LoveCalculatorFaq::query()
            ->when($search, function ($query, $search) {
                return $query->where('question', 'like', "%{$search}%");
            })
            ->orderBy('id')
            ->paginate(20);

        return view('admin.love_calculator.faqs.index', compact('faqs', 'search'));
    }

    public function create()
    {
        $faq = null;
        return view('admin.love_calculator.faqs.create', compact('faq'));
    }

    public function store(Request $request)
    {
        LoveCalculatorFaq::create($this->validated($request));

        return redirect()->route('admin.love_calculator.faq.index')->with('success', 'FAQ created successfully.');
    }

    public function edit($id)
    {
        $faq = LoveCalculatorFaq::findOrFail($id);
        return view('admin.love_calculator.faqs.create', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        LoveCalculatorFaq::findOrFail($id)->update($this->validated($request));

        return redirect()->route('admin.love_calculator.faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function delete($id)
    {
        LoveCalculatorFaq::findOrFail($id)->delete();

        return redirect()->route('admin.love_calculator.faq.index')->with('success', 'FAQ deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
        ]);

        $validated['answer'] = LoveCalculatorContent::cleanHtml($validated['answer']);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
