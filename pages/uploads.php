<h1>Uploads</h1>

<?php //echo phpinfo() ?>

<?php Message::show() ?>

<form action="/uploads" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button class="btn btn-primary" name="action" value="uploadImage">Send</button>
</form>


<?php
// $files = glob('./uploaded/*.{jpg,jpeg,png,gif,webp,avif}', GLOB_BRACE);
// dump($files);
?>