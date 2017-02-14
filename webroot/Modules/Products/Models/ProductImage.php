<?php

namespace TypiCMS\Modules\Products\Models;

use TypiCMS\Modules\Core\Models\Base;

class ProductImage extends Base {

    protected $table = 'product_images';

    protected $fillable = [
        'image',
        'product_id'
    ];

    public function getImageUrl() {
        return env('PRODUCT_IMAGE_UPLOAD_PATH')  . $this->product_id . '/' . $this->image;
    }
}
