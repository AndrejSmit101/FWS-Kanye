<?php

class API {

    public $quotes = Array();
    public $quote_arr = Array();
    private $token;

    public function getRequest() 
    {
        for($i = 1; $i <= 5; $i++) {
            //Getting the day of the week
            $date = date("l");
            //API URL
            $url = 'https://api.kanye.rest';
            $curl = curl_init($url);
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
            );
            //cURL config
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            //Executing the request
            $response = curl_exec($curl);
            //Checking if the quote was already fetched in the current "session" of five quotes
            if(in_array($response, $this->previous_quotes)) {
                $i--;
            } else {
                $info = curl_getinfo($curl, CURLINFO_TOTAL_TIME_T);
                $array = json_decode($response, true);
                array_push($this->quote_arr, $array['quote']);
                $kkk = [
                    "text" => $array['quote'],
                    "speed" => round($info / 1000),
                    "date" => $date
                ];
                array_push($this->quotes, $kkk);
            }
        }    
    }
}

$API = new API();