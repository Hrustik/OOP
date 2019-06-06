<?php
require_once('user.php');
$users = new User;
$result = $users->users_list($_GET['id']); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UPDATE</title>
</head>
<body>

<form action="index.php" method="post" enctype="multipart/form-data">
<?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <span>NAME </span><input type="text" name="name" value="<?php echo $row['name']; ?>" /><br />
    <span>SURNAME </span><input type="text" name="surname" value="<?php echo $row['surname']; ?>" /><br />
    <?php if($row['photo']){ ?>
    <span>Remove current photo?</span><input type="checkbox" name="delete" value="yes"><br />
    <?php } ?>
    <span>PHOTO</span><input type="file" name="photo"/><br /><br />
    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>" />
    <input type="hidden" name="current_photo" value="<?php echo $row['photo']; ?>" />
    <input type="hidden" name="action" value="update"/>

    <input type="submit" name="submit" value="Update"/>

<?php } ?>
</form>



</body>
<script src="jquery.js"></script>

<script>
    $(function() {
        $('form').submit(function(e) {
            e.preventDefault();

            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                processData: false,
                contentType: false,
                cache: false,
                data: new FormData(this),
            }).done(function(data) {
                window.location.href = 'index.php';
                //console.log(data);
            }).fail(function() {
                console.log('fail');
            });
        });
    });
</script>

</html>
