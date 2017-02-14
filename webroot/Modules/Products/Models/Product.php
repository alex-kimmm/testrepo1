<?php

namespace TypiCMS\Modules\Products\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Product extends Base {
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Products\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'sku',
        'price',
        'featured',
        'options',
        'category_id',
        // Translatable columns
        'title',
        'slug',
        'status',
        'summary',
        'body',
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

    public static $product_rules_valid_files_extensions = '.jpg, .jpeg, .bmp, .png';


    public function category() {
        return $this->belongsTo('TypiCMS\Modules\Categories\Models\Category');
    }

    public function isInsurance() {
        return $this->category->isInsurance();
    }

    public function isGadgetInsurance(){
        return ($this->category_id == CATEGORY_GADGET_INSURANCE);
    }

    public function isXSCover(){
        return ($this->category_id == CATEGORY_XS_COVER);
    }

    public function isZhitProduct(){
        return ($this->category_id == CATEGORY_ZHIT);
    }

<<<<<<< HEAD
    public function getOptionsPdfDocuments(){
        $pdfDocuments = [];
        if($this->isInsurance()){
            try {
                $productOptions = \GuzzleHttp\json_decode($this->options,true);
                if(isset($productOptions['pdf_documents'])){
                    $pdfDocuments = $productOptions['pdf_documents'];
                }
            }
            catch(Exception $e) {
                $pdfDocuments = [];
            }
        }

        return $pdfDocuments;
    }

=======
>>>>>>> test
    /**
     * A slideshow has many colors.
     *
     * @return MorphToMany
     */
    public function colors() {
        return $this->morphToMany('TypiCMS\Modules\Colors\Models\Color', 'product_color', 'product_colors', 'product_id', 'color_id')
            ->withPivot('color_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * A product has many sizes.
     *
     * @return MorphToMany
     */
    public function sizes() {
        return $this->morphToMany('TypiCMS\Modules\Sizes\Models\Size', 'product_size', 'product_sizes', 'product_id', 'size_id')
            ->withPivot('size_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('TypiCMS\Modules\Products\Models\ProductImage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slideshowitems()
    {
        return $this->hasMany('TypiCMS\Modules\Slideshowitems\Models\Slideshowitem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claims() {
        return $this->hasMany('TypiCMS\Modules\Claims\Models\Claim');

    }

    /**
     * @param $productDirName
     * @param $imageSrc
     * @return string
     */
    public function getImageUrl() {
        return env('PRODUCT_IMAGE_UPLOAD_PATH')  . $this->image;
    }


    public function getSeoUrl(){
        if($this->category_id == CATEGORY_GADGET_INSURANCE)
            $category = 'gadget-cover';
        elseif($this->category_id == CATEGORY_XS_COVER)
            $category = 'xs-cover';
        else
            return 'javascript:void(0)';

        return ROOT_URL_INSURANCE . '/' . $category . '/get-cover' ;
    }

    public function getFormattedPriceOptions(){
        try {
            $priceOptions = \GuzzleHttp\json_decode($this->options)->priceOptions;
        }
        catch(Exception $e) {
            $priceOptions = [];
        }
        $formatPriceOptions = [];
        foreach($priceOptions as $priceOption){
            $formatPriceOptions[$priceOption->attributeOptionID] = $priceOption->optionName;
        }
        return $formatPriceOptions;
    }

    public function getFormattedPrices(){
        try {
            $priceOptions = \GuzzleHttp\json_decode($this->options)->priceOptions;
        }
        catch(Exception $e) {
            $priceOptions = [];
        }
        $formatPrices = [];
        foreach($priceOptions as $priceOption){
            $formatPrices[$priceOption->attributeOptionID] = $priceOption->soldPricetoCustomer;
        }
        return $formatPrices;
    }

    public function getFormattedPriceForOptionId($attributeOptionID){
        $priceOptions = $this->getFormattedPrices();
        return (isset($priceOptions[$attributeOptionID]))? $priceOptions[$attributeOptionID] : 0;
    }

    public function getFormattedOptionNameForOptionId($attributeOptionID){
        $priceOptions = $this->getFormattedPriceOptions();
        return (isset($priceOptions[$attributeOptionID]))? $priceOptions[$attributeOptionID] : '';
    }

}
