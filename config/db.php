<?php

class DB{
    public $conn;

    public function __construct(){
        $this->conn = mysqli_connect('localhost', 'root', '', 'oop');
        if($this->conn){
            //echo "Connected";
        }else{
            echo "FAIL CONNECTiON";
        }
    }

    public function init(){

        //create user table
        mysqli_query($this->conn, "CREATE TABLE IF NOT EXISTS `user` ( `id` INT(10) NOT NULL AUTO_INCREMENT ,
        `name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
        `surname` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
        PRIMARY KEY (`id`)) ENGINE = InnoDB;");

        //create user_info table
        mysqli_query($this->conn, "CREATE TABLE IF NOT EXISTS `user_info` ( `id` INT(10) NOT NULL AUTO_INCREMENT ,
      `user_id` INT(10) NOT NULL , `photo` VARCHAR(100)
       CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL , `date_reg` DATE DEFAULT NULL ,
       PRIMARY KEY (`id`), CONSTRAINT FK_user_userid FOREIGN KEY(`user_id`) REFERENCES user(`id`)) ENGINE = InnoDB;");
    }
}

?>