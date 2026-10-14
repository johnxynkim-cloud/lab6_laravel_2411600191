<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function transactions() {
    return $this->hasMany(InventoryTransaction::class);
}
    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'quantity',
        'reorder_level',
        'unit_price',
        'supplier'
    ];


        public function isLowStock() {
    return $this->quantity <= $this->reorder_level;
}

    public function getStockStatusAttribute() {
    if ($this->quantity <= 0) return 'Out of Stock';
    if ($this->isLowStock()) return 'Low Stock';
    return 'In Stock';
}

    public function getStockStatusColorAttribute() {
    if ($this->quantity <= 0) return 'danger';
    if ($this->isLowStock()) return 'warning';
    return 'success';
}

}