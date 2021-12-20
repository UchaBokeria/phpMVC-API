<?php 

    class Profile extends Database
    {
        public function __construct()
        {
            parent::__construct();

            // here gos interface
        }

        public function Create()
        {
            parent::SET("    INSERT INTO help SET question = :question, answer = :answer , lang_id = :lang_id ;", 
                                    [ "question" => $_POST["question"] ,
                                      "answer"   => $_POST["answer"] ,
                                      "lang_id"  => $_POST["language"] 
                                    ]);

            return (parent::GetLastId() > 0)  ? 
                    ['error' => false, 'success' => true, 'message' =>  ' Record ' . parent::GetLastId() . ' has been created; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Record ' . parent::GetLastId() . ' has NOT been created; '] ;
        }

        public function Read()
        {
            $activeds = "";
            if($_POST["onlyActiveds"]) $activeds = " AND actived = 1 ";
            return parent::GET(" SELECT id, question, answer, lang_id FROM help WHERE lang_id = :lang $activeds ;", ["lang" => $_POST["language"]]);
        }

        public function Update()
        {
            return (parent::SET(" UPDATE help SET question = :question, answer = :answer  WHERE id = :id;", 
                                [   "question" => $_POST["question"], 
                                    "answer" => $_POST["answer"],
                                    "id" => $_POST["id"]
                                ] ) > 0 ) ? 
                    ['error' => false, 'success' => true, 'message' => $_POST["id"]. ' Record has been deleted; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Record has NOT been found; '] ;;
        }

        public function Delete()
        {
            $result = parent::SET(" UPDATE help SET  actived = 0  WHERE id IN(:list) ;", ["list" => explode(',', $_POST["list"]) ]);
            return ($result > 0)  ? 
                    ['error' => false, 'success' => true, 'message' => $result . ' Records has been deleted; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Records has NOT been found; '] ;
        }

        public function 
    }
    