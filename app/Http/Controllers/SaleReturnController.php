<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleReturn;


class SaleReturnController extends Controller
{
    public function showReturnForm($saleId)
{
    $sale = \App\Models\Sale::with('items.batch.accessory')->findOrFail($saleId);
    return view('sales.return_form', compact('sale'));
}

public function processReturn(Request $request, $saleId)
{
    $sale = \App\Models\Sale::with('items')->findOrFail($saleId);

    $returnQty = $request->input('return_qty', []);
    $hasReturn = false;

    \DB::beginTransaction();
    try {
        foreach ($sale->items as $item) {
            $qty = isset($returnQty[$item->id]) ? intval($returnQty[$item->id]) : 0;
            if ($qty > 0 && $qty <= $item->quantity) {
                $hasReturn = true;

                // Update stock
                $batch = $item->batch;
                $batch->qty_remaining += $qty;
                $batch->save();

                // Log the return in a new SaleReturn table
                \App\Models\SaleReturn::create([
                    'sale_id' => $sale->id,
                    'sale_item_id' => $item->id,
                    'quantity' => $qty,
                    'returned_at' => now(),
                    'returned_by' => auth()->id(),
                ]);
            }
        }

        \DB::commit();

        if ($hasReturn) {
            return redirect()->route('sales.index')->with('success', 'Return processed successfully!');
        } else {
            return back()->with('danger', 'No items selected for return.');
        }
    } catch (\Exception $e) {
        \DB::rollBack();
        return back()->with('danger', 'Error processing return: ' . $e->getMessage());
    }
}


}
