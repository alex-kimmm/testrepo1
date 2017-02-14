<?php
if (! function_exists('mb_ucfirst')) {
    function mb_ucfirst($string, $encoding = 'UTF-8')
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }
}

if (! function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return sprintf('%0.2f', floatval($price));
    }
}

if (! function_exists('deletePrefixFromString')) {
    function deletePrefixFromString($prefix, $str)
    {
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            if(strlen($prefix) === strlen($str)){
                $str = '';
            } else {
                $str = substr($str, strlen($prefix));
            }
        }
        return $str;
    }
}

if (! function_exists('_startsWith')) {
    function _startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}

if (! function_exists('_endsWith')) {
    function _endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }
}

if (! function_exists('_sanitizeURL')) {
    function _sanitizeURL($uri, $host) {
        $relativePath = $uri = trim($uri);
        if($uri!='' && !is_null($uri) && !empty($uri)){

            $urlHost = parse_url(trim($uri),PHP_URL_HOST);

            if( !is_null($urlHost) && $urlHost !== $host){
                return $uri;
            }

            if($urlHost === $host){
                $relativePath = parse_url(trim($uri),PHP_URL_PATH);
            }

            if(!is_null($relativePath)){
                $relativePath = deletePrefixFromString($host,$relativePath);

                if(!_startsWith($relativePath,'/')){
                    $relativePath = '/' . $relativePath;
                }
                return $relativePath;
            }
        }
        return $uri;
    }
}

if (! function_exists('creditCardValidStartYearMonth')) {
    function creditCardValidStartYearMonth($year, $month)
    {
        $day = 1;
        if(!checkdate($month,$day,$year)){
            return false;
        }

        // past date
        if (intval($year) > intval(date('Y')) || intval($year) == intval(date('Y')) && intval($month) > intval(date('n'))) {
            return false;
        }
        return true;
    }
}

if (! function_exists('creditCardValidExpireYearMonth')) {
    function creditCardValidExpireYearMonth($year, $month)
    {
        $day = 1;
        if(!checkdate($month,$day,$year)){
            return false;
        }

        // past date
        if (intval($year) < intval(date('Y')) || intval($year) == intval(date('Y')) && intval($month) < intval(date('n'))) {
            return false;
        }
        return true;
    }
}

if (! function_exists('startsWithOneOfPrefixes')) {
    function startsWithOneOfPrefixes($string, $prefixes, $caseSensitive = false)
    {
        if (!empty($string) && count($prefixes)>0) {
            $pattern = '/^('. implode("|", $prefixes) .')/';
            if(!$caseSensitive){
                $pattern .= 'i';
            }
            preg_match($pattern, $string, $matches);
            return (count($matches) > 0);
        }
        return false;
    }
}