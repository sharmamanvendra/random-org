<?php

/**
 * RANDOM.ORG
 * JSON-RPC API – Release 1
 * https://api.random.org/json-rpc/1/
 *
 * @version 2014.02.17
 * @copyright (c) 2014, dopitz
 * @link https://github.com/odan
 * @author dopitz <odan@users.noreply.github.com>
 * @license MIT
 */
class RandomOrgClient
{

    // The URL for invoking the API
    // https://api.random.org/json-rpc/1/
    protected $strUrl = 'https://api.random.org/json-rpc/1/invoke';

    // Random.org API-KEY
    // https://api.random.org/api-keys
    protected $strApiKey = '';

    // RPC
    protected $numTimelimit = 300;

    function __construct()
    {
        $this->setTimelimit($this->numTimelimit);
    }

    public function setApiKey($strApiKey)
    {
        $this->strApiKey = $strApiKey;
    }

    /**
     * This method generates true random integers within a user-defined range.
     *
     * @param int $numNumbers How many random integers you need.
     * Must be within the [1,1000000000] range.
     * @param int $numMin The lower boundary for the range from which the
     * random numbers will be picked.
     * Must be within the [-1000000000,1000000000] range.
     * @param int $numMax The upper boundary for the range from which the
     * random numbers will be picked.
     * Must be within the [-1000000000,1000000000] range.
     * @param type $boolReplacement Specifies whether the random numbers
     * should be picked with replacement. The default (true) will cause the
     * numbers to be picked with replacement, i.e., the resulting numbers
     * may contain duplicate values (like a series of dice rolls).
     * If you want the numbers picked to be unique (like raffle tickets
     * drawn from a container), set this value to false.
     * @param type $numBase Specifies the base that will be used to display
     * the numbers. Values allowed are 2, 8, 10 and 16. 
     * @return array
     */
    public function generateIntegers($numNumbers, $numMin, $numMax, $boolReplacement = true, $numBase = 10)
    {
        $arrParams = array();
        $arrParams['apiKey'] = $this->strApiKey;
        $arrParams['n'] = $numNumbers;
        $arrParams['min'] = $numMin;
        $arrParams['max'] = $numMax;
        $arrParams['replacement'] = $boolReplacement;
        $arrParams['base'] = $numBase;
        $arrResponse = $this->call('generateIntegers', $arrParams);

        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result']['random']['data'])) {
            $arrReturn = $arrResponse['result']['random']['data'];
        }

