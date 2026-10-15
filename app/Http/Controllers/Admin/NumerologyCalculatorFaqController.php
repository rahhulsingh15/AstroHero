<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoveCalculatorContent;
use App\Models\NumerologyCalculatorFaq;

class NumerologyCalculatorFaqController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $faqs = NumerologyCalculatorFaq::query()
            ->when($search, function ($query, $search) {
                return $query->where('question', 'like', "%{$search}%");
            })
            ->orderBy('id')
            ->paginate(20);

        return view('admin.numerology_calculator.faqs.index', compact('faqs', 'search'));
    }

    public function create()
    {
        $faq = null;
        return view('admin.numerology_calculator.faqs.create', compact('faq'));
    }

    public function store(Request $request)
    {
        NumerologyCalculatorFaq::create($this->validated($request));

        return redirect()->route('admin.numerology_calculator.faq.index')->with('success', 'FAQ created successfully.');
    }

    public function edit($id)
    {
        $faq = NumerologyCalculatorFaq::findOrFail($id);
        return view('admin.numerology_calculator.faqs.create', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        NumerologyCalculatorFaq::findOrFail($id)->update($this->validated($request));

        return redirect()->route('admin.numerology_calculator.faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function delete($id)
    {
        NumerologyCalculatorFaq::findOrFail($id)->delete();

        return redirect()->route('admin.numerology_calculator.faq.index')->with('success', 'FAQ deleted successfully.');
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
