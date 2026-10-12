<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;

class HeroSectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $heros = HeroSection::query()
            ->when($search, function ($query, $search) {
                return $query->where('heading', 'like', "%{$search}%")
                             ->orWhere('eyebrow_text', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.home_page.hero_section.index', compact('heros', 'search'));
    }

    public function create()
    {
        $hero = null;
        return view('admin.home_page.hero_section.create', compact('hero'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'eyebrow_text' => 'nullable|string|max:255',
            'heading'      => 'required|string',
            'lead_text'    => 'nullable|string',
            'btn1_title'   => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',
            'btn2_title'   => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',
            'stat1_value'  => 'nullable|string|max:50',
            'stat1_label'  => 'nullable|string|max:100',
            'stat2_value'  => 'nullable|string|max:50',
            'stat2_label'  => 'nullable|string|max:100',
            'stat3_value'  => 'nullable|string|max:50',
            'stat3_label'  => 'nullable|string|max:100',
            'match_score'  => 'nullable|integer|min:1|max:36',
        ]);

        $validated['is_active'] = 1;

        HeroSection::create($validated);

        return redirect()->route('admin.hero_section.index')->with('success', 'Hero section created successfully.');
    }

    public function edit($id)
    {
        $hero = HeroSection::findOrFail($id);
        return view('admin.home_page.hero_section.create', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = HeroSection::findOrFail($id);

        $validated = $request->validate([
            'eyebrow_text' => 'nullable|string|max:255',
            'heading'      => 'required|string',
            'lead_text'    => 'nullable|string',
            'btn1_title'   => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',
            'btn2_title'   => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',
            'stat1_value'  => 'nullable|string|max:50',
            'stat1_label'  => 'nullable|string|max:100',
            'stat2_value'  => 'nullable|string|max:50',
            'stat2_label'  => 'nullable|string|max:100',
            'stat3_value'  => 'nullable|string|max:50',
            'stat3_label'  => 'nullable|string|max:100',
            'match_score'  => 'nullable|integer|min:1|max:36',
        ]);

        $hero->update($validated);

        return redirect()->route('admin.hero_section.index')->with('success', 'Hero section updated successfully.');
    }

    public function delete($id)
    {
        $hero = HeroSection::findOrFail($id);
        $hero->delete();

        return redirect()->route('admin.hero_section.index')->with('success', 'Hero section deleted successfully.');
    }
}