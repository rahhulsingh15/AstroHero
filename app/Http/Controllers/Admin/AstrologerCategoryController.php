<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\AstrologerCategory;

class AstrologerCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $categories = AstrologerCategory::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.home_page.astrologer_category.index', compact('categories', 'search'));
    }

    public function create()
    {
        $category = null;
        return view('admin.home_page.astrologer_category.create', compact('category'));
    }

    public function store(Request $request)
    {
        AstrologerCategory::create($this->validated($request));

        return redirect()->route('admin.astrologer_category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = AstrologerCategory::findOrFail($id);
        return view('admin.home_page.astrologer_category.create', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = AstrologerCategory::findOrFail($id);
        $category->update($this->validated($request));

        return redirect()->route('admin.astrologer_category.index')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = AstrologerCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.astrologer_category.index')->with('success', 'Category deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'astro_count' => 'nullable|string|max:100',
            'link'        => 'nullable|string|max:255',
            'icon'        => ['required', Rule::in(array_keys(config('home_icons')))],
            'color'       => ['required', Rule::in(array_keys(AstrologerCategory::COLORS))],
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
