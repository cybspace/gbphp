<div>
    <form action="" enctype="multipart/form-data" method="get">
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