        return $arrReturn;
    }

    /**
     * This method generates true random decimal fractions from a uniform
     * distribution across the [0,1] interval with a user-defined number of
     * decimal places.
     *
     * @param int $numNumbers How many random decimal fractions you need.
     * Must be within the [1,10000] range.
     * @param int $numDecimalPlaces The number of decimal places to use.
     * Must be within the [1,20] range.
     * @param bool $boolReplacement Specifies whether the random numbers should
     * be picked with replacement. The default (true) will cause the numbers to
     * be picked with replacement, i.e., the resulting numbers may contain
     * duplicate values (like a series of dice rolls).
     * If you want the numbers picked to be unique (like raffle tickets
     * drawn from a container), set this value to false.
     * @return array
     * @throws Exception
     */
    public function generateDecimalFractions($numNumbers, $numDecimalPlaces, $boolReplacement = true)
    {
        $arrParams = array();
        $arrParams['apiKey'] = $this->strApiKey;
        $arrParams['n'] = $numNumbers;
        $arrParams['decimalPlaces'] = $numDecimalPlaces;
        $arrParams['replacement'] = $boolReplacement;
        $arrResponse = $this->call('generateDecimalFractions', $arrParams);
        //print_r($arrResponse);
        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result']['random']['data'])) {
            $arrReturn = $arrResponse['result']['random']['data'];
        }

        return $arrReturn;
    }

    /**
     * This method generates true random numbers from a Gaussian distribution 7
     * (also known as a normal distribution). The form uses a Box-Muller
     * Transform to generate the Gaussian distribution from uniformly
     * distributed numbers.
     *
     * @param int $numNumbers How many random numbers you need.
     * Must be within the [1,10000] range.
     * @param int $numMean The distribution's mean.
     * Must be within the [-1000000,1000000] range.
     * @param int $numStandardDeviation The distribution's standard deviation.
     * Must be within the [-1000000,1000000] range.
     * @param int $numSignificantDigits The number of significant digits to use.
     * Must be within the [2,20] range.
     * @return array
     * @throws Exception
     */
    public function generateGaussians($numNumbers, $numMean, $numStandardDeviation, $numSignificantDigits)
    {
        $arrParams = array();
        $arrParams['apiKey'] = $this->strApiKey;
        $arrParams['n'] = $numNumbers;
        $arrParams['mean'] = $numMean;
        $arrParams['standardDeviation'] = $numStandardDeviation;
        $arrParams['significantDigits'] = $numSignificantDigits;

        $arrResponse = $this->call('generateGaussians', $arrParams);
        //print_r($arrResponse);
        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result']['random']['data'])) {
            $arrReturn = $arrResponse['result']['random']['data'];
        }

        return $arrReturn;
    }

    /**
     * This method generates true random strings.
     *
     * @param int $numNumbers How many random strings you need.
     * Must be within the [1,10000] range.
     * @param int $numLength The length of each string. Must be within
     * the [1,20] range. All strings will be of the same length
     * @param int $strCharacters A string that contains the set of characters
     * that are allowed to occur in the random strings.
     * The maximum number of characters is 80.
     * @param bool $boolReplacement (true = with duplicates, false = unique)
     * @return array
     * @throws Exception
     */
    public function generateStrings($numNumbers, $numLength, $strCharacters = null, $boolReplacement = true)
    {

        if ($strCharacters === null) {
            // default
            $strCharacters = 'abcdefghijklmnopqrstuvwxyz';
            $strCharacters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $strCharacters .= '0123456789';
        }

        $arrParams = array();
        $arrParams['apiKey'] = $this->strApiKey;
        $arrParams['n'] = $numNumbers;
        $arrParams['length'] = $numLength;
        $arrParams['characters'] = $strCharacters;
        $arrParams['replacement'] = $boolReplacement;

        $arrResponse = $this->call('generateStrings', $arrParams);
        //print_r($arrResponse);
        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result']['random']['data'])) {
            $arrReturn = $arrResponse['result']['random']['data'];
        }

        return $arrReturn;
    }

    /**
     * This method generates version 4 true random Universally Unique 
     * IDentifiers (UUIDs) in accordance with section 4.4 of RFC 4122. 
     * 
     * @param int $numNumbers
     * @return array
     * @throws Exception
     */
    public function generateUUIDs($numNumbers)
    {

        $arrParams = array();
        $arrParams['apiKey'] = $this->strApiKey;
        $arrParams['n'] = $numNumbers;

        $arrResponse = $this->call('generateUUIDs', $arrParams);

        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result']['random']['data'])) {
            $arrReturn = $arrResponse['result']['random']['data'];
        }

        return $arrReturn;
    }

    /**
     * This method generates Binary Large Objects (BLOBs)
     * containing true random data.
     *
     * @param int $numNumbers How many random blobs you need.
     * Must be within the [1,100] range.
     * @param int $numSize The size of each blob, measured in bits.
     * Must be within the [1,1048576] range and must be divisible by 8.
     * @param string $strFormat Specifies the format in which the blobs will
     * be returned. Values allowed are base64 and hex.
     * @return array
     * @throws Exception
     */
    public function generateBlobs($numNumbers, $numSize, $strFormat = 'base64')
    {

        $arrParams = array();
        $arrParams['apiKey'] = $this->strApiKey;
        $arrParams['n'] = $numNumbers;
        $arrParams['size'] = $numSize;
        $arrParams['format'] = $strFormat;

        $arrResponse = $this->call('generateBlobs', $arrParams);

        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result']['random']['data'])) {
            $arrReturn = $arrResponse['result']['random']['data'];
        }

        return $arrReturn;
    }

    /**
     * This method returns information related to the the 
     * usage of a given API key. 
     *
     * @param type $strApiKey (optional) Your API key,
     * which is used to track the true random bit usage for your client.
     *
     * @return array
     * @throws Exception
     */
    public function getUsage($strApiKey = null)
    {
        $arrParams = array();

        if ($strApiKey === null) {
            $strApiKey = $this->strApiKey;
        }
        $arrParams['apiKey'] = $strApiKey;

        $arrResponse = $this->call('getUsage', $arrParams);

        if (isset($arrResponse['error']['message'])) {
            throw new Exception($arrResponse['error']['message']);
        }

        $arrReturn = array();
        if (isset($arrResponse['result'])) {
            $arrReturn = $arrResponse['result'];
        }

        return $arrReturn;
    }

    // -------------------------------------------------------------------------
    // JSON-RPC
    // -------------------------------------------------------------------------

    protected function setUrl($strUrl)
    {
        $this->strUrl = $strUrl;
    }

    protected function setTimelimit($numTimelimit)
    {
        $this->numTimelimit = $numTimelimit;
        set_time_limit($this->numTimelimit);
    }

    /**
     * Http Json-RPC Request ausfuehren
     *
     * @param string $strMethod
     * @param array $arrParams
     * @return array
     */
    protected function call($strMethod, $arrParams = null)
    {
        $arrRequest = array();
        $arrRequest['jsonrpc'] = '2.0';
        $arrRequest['id'] = mt_rand(1, 999999);
        $arrRequest['method'] = $strMethod;
        if (isset($arrParams)) {
            $arrRequest['params'] = $arrParams;
        }

        $strJson = $this->encodeJson($arrRequest);
        $strResponse = $this->post($strJson);
        $arrResponse = $this->decodeJson($strResponse);
        return $arrResponse;
    }

    /**
     * HTTP POST-Request
     *
     * @param string $strContent
     * @return string
     */
    protected function post($strContent = '')
    {
        $strReturn = '';

        $arrDefaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $this->strUrl,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => $this->numTimelimit,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => $strContent,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $ch = curl_init();
        curl_setopt_array($ch, $arrDefaults);

        $strReturn = curl_exec($ch);
        $numHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($numHttpCode < 200 || $numHttpCode >= 300) {
            $numError = curl_errno($ch);
            $strError = curl_error($ch);
            $strText = trim(strip_tags($strReturn));
            curl_close($ch);
            throw new Exception(trim("HTTP Error [$numHttpCode] $strError. $strText"), $numError);
        }

        curl_close($ch);
        return $strReturn;
    }

    /**
     * json encoder
     * @param array $array
     * @param int $options
     * @return string
     */
    protected function encodeJson($array, $options = 0)
    {
        $str = json_encode($this->encodeUtf8($array), $options);
        return $str;
    }

    /**
     * json decoder
     * @param string $strJson
     * @return array
     */
    protected function decodeJson($strJson)
    {
        return json_decode($strJson, true);
    }

    /**
     * Encodes an ISO string to UTF-8
     * @param mixed $array
     * @return mixed
     */
    protected function encodeUtf8($str)
    {
        if ($str === null || $str === '') {
            return $str;
        }

        if (is_array($str)) {
            foreach ($str as $strKey => $strVal) {
                $str[$strKey] = $this->encodeUtf8($strVal);
            }
            return $str;
        } else {
            if (!mb_check_encoding($str, 'UTF-8')) {
                return mb_convert_encoding($str, 'UTF-8');
            } else {
                return $str;
            }
        }
    }

}