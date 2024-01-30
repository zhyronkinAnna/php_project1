<h1>Uploads</h1>

<?php //echo phpinfo() ?>

<?php Message::show() ?>

<form action="/uploads" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button class="btn btn-primary" name="action" value="uploadImage">Send</button>
</form>

 <?php
    $files = glob('./uploaded/small/*.{jpg,jpeg,png,gif,webp,avif}', GLOB_BRACE);
    dump($files);
?>


<div class="slick-fade">
    <?php
    foreach ($files as $file) {
        echo '<img src="' . $file . '" alt="Image">';
    }
    ?>
</div> 

<script type="text/javascript">
    $(document).ready(function(){
        $('.slick-fade').slick({
            dots: true,
            infinite: true,
            speed: 700,
            autoplay:true,
            autoplaySpeed: 2000,
            arrows:false,
            slidesToShow: 1,
            slidesToScroll: 1,
            variableWidth: true,
        })
    });
</script> 