<?php

namespace TypiCMS\Modules\Orders\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Order extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Orders\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'user_id',
        'price',
        'price_final',
        'paid',
        'image',
        'status',
        'title',
        'slug',
        'summary',
        'body',
        'payment_status',
        'transaction_id',
        'ref_number',
        'options'
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = [
        'image',
    ];

    /**
     * An order has many products.
     *
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('TypiCMS\Modules\Products\Models\Product', 'order_products')->withPivot('quantity', 'options');
    }

    public function orderProducts() {
        return $this->hasMany('TypiCMS\Modules\Orders\Models\OrderProduct');
    }

    public function user() {
        return $this->belongsTo('TypiCMS\Modules\Users\Models\User');
    }

    public function payments() {
        return $this->hasMany('TypiCMS\Modules\Orders\Models\OrderPayment');
    }

    public static function countOrderWithInsurances() {
        $q = "
                SELECT COUNT(*) as orders FROM typicms_orders as o
                JOIN typicms_order_products as op ON o.id = op.order_id
                JOIN typicms_products as p ON p.id = op.product_id
                  AND ( p.category_id = " . CATEGORY_GADGET_INSURANCE . " OR p.category_id = " . CATEGORY_XS_COVER . " )
            ";
        return DB::select($q)[0]->orders*7+B1G1;
    }

}
