<h1>Galary</h1>
<hr>

    <?php
        $sliders = glob("uploaded/*");
        foreach($sliders as $slider):
            if(is_dir($slider)): 
                echo '<h3>' . basename($slider) . '</h3>'?>
                <div class="slick-fade">
                    <?php renderSlider($slider) ?>
                </div>
             <?php endif; 
        endforeach ?>
 
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
        });

        Fancybox.bind("[data-fancybox]", {}); 
    });
</script> 