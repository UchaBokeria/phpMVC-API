<?php

    class Configure
    {
        
        private $Response;

        public function __construct($CONFIG)
        {
            $CONTENT = file_get_contents("../../Config/" . $CONFIG . ".json");
            $this->Response = json_decode($CONTENT, true);
            $this->$CONFIG();
        }

        private function XconfigsX()
        {
            if(!$this->Response["displayErrors"]) return; 
            ini_set("display_errors", true);
            error_reporting(E_ERROR);
        }

        private function RouteMap()
        {
            foreach($this->Response["routes"] AS $Router) include_once "../../Routes/" . $Router . ".php";
        }

        private function Database()
        {
            foreach ($this->Response["Options"] as $key => $value) define($key, $value);
        }

    }