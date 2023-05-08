<?php
    $video_title = get_field('video_title');
	$video = get_field('embed_code');
// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block-aventia-video';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="video-hero-container">
	   <iframe title="<?php echo $video_title; ?> " frameborder="0" allowtransparency="true" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" scrolling="no" style="border0;" allowfullscreen src="<?php echo $video; ?>">
	   </iframe>
   </div>
</div>