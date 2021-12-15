<?php

    class Logger
    {
        private $filename;
        private $logHeader;
        
        public function __construct()
        {
            $this->filename  =  date('y-m-d') . "__err.log";
            $this->logHeader =  "----------------------------------------------------------" . PHP_EOL . 
                                "-------------------------" . date("y-m-d") . "-------------------------" . PHP_EOL . 
                                "----------------------------------------------------------" . PHP_EOL  . PHP_EOL ;
        }
        public function logExists()
        {
            return file_exists("../../Log/" . $this->filename);
        }

        public function CreateLog($txt)
        {

            if(!$this->logExists()) $txt = $this->logHeader . $txt;
            return file_put_contents("../../Log/" . $this->filename, $txt . PHP_EOL, FILE_APPEND);
        }

        public function RemoveLog()
        {
        }
    }