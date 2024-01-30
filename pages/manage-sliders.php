<h1>Manage Sliders</h1>
<hr>
<h3>Create new slider</h3>
<form action="/manage-sliders" method="post">
    <!-- <label for=""></label> -->
    <input type="text" name="sliderName" placeholder="Enter slider name">
    <button name="action" value="createSlider">Create</button>
    <?php Message::show() ?>
</form>

<h3>Upload image</h3>
<form action="/manage-sliders" method="post" enctype="multipart/form-data">
    <select name="sliders-dst" id="sliders-dst">
    <option value="" selected disabled>Select Slider</option>
        <?php
          $allSliders = scandir("uploaded", SCANDIR_SORT_ASCENDING); /// uploaded 
          $allSliders = array_diff($allSliders, ['.', '..']);
          foreach($allSliders as $slider){
            if(is_dir("uploaded/$slider")){ ///uploaded
                echo '<option value="' . $slider . '">' . $slider . '</option>';
            }
          }
        ?>
        <?php Message::show(dump($allSliders)) ?>
    </select>

    <input type="file" name="file">
    <button name="action" value="uploadImageTo">Upload</button>
   <?php Message::show() ?>
</form>

<h3>Delete slider</h3>
<form action="/manage-sliders" method="post"> 
    <select name="slider" id="slider">
    <option value="" selected disabled>Select Slider</option> 
        <?php //////// 
          $allSliders = scandir("uploaded", SCANDIR_SORT_ASCENDING); /// uploaded 
          $allSliders = array_diff($allSliders, ['.', '..']);
          foreach($allSliders as $slider){
            if(is_dir("uploaded/$slider")){ ///uploaded
                echo '<option value="' . $slider . '">' . $slider . '</option>';
            }
          }
        ?>
    </select>
    <button value="deleteSlider" name="action">Delete</button>
</form>