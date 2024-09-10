<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\QuoteItem
 *
 * @property-read \App\Models\Product $product
 * @property-read int|null $quote_item_tax_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|QuoteItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuoteItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuoteItem query()
 *
 * @mixin \Eloquent
 */
class QuoteItem extends Model
{
    use HasFactory;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'product_id' => 'required',
        'product_name' => 'required',
        'quantity'   => 'required|integer',
        'price'      => 'required|regex:/^\d+(\.\d{1,2})?$/',
        'unit'      => 'required',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $messages = [
        'product_name.required' => 'The product field is required',
        'unit.required' => 'The unit field is required',
    ];

    protected $table = 'quote_items';

    public $fillable = [
        'quote_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'total',
        'unit',
    ];

    protected $casts = [
        'quote_id' => 'integer',
        'product_id' => 'integer',
        'product_name' => 'string',
        'unit' => 'string',
        'quantity' => 'integer',
        'price' => 'double',
        'total' => 'double',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
