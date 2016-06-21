<?php
/**
 * Created by PhpStorm.
 * User: wr
 * Date: 2016/6/21
 * Time: 7:24
 */

namespace App\Services\IndeedApiService;


class IndeedService
{
    private $apiKey="";
    private $version="2";
    private $jobSearchingUrl = 'http://api.indeed.com/ads/apisearch?publisher=';
    private $jobDetailUrl = 'http://api.indeed.com/ads/apigetjobs?publisher=';

    public function __construct($apiKey){
        $this->apiKey = $apiKey;
        $this->jobSearchingUrl.=$apiKey;
        $this->jobDetailUrl.=$apiKey;
    }
    public function jobSearching($query, $location, $start=0, $limit=10, $sort="relevance", $latlong=0, $country="ca"){
          echo  $this->urlBuilder($this->jobSearchingUrl, $query, $location, $start, $country, $latlong, $limit, $sort);
    }

    public function jobDetails($jobKey){
         echo   $this->urlBuilder($this->jobDetailUrl, $query=false, $location="", $start="", $country="", $latlong="", $limit="", $sort="", $jobKey);
    }

    public function urlBuilder($url, $query=false, $location="", $start="", $country="", $latlong="", $limit="", $sort="", $jobKey =""){
        $queryUrl =$url;
        $error = "";
        if($query==false){
            $queryUrl .="&jobkeys=$jobKey";
            $queryUrl .="&v=$this->version";
            return $queryUrl;
        }
        $pattern = '/^[a-zA-Z]+[,]\s[a-zA-Z]+(\/[a-zA-Z]+){0,2}$/';
        isset($query)&&is_string($query)? $queryUrl .= "&q=$query": $error .= "must be a string";
        isset($location)&&preg_match($pattern, $location)?$queryUrl .="&l=$location":$error .="location format error";
        isset($start)&&is_int($start)?$queryUrl .="&start=$start":$error.="start number should be a number";
        isset($latlong)&&is_numeric($latlong)?$queryUrl .="&latlong=$latlong":$error .="must be a number";
        isset($country)?$queryUrl .="&co=$country":$error .="country is required";
        is_int($limit)?$queryUrl .="&limit=$limit":$error .="limit number should be int";
        isset($sort)?$queryUrl .="&sort=$sort":$error .="sort function is not set";
        $queryUrl .= "&v=$this->version";
        if($error==""){
            return $queryUrl;
        }else{
            return $error;
        }

    }

}