<div>
    <form action="" enctype="multipart/form-data" method="post">
        <select name="image_selector">
          <?=$image_list?>
        </select>
        <input type="submit">
    </form>
</div>
<div class="single_img" style="width: 300px;">
    <?=$image['image']?>
</div>
<p>Просмотров: <?=$image['views']?></p>