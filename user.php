<?php
require_once('config/db.php');
class User extends DB{
    public function create($data){
        mysqli_query($this->conn, "INSERT INTO `user` VALUES(null, '".$data['name']."', '".$data['surname']."');");
        mysqli_query($this->conn, "INSERT INTO `user_info` VALUES(null, '".mysqli_insert_id($this->conn)."', '".$data['photo']."', '".$data['date']."');");
    }

    public function users_list($id = null){
        if($id !== null){
            $where = "WHERE u.id = ".$id;
        }else{
            $where = '';
        }
        $result = mysqli_query($this->conn, "SELECT u.id, u.name, u.surname, i.photo FROM user u LEFT JOIN user_info i ON u.id = i.user_id $where;");
        return $result;
    }

    public function update($data){
        mysqli_query($this->conn, "UPDATE user LEFT JOIN user_info ON user.id = user_info.user_id
        SET user.name = '".$data['name']."', user.surname = '".$data['surname']."', user_info.photo = '".$data['photo']."' WHERE user.id = '".$data['id']."'");
    }

    public function delete($id = null){
        mysqli_query($this->conn, "DELETE FROM `user_info` WHERE `user_id` = '".$id."'" );
        mysqli_query($this->conn, "DELETE FROM `user` WHERE `id` = '".$id."'" );

        return $id;
    }
}
?>