<?php

namespace TypiCMS\Modules\Insuranceblocks\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class InsuranceblockFile extends Base {

    public static $MAX_FILE_SIZE_IN_MB = 5;

    public static $insurance_block_rules_valid_files_extensions = '.pdf';

    protected $table = 'insuranceblocks_files';

    protected $fillable = [
        'insuranceblock_id',
        'file'
    ];

    /**
     * @return string
     */
    public function getFileName(){
        return basename(substr($this->file, (strpos($this->file, '_') + 1), strlen($this->file)), "." . (pathinfo($this->file, PATHINFO_EXTENSION)));
    }

    /**
     * @return string
     */
    public function getFileUrl() {
        return $this->file ? (env('INSURANCE_BLOCKS_FILE_UPLOAD_PATH') . $this->insuranceblock_id . '/' . $this->file) : '';
    }
}
