<?php

    class View extends AuthGuard
    {

        public function __construct($ROUTER)
        {

            parent::__construct();
            $AuthGuarders = new Configure("AuthGuard");
            $GUARDS = $AuthGuarders->Response["CustomGuards"][$ROUTER];
            $OPENKEY = (in_array($_REQUEST["ACTION"], $GUARDS)) ? $this->Authorize() : true;
            
            if(!$OPENKEY) {

                $RESPONSE = [
                    "error" => true, 
                    "success" => false, 
                    "message" => "Authorize error"
                ];

            } else {
                
                include_once "../" . $ROUTER . "/Controller.php";
    
                $ROUTE    = new $ROUTER();
                $ACTION   = $_REQUEST["ACTION"];
                $RESPONSE = $ROUTE->$ACTION();

            }

            echo json_encode($RESPONSE);
        }

    }