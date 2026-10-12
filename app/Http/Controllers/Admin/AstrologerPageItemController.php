<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\AstrologerPage;
use App\Models\AstrologerPageItem;

class AstrologerPageItemController extends Controller
{
    // Chat / Talk page ke cards, steps, topics, tabs aur FAQs — sab isi ek controller se
    public function index(Request $request, $page, $section)
    {
        $search = $request->query('search');

        $items = AstrologerPageItem::where('page_slug', $page)
            ->where('section', $section)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view($this->viewFolder($page, $section) . '.index', compact('items', 'search'));
    }

    public function create($page, $section)
    {
        $item = null;
        return view($this->viewFolder($page, $section) . '.create', compact('item'));
    }

    public function store(Request $request, $page, $section)
    {
        AstrologerPageItem::create($this->validated($request, $section) + [
            'page_slug' => $page,
            'section'   => $section,
        ]);

        return redirect()->route('admin.astrologer_page.items.index', [$page, $section])->with('success', 'Record created successfully.');
    }

    public function edit($page, $section, $id)
    {
        $item = $this->find($page, $section, $id);
        return view($this->viewFolder($page, $section) . '.create', compact('item'));
    }

    public function update(Request $request, $page, $section, $id)
    {
        $item = $this->find($page, $section, $id);
        $item->update($this->validated($request, $section));

        return redirect()->route('admin.astrologer_page.items.index', [$page, $section])->with('success', 'Record updated successfully.');
    }

    public function delete($page, $section, $id)
    {
        $item = $this->find($page, $section, $id);
        $item->delete();

        return redirect()->route('admin.astrologer_page.items.index', [$page, $section])->with('success', 'Record deleted successfully.');
    }

    private function find($page, $section, $id): AstrologerPageItem
    {
        return AstrologerPageItem::where('page_slug', $page)->where('section', $section)->findOrFail($id);
    }

    // Jaise: admin.chat_with_astrologer.faqs ya admin.talk_to_astrologer.why_cards
    private function viewFolder($page, $section): string
    {
        return 'admin.' . AstrologerPage::VIEW_FOLDERS[$page] . '.' . AstrologerPageItem::SECTIONS[$section]['folder'];
    }

    private function validated(Request $request, $section): array
    {
        $config = AstrologerPageItem::SECTIONS[$section];

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'heading'     => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'icon'        => [isset($config['icon']) ? 'required' : 'nullable', Rule::in(array_keys(config('home_icons')))],
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        return [
            'title'       => $validated['title'],
            'heading'     => isset($config['heading']) ? ($validated['heading'] ?? null) : null,
            'description' => isset($config['description']) ? strip_tags($validated['description'] ?? '', AstrologerPage::ALLOWED_TAGS) : null,
            'icon'        => isset($config['icon']) ? $validated['icon'] : null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active'),
        ];
    }
}
