<?php 

    class Products extends Database
    {
        public function __construct()
        {
            parent::__construct();

            // here gos interface
        }

        public function Create()
        {
            parent::SET("   INSERT INTO posts SET 
                                `user_id`     = :user_id, 
                                `title`       = :title ,
                                `dir`         = :dir ,
                                `country_id`  = :country ,
                                `city_id`     = :city ,
                                `created`     = NOW() , 
                                `description` = :description ;", 

                        [   
                            "user_id"     => $_POST["user_id"] ,
                            "title"       => $_POST["title"] ,
                            "dir"         => $_POST["thumbnail"] ,
                            "country"     => $_POST["country"] ,
                            "city"        => $_POST["city"] ,
                            "description" => $_POST["description"] 
                        ]);
            $id = parent::GetLastId();

            foreach (json_decode($_POST["details"]) as $key => $value) {
                
                parent::SET("   INSERT INTO `post_details` set 
                                            `post_id` = :post_id,
                                            `user_id` = :user_id,
                                            `value`   = :value,
                                            `key`     = :title ; ",
                            [
                                'post_id' => $id,
                                'value'   => $value,
                                'title'   => $key,
                                'user_id' => $_POST["user_id"]
                            ]);

            }


            return ($id > 0)  ? 
                    ['error' => false, 'success' => true, 'message' =>  ' Record ' . $id . ' has been created; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Record ' . $id . ' has NOT been created; '] ;
        }

        public function Read()
        {
            $activeds = "";
            if($_POST["onlyActiveds"]) $activeds = " AND actived = 1 ";

            return parent::GET("    SELECT  posts.id,
                                            posts.created,
                                            posts.user_id,
                                            posts.title,
                                            posts.description,
                                            posts.dir AS thumbnail,
                                            CONCAT( '{', 
                                                GROUP_CONCAT( 
                                                    post_details.`key`, ':' , post_details.`value`
                                                ) , '}'
                                            ) AS details

                                    FROM posts 
                                    LEFT JOIN post_details ON post_details.post_id = posts.id
                                    LEFT JOIN post_media ON post_media.id = posts.thumbnail_id
                                    LEFT JOIN vips ON vips.id = posts.vip_status_id
                                    WHERE post_details.actived = 1 $activeds
                                    GROUP BY posts.id ; ");
        }

        public function Update()
        {
            $count = 0;
            $count +=   parent::SET("UPDATE `posts` SET 
                                            `user_id`     = :user_id, 
                                            `title`       = :title ,
                                            `dir`         = :dir ,
                                            `country_id`  = :country ,
                                            `city_id`     = :city ,
                                            `created`     = NOW() , 
                                            `description` = :description 
                                    WHERE   `id`          = :post_id;", 

                                [   "user_id"     => $_POST["user_id"] ,
                                    "title"       => $_POST["title"] ,
                                    "dir"         => $_POST["thumbnail"] ,
                                    "country_id"  => $_POST["country"] ,
                                    "city_id"     => $_POST["city"] ,
                                    "description" => $_POST["description"],
                                    "post_id"     => $_POST["post_id"]
                                ]);

            foreach (json_decode($_POST["details"]) as $key => $value) {

                $count +=   parent::SET("   UPDATE  `post_details` set 
                                                    `user_id` = :user_id,
                                                    `value`   = :value,
                                                    `key`     = :title 
                                            WHERE   `post_id` = :post_id; ",
                                    [
                                        'post_id' => $_POST["post_id"],
                                        'value'   => $value,
                                        'title'   => $key,
                                        'user_id' => $_POST["user_id"]
                                    ]);

            }

            return ( $count != 0 ) ? 
                    ['error' => false, 'success' => true, 'message' => $_POST["post_id"]. ' Record has been updated; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Nothing has been updated; '] ;
        }

        public function Delete()
        {
            $result = parent::SET(" UPDATE posts SET  actived = 0  WHERE id IN(:list) ;", ["list" => explode(',', $_POST["list"]) ]);
            return ($result > 0)  ? 
                    ['error' => false, 'success' => true, 'message' => $result . ' Records has been deleted; '] : 
                    ['error' => false, 'success' => false, 'message' => ' Records has NOT been found; '] ;
        }

    }