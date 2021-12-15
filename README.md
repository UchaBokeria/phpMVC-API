# phpMVC-API
@Native PHP
@Author Ucha Bokeria

# Database.json - To change Database configuration change /Config/Database.json properties
# XconfigX.json - To turn features on/off like error_reporting & logging errors
# Routemap.json - To require files in pre processes


# Configure - class to make pre-process rules run for routes
    @write pre-process in Configure.php as method
    @write json configuration in Config folder

# To create new Controller for API: 
    @create folder in API with Controller.php and index.php
    @write class with data returnable methods in Controller.php
    @AND call view('YOUR_NEW_CONTROLLER_NAME') class in index.php
