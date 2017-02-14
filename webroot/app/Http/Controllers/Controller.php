<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private static $sharedInstance = null;

    public static function sharedInstance() {
        if(is_null(self::$sharedInstance)) {
            self::$sharedInstance = new self();
        }
        return self::$sharedInstance;
    }

    public function getSafeValue($data, $key, $defaultValue = ''){

        if(isset($data[$key])) {
            return (string) $data[$key];
        }
        else return $defaultValue;
    }

    public function getMissedItems($items){
        return 3 - $this->getRest($items, 3);
    }

    public function uploadFile($destinationPath, File $file) {
        if($destinationPath == "") {
            throw new Exception("Destination directory has not been supplied.");
        }

        if($destinationPath[0] != "/") {
            throw new Exception("Please set correct path");
        }

        $documentPath = app()->make('path.public') . $destinationPath;
        if(!is_dir($documentPath)){
            @mkdir($documentPath);
        }

        if (!is_writable($documentPath) || !file_exists($documentPath)) {
            throw new Exception("Destination directory does not exist or not writable");
        }

        $extension = $file->getClientOriginalExtension();
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $finalFileName = time() . '_' . $originalFileName . '.' . $extension;

        $file->move($documentPath, $finalFileName);

        return $finalFileName;
    }

    public static function globalUploadFile($destinationPath, File $file) {
        return self::sharedInstance()->uploadFile($destinationPath, $file);
    }

    public function getRest($items, $range){
        return count($items) % $range;
    }

    public function getLoggedInUser(){
        $user = null;
        if(Auth::check()){
            $user = Auth::user();
        }
        return $user;
    }
}
