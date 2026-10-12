<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AstrologerPage;

class AstrologerPageController extends Controller
{
    // Chat / Talk page ka hero aur section headings (har page ki ek hi row)
    public function edit($page)
    {
        $content = AstrologerPage::where('slug', $page)->first();

        // admin/chat_with_astrologer/hero_section/index.blade.php ya admin/talk_to_astrologer/hero_section/index.blade.php
        return view('admin.' . AstrologerPage::VIEW_FOLDERS[$page] . '.hero_section.index', compact('content'));
    }

    public function update(Request $request, $page)
    {
        $validated = $request->validate([
            'breadcrumb_label'     => 'nullable|string|max:100',
            'hero_title'           => 'required|string|max:255',
            'hero_description'     => 'nullable|string',
            'hero_astrologer_name' => 'nullable|string|max:100',
            'hero_status_text'     => 'nullable|string|max:50',
            'hero_pill_text'       => 'nullable|string|max:100',
            'hero_astrologer_image'=> 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'why_title'            => 'nullable|string|max:255',
            'verify_title'         => 'nullable|string|max:255',
            'verify_badge'         => 'nullable|string|max:100',
            'connect_title'        => 'nullable|string|max:255',
            'connect_description'  => 'nullable|string',
            'topics_title'         => 'nullable|string|max:100',
            'services_title'       => 'nullable|string|max:255',
            'services_subtitle'    => 'nullable|string|max:255',
        ]);

        foreach (['hero_description', 'connect_description'] as $field) {
            $validated[$field] = strip_tags($validated[$field] ?? '', AstrologerPage::ALLOWED_TAGS);
        }

        $content = AstrologerPage::firstOrNew(['slug' => $page]);

        unset($validated['hero_astrologer_image']);

        if ($request->hasFile('hero_astrologer_image')) {
            if ($content->hero_astrologer_image && file_exists(public_path($content->hero_astrologer_image))) {
                unlink(public_path($content->hero_astrologer_image));
            }

            $image_name = time() . '_' . $page . '.' . $request->hero_astrologer_image->extension();
            $request->hero_astrologer_image->move(public_path('uploads/astrologer_pages'), $image_name);
            $validated['hero_astrologer_image'] = 'uploads/astrologer_pages/' . $image_name;
        }

        $content->fill($validated)->save();

        return redirect()->route('admin.astrologer_page.edit', $page)->with('success', 'Page content updated successfully.');
    }
}
