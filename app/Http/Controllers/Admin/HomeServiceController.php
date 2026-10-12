<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\HomeService;

class HomeServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $services = HomeService::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('slider_row')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.home_page.home_service.index', compact('services', 'search'));
    }

    public function create()
    {
        $service = null;
        return view('admin.home_page.home_service.create', compact('service'));
    }

    public function store(Request $request)
    {
        HomeService::create($this->validated($request));

        return redirect()->route('admin.home_service.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = HomeService::findOrFail($id);
        return view('admin.home_page.home_service.create', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = HomeService::findOrFail($id);
        $service->update($this->validated($request));

        return redirect()->route('admin.home_service.index')->with('success', 'Service updated successfully.');
    }

    public function delete($id)
    {
        $service = HomeService::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.home_service.index')->with('success', 'Service deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'nullable|string|max:150',
            'link'        => 'nullable|string|max:255',
            'icon'        => ['required', Rule::in(array_keys(config('home_icons')))],
            'slider_row'  => 'required|in:1,2',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
