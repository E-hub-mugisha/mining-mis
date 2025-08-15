<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResourceItem;
use App\Models\Site;

class ResourceItemController extends Controller
{
    public function index()
    {
        $resourceItems = ResourceItem::with('site')->paginate(10);
        $sites = Site::all(); // for dropdown in modal
        return view('resource_items.index', compact('resourceItems', 'sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        ResourceItem::create($validated);

        return redirect()->route('resource_items.index')->with('success', 'Resource Item created.');
    }

    public function update(Request $request, ResourceItem $resourceItem)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $resourceItem->update($validated);

        return redirect()->route('resource_items.index')->with('success', 'Resource Item updated.');
    }

    public function destroy(ResourceItem $resourceItem)
    {
        $resourceItem->delete();
        return redirect()->route('resource_items.index')->with('success', 'Resource Item deleted.');
    }
}
