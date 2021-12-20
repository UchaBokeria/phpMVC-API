<?php 

    class Translate extends Database
    {
        public function __construct()
        {
            parent::__construct();

            // here gos interface
        }

        public function Create()
        {
            parent::SET("    INSERT INTO `translate` SET lang_id = :lang_id, lang_key = :lang_key , page_id = :page_id , lang_value = :lang_value ;", 
                                    [ "lang_id" => $_POST["language"] ,
                                      "page_id"   => $_POST["page_id"] ,
                                      "lang_key"   => $_POST["lang_key"] ,
                                      "lang_value"  => $_POST["lang_value"] 
                                    ]);

            return (parent::GetLastId() > 0)  ? 
                    ['error' => false, 'success' => true, 'message' =>  ' Record ' . parent::GetLastId() . ' has been created; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Record ' . parent::GetLastId() . ' has NOT been created; '] ;
        }

        public function Read()
        {
            $activeds = "";
            if($_POST["onlyActiveds"]) $activeds = " AND actived = 1 ";
            return parent::GET(" SELECT id, page_id , lang_id, lang_key, lang_value 
                                 FROM `translate` WHERE lang_id = :lang AND page_id IN( :page_id ) $activeds ;", 
                                 ["lang" => $_POST["language"], "page_id" => explode(',', $_POST["page_id"]) ] );
        }

        public function Update()
        {
            return (parent::SET(" UPDATE `translate` SET lang_value = :lang_value  WHERE id = :id;", 
                                [   
                                    "lang_value" => $_POST["lang_value"], 
                                    "id" => $_POST["id"]
                                ] ) > 0 ) ? 
                    ['error' => false, 'success' => true, 'message' => 'Record ' . $_POST["id"]. ' has been updated; '] : 
                    ['error' => false, 'success' => false, 'message' => ' 0 Records has been updated; '] ;;
        }

        public function Delete()
        {
            $result = parent::SET(" UPDATE `translate` SET  actived = 0  WHERE id IN(:list) ;", ["list" => explode(',', $_POST["list"]) ]);
            return ($result > 0)  ? 
                    ['error' => false, 'success' => true, 'message' => $result . ' Records has been deleted; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Records has NOT been found; '] ;
        }

    }
    