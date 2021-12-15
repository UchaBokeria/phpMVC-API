<?php 
    
    class AuthGuard
    {
        public function __construct()
        {}

        public function Authorize()
        {
            $TOKEN = $_SERVER["HTTP_TOKEN"];
            $KEY   = "110dfac92554d3d4f4499e07848c9445228634b5a5b5184b1a08b154d42d6abe62be4d18200f1b9e8e9df44c0e192ff9060cfe896a1bf83f5882178b786d395f";
            return ($KEY == $TOKEN);
        } 
    }
    