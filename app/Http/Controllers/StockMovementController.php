<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Models\ResourceItem;

class StockMovementController extends Controller
{
    public function index()
    {
        $stockMovements = StockMovement::with('resourceItem')->latest()->paginate(10);
        $resourceItems = ResourceItem::all(); // For dropdown in modal
        return view('stock_movements.index', compact('stockMovements','resourceItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'resource_item_id' => 'required|exists:resource_items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|numeric|min:0.01',
            'reference' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        StockMovement::create($validated);

        // Update ResourceItem stock
        $item = ResourceItem::find($validated['resource_item_id']);
        if ($validated['type'] === 'in') {
            $item->increment('current_stock', $validated['quantity']);
        } else {
            $item->decrement('current_stock', $validated['quantity']);
        }

        return redirect()->route('stock-movements.index')->with('success','Stock movement recorded.');
    }

    public function update(Request $request, StockMovement $stockMovement)
    {
        $validated = $request->validate([
            'resource_item_id' => 'required|exists:resource_items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|numeric|min:0.01',
            'reference' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        // Revert previous stock
        $oldItem = $stockMovement->resourceItem;
        if ($stockMovement->type === 'in') {
            $oldItem->decrement('current_stock', $stockMovement->quantity);
        } else {
            $oldItem->increment('current_stock', $stockMovement->quantity);
        }

        // Update movement
        $stockMovement->update($validated);

        // Apply new stock
        $newItem = ResourceItem::find($validated['resource_item_id']);
        if ($validated['type'] === 'in') {
            $newItem->increment('current_stock', $validated['quantity']);
        } else {
            $newItem->decrement('current_stock', $validated['quantity']);
        }

        return redirect()->route('stock-movements.index')->with('success','Stock movement updated.');
    }

    public function destroy(StockMovement $stockMovement)
    {
        // Revert stock
        $item = $stockMovement->resourceItem;
        if ($stockMovement->type === 'in') {
            $item->decrement('current_stock', $stockMovement->quantity);
        } else {
            $item->increment('current_stock', $stockMovement->quantity);
        }

        $stockMovement->delete();
        return redirect()->route('stock-movements.index')->with('success','Stock movement deleted.');
    }
}
