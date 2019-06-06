<?php
require_once('user.php');
$users = new User;
$result = $users->users_list(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HOME</title>
    <style>
        a{
            padding: 20px;
        }

        img {
            width: 200px;
        }

        span.delete{
            cursor: pointer;
            color: red;
        }

    </style>
</head>
<body>
<a href="add.php">ADD NEW USER</a><br /><br />

<?php while ($row = mysqli_fetch_assoc($result)) {
    $img = !empty($row['photo']) ? "<img src='".$row['photo']."' alt='img' />" : ''; ?>
    <div class="block"><?php echo $row['name']." ".$row['surname']."$img <a href='update.php?id=".$row['id']."' class='edit'>EDIT</a><span class='delete' user-id='".$row['id']."'>DELETE</span>"; ?></div></br>
<?php } ?>

</body>
<script src="jquery.js"></script>

<script>
    $(function() {
        $('.delete').on('click', function (){
           var id = $(this).attr('user-id');
            var parent = $(this).parent();
            var del = "delete";
            $.ajax({
                type: 'post',
                url: 'index.php',
                data: {id: id, action: del},
            }).done(function(data) {
                alert("User with id "+id+" is deleted!");
                $(parent).remove();

            }).fail(function() {
                console.log('fail');
            });
        });
    });
</script>

</html>
