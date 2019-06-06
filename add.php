<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CREATE</title>
</head>
<body>

<form action="index.php" method="post" enctype="multipart/form-data">
    <span>NAME </span><input type="text" name="name"/><br />
    <span>SURNAME </span><input type="text" name="surname"/><br />
    <span>PHOTO</span><input type="file" name="photo"/><br /><br />
    <input type="hidden" name="action" value="add"/>

    <input type="submit" name="submit" value="SEND"/>
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

