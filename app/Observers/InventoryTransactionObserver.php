<?php

namespace App\Observers;

use App\Models\InventoryTransaction;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Notification;

class InventoryTransactionObserver
{
    /**
     * Handle the InventoryTransaction "created" event.
     */
    public function created(InventoryTransaction $inventoryTransaction): void
{
    $product = $inventoryTransaction->product;

    if ($inventoryTransaction->type === 'stock_in' || $inventoryTransaction->type === 'adjustment') {
        $product->quantity += $inventoryTransaction->quantity;
    } elseif ($inventoryTransaction->type === 'stock_out') {
        if ($product->quantity < $inventoryTransaction->quantity) {
            throw new \Exception('Insufficient stock available for this transaction.');
        }
        $product->quantity -= $inventoryTransaction->quantity;
    }

    $product->save();

    // Check for low stock alert
    if ($product->isLowStock()) {
        $users = User::all(); // Or filter for admin/managers if preferred
        Notification::send($users, new LowStockNotification($product));
    }
}
    /**
     * Handle the InventoryTransaction "updated" event.
     */
    public function updated(InventoryTransaction $inventoryTransaction): void
    {
        //
    }

    /**
     * Handle the InventoryTransaction "deleted" event.
     */
    public function deleted(InventoryTransaction $inventoryTransaction): void
    {
        //
    }

    /**
     * Handle the InventoryTransaction "restored" event.
     */
    public function restored(InventoryTransaction $inventoryTransaction): void
    {
        //
    }

    /**
     * Handle the InventoryTransaction "force deleted" event.
     */
    public function forceDeleted(InventoryTransaction $inventoryTransaction): void
    {
        //
    }
}
