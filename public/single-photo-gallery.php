<?php


get_header(); 

echo '<div id="meta-posts">';
         $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
        //var_dump($ids);die;
       
      
        foreach ($ids as $key => $value){
            
            $image = wp_get_attachment_image_src($value);
           // var_dump($image);die;
         // $image = wp_get_attachment_image($ids,'medium');
            ?>
            <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <img src="<?php echo $image[0] ?>">
            

<?php }
        

get_footer();
