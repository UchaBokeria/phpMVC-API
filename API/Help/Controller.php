<?php 

    class Help extends Database
    {
        public function Create()
        {

        }

        public function Read()
        {
            return parent::GET("SELECT * FROM accounts");
        }

        public function Update()
        {

        }

        public function Delete()
        {

        }

    }
    