<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Inacho\CreditCard;
use TypiCMS\Modules\Categories\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('notRootCategory', function($attribute, $value, $parameters, $validator) {
            $category = Category::find($value);
            return (!is_null($category) && !$category->isRootCategory());
        });

        Validator::extend('postCodeFromEU', function($attribute, $postcodeValue, $parameters, $validator) {
            $notEUPostCodePrefixes = ['GY','IM','JE'];
            return !startsWithOneOfPrefixes(preg_replace('/\s+/', '', $postcodeValue), $notEUPostCodePrefixes);
        });

        //Insurance product can not be created from backend, only loaded from IWEP API
        Validator::extend('notInsuranceCategory', function($attribute, $value, $parameters, $validator) {
            $category = Category::find($value);
            return (!is_null($category) && !$category->isInsurance() );
        });

        Validator::extend('completeName', function($attribute, $value, $parameters, $validator) {
            $nameParts = explode(" ", $value);
            return  ( count($nameParts) >= 2 && !empty($nameParts[0]) && !empty($nameParts[1]) );
        });

        Validator::extend('creditCardValidCvc', function($attribute, $value, $parameters, $validator) {
            return CreditCard::validCvc($value,$parameters[0]); //$parameters[0] is the card type
        });

        Validator::extend('creditCardValidStartYearMonth', function($attribute, $year, $parameters, $validator) {
            return creditCardValidStartYearMonth($year, $parameters[0]); //$parameters[0] is the expireMonth
        });

        Validator::extend('creditCardValidExpireYearMonth', function($attribute, $year, $parameters, $validator) {
            return creditCardValidExpireYearMonth($year, $parameters[0]); //$parameters[0] is the expireMonth
        });

        Validator::extend('creditCardValidCreditCard', function($attribute, $value, $parameters, $validator) {
            $cardType = isset($parameters[0])? $parameters[0] : null;
            $validateData = CreditCard::validCreditCard($value, $cardType); //$parameters[0] is the card type
            return $validateData['valid'];
        });

        Validator::extend('ukPostCode', function($attribute, $value, $parameters, $validator) {
            // Start config
            $valid_return_value = true; //'valid';
            $invalid_return_value = false; //'invalid';
            $exceptions = array('BS981TL', 'BX11LT', 'BX21LB', 'BX32BB', 'BX55AT', 'CF101BH', 'CF991NA', 'DE993GG', 'DH981BT', 'DH991NS', 'E161XL', 'E202AQ', 'E202BB', 'E202ST', 'E203BS', 'E203EL', 'E203ET', 'E203HB', 'E203HY', 'E981SN', 'E981ST', 'E981TT', 'EC2N2DB', 'EC4Y0HQ', 'EH991SP', 'G581SB', 'GIR0AA', 'IV212LR', 'L304GB', 'LS981FD', 'N19GU', 'N811ER', 'NG801EH', 'NG801LH', 'NG801RH', 'NG801TH', 'SE18UJ', 'SN381NW', 'SW1A0AA', 'SW1A0PW', 'SW1A1AA', 'SW1A2AA', 'SW1P3EU', 'SW1W0DT', 'TW89GS', 'W1A1AA', 'W1D4FA', 'W1N4DJ');
            // Add Overseas territories ?
            array_push($exceptions, 'AI-2640', 'ASCN1ZZ', 'STHL1ZZ', 'TDCU1ZZ', 'BBND1ZZ', 'BIQQ1ZZ', 'FIQQ1ZZ', 'GX111AA', 'PCRN1ZZ', 'SIQQ1ZZ', 'TKCA1ZZ');
            // End config


            $string = strtoupper(preg_replace('/\s/', '', $value)); // Remove the spaces and convert to uppercase.
            $exceptions = array_flip($exceptions);
            if(isset($exceptions[$string])){return $valid_return_value;} // Check for valid exception
            $length = strlen($string);
            if($length < 5 || $length > 7){return $invalid_return_value;} // Check for invalid length
            $letters = array_flip(range('A', 'Z')); // An array of letters as keys
            $numbers = array_flip(range(0, 9)); // An array of numbers as keys

            switch($length){
                case 7:
                    if(!isset($letters[$string[0]], $letters[$string[1]], $numbers[$string[2]], $numbers[$string[4]], $letters[$string[5]], $letters[$string[6]])){break;}
                    if(isset($letters[$string[3]]) || isset($numbers[$string[3]])){
                        return $valid_return_value;
                    }
                    break;
                case 6:
                    if(!isset($letters[$string[0]], $numbers[$string[3]], $letters[$string[4]], $letters[$string[5]])){break;}
                    if(isset($letters[$string[1]], $numbers[$string[2]]) || isset($numbers[$string[1]], $letters[$string[2]]) || isset($numbers[$string[1]], $numbers[$string[2]])){
                        return $valid_return_value;
                    }
                    break;
                case 5:
                    if(isset($letters[$string[0]], $numbers[$string[1]], $numbers[$string[2]], $letters[$string[3]], $letters[$string[4]])){
                        return $valid_return_value;
                    }
                    break;
            }

            return $invalid_return_value;
        });

        Validator::extend('ukPhoneNumber', function($attribute, $value, $parameters, $validator) {
            $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            try {
                $validatePhoneNumber = $phoneNumberUtil->parse($value, "GB");
                return true;
            } catch (\libphonenumber\NumberParseException $e) { }
            return false;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
