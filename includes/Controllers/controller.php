<?php
session_start();
require_once(__DIR__ . '/../Models/model.php');
require_once(__DIR__ . '/../Models/database.php');
class Controller {
    public $quotes;
    private $quote_arr;
    public $final_quotes = Array();
    public $count_arr = Array();
    public $condition;

    public function __construct() 
    {
        global $API;
        $API->getRequest();
        $this->quotes = $API->quotes;
        $this->quote_arr = $API->quote_arr;
        $this->insertQuote();
        $this->structArray();    
    }

    public function checkToken($token) {
        global $database;
        $row = $database->Query("SELECT * FROM token WHERE token='$token'");
        if(!$row) {
            die("Wrong token");
        }
    }

    private function insertQuote() {
        global $database;
        foreach($this->quote_arr as $q) {
            $q = $database->escapeString($q);
            $row = $database->Query("SELECT * FROM quotes WHERE quote='$q'");
            if(!$row) {
                $database->Query("INSERT INTO quotes (quote, count) VALUE ('$q', 1)");
            }
        }
    }

    public function structArray() {
        $this->checkQuotes();
        foreach($this->quotes as $quote) {
            $array = [
                "text" => $quote['text'],
                "speed" => $quote['speed'],
                "date" => $quote['date']
            ];
            array_push($this->final_quotes, $array);
        }
        for($i = 0; $i < 5; $i++) {
            $this->final_quotes[$i]['count'] = $this->count_arr[$i];
        }
    }

    private function checkQuotes() {
        global $database;
        foreach($this->quotes as $quote) {
            $q = $database->escapeString($quote['text']);
            $row = $database->Query("SELECT * FROM quotes WHERE quote='$q'");
            $count = $this->returnCount($q);
            if($row) {
                $count++;
                $database->Query("UPDATE quotes SET count='$count' WHERE quote='$q'");
                array_push($this->count_arr, $count);
            } else {
                array_push($this->count_arr, $count);
            }
        }
    }

    private function returnCount($q) {
        global $database;
        $row_count = $database->Query("SELECT count FROM quotes WHERE quote='$q'");
        return $row_count[count];
    }

}

$controller = new Controller();