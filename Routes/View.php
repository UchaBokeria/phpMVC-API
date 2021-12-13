<?php

    class View
    {

        public function __construct($ROUTER)
        {
            
            include_once "../" . $ROUTER . "/Controller.php";

            $ROUTE    = new $ROUTER();
            $ACTION   = $_REQUEST["ACTION"];

            $RESPONSE = $ROUTE->$ACTION();
            echo json_encode($RESPONSE);

        }

    }