<?php
require_once('config/db.php');
require_once('user.php');
$db = new DB;
$db->init();

if(isset($_POST['action'])){
    if($_POST['action'] == 'add'){
        $user = new User;
        $data['name'] = $_POST['name'];
        $data['surname'] = $_POST['surname'];
        $data['photo'] = '';
        $data['date'] = date('Y-m-d');

        //save image if exist
        if($_FILES['photo']) {
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
            $path = 'uploads/'; // upload directory

            $img = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];

            // get uploaded file's extension
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            $final_image = rand(1000, 1000000) . $img;


            if (in_array($ext, $valid_extensions)) {
                $path = $path . strtolower($final_image);

                $data['photo'] = $path;

                move_uploaded_file($tmp, $path);
            }
        }

        //INSERT DATA
        $user->create($data);
    }

    if($_POST['action'] == 'update'){
        $user = new User;
        $data['id'] = $_POST['user_id'];
        $data['name'] = $_POST['name'];
        $data['surname'] = $_POST['surname'];
        if(!empty($_POST['current_photo']) && !isset($_POST['delete'])){
            $data['photo'] = $_POST['current_photo'];
        }else{
            $data['photo'] = '';
        }


        //save image if exist
        if($_FILES['photo'] && !isset($_POST['delete'])){
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
            $path = 'uploads/'; // upload directory

            $img = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];

            // get uploaded file's extension
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            $final_image = rand(1000, 1000000) . $img;


            if (in_array($ext, $valid_extensions)) {
                $path = $path . strtolower($final_image);

                $data['photo'] = $path;

                move_uploaded_file($tmp, $path);
            }
        }

        $user->update($data);
    }

    if($_POST['action'] == 'delete'){
        $user = new User;
        $user->delete($_POST['id']);
    }


}





require_once('home.php');

?>