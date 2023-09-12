<?php
// Add custom Theme Functions here

/*=====import style.css=====*/
function wp_style() {

	wp_register_style( 'slick-style', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css", 'all' );
	wp_enqueue_style('slick-style');

	wp_register_style( 'slick-theme', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css", 'all' );
	wp_enqueue_style('slick-theme');

	wp_register_script( 'jquery-3-script', "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js", array('jquery') );
	wp_enqueue_script('jquery-3-script');

	wp_register_script( 'slick-script', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js", array('jquery') );
	wp_enqueue_script('slick-script');

    // Enqueue jQuery Fancybox library
    wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
    // Enqueue Fancybox CSS
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), '3.5.7');
    // Your custom JavaScript
    wp_enqueue_script('custom-js', '/wp-content/themes/flatsome-child/js/custom.js', array('jquery', 'fancybox'), '1.0', true);
    // Pass product data to JavaScript
    if(is_product()) {
        $product_data = array(
            'product_name' => get_the_title(),
            'product_price' => wc_get_product(get_the_ID())->get_price(),
        );
        wp_localize_script('custom-js', 'productData', $product_data);
    }
	
}
add_action('wp_enqueue_scripts', 'wp_style');

function create_shortcode_blog($args) {
	$blog = new WP_Query(array(
		'post_type' => 'post',
        'order'          => 'DESC',
        'orderby'        => 'date',
		'posts_per_page' => $args['number'],
	));

	$randomID = rand(10,100);
	ob_start();
	if ( $blog->have_posts() ) :
		echo '<div id="slide_'.$randomID.'" class="blog-slider">';
		while ( $blog->have_posts() ) : $blog->the_post();
            ?>
            <div class="blog-slide">
                <div class="pt-blog-post">
                    <div class="pt-post-media">
                        <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>">
                    </div>
                    <div class="pt-blog-contain">
                        <div class="pt-post-meta">
                            <ul>
                                <li class="pt-post-author"><i class="fa fa-user"></i><?php echo get_the_author();?></li>
                                <li class="pt-post-date">
                                <a href="https://hostingo.peacefulqode.com/2020/12/11/">
                                <span><i class="fa fa-calendar"></i><?php echo get_the_date();?></a>
                                </li>
                                <!-- <li class="pt-post-cat">
                                    <a href="https://hostingo.peacefulqode.com/category/cloud-hosting/"><i class="fa fa-tag"></i>Cloud hosting</a>
                                </li> -->
                                
                            </ul>
                        </div>
                        <h5 class="pt-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h5>
                        <p>
                            <?php 
                                $post_excerpt = wp_trim_words(get_the_excerpt(), 20);
                                echo $post_excerpt;
                            ?>
                        </p>

                        <div class="pt-blog-bottom">
                            <div class="pt-btn-container">
                            <a href="<?php echo get_permalink(); ?>" class="pt-button pt-btn-link">
                                <div class="pt-button-block">
                                    <span class="pt-button-text">Xem thêm</span>
                                </div>
                            </a>
                            </div>
                            <div class="pt-post-comment">
                                <span><i class="fa fa-comments"></i><?php echo get_comments_number();?></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
		<?php endwhile;
		echo '</div>';
	endif;
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#slide_<?php echo $randomID;?>').slick({
					autoplay: true,
                    autoplaySpeed: 1000,
                    speed: 600,
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false,
                    responsive: [
                        {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                        },
                        {
                            breakpoint: 575,
                            settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            }
                        }
                    ],
				});
			});
		</script>
	<?php
	$list_post = ob_get_contents();

	ob_end_clean();


	return $list_post;
}
add_shortcode('get_blog', 'create_shortcode_blog');

function create_shortcode_blog_template($args) {
	$blog = new WP_Query(array(
		'post_type' => 'post',
        'order'          => 'DESC',
        'orderby'        => 'date',
		'posts_per_page' => 9,
	));

	$randomID = rand(10,100);
    $countp = $blog ->found_posts;
	ob_start();
	if ( $blog->have_posts() ) :
		echo '<div id="blog-'.$randomID.'" class="blog-grid">';
		while ( $blog->have_posts() ) : $blog->the_post();
            ?>
            <div class="blog-item">
                <div class="pt-blog-post">
                    <div class="pt-post-media">
                        <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>">
                    </div>
                    <div class="pt-blog-contain">
                        <div class="pt-post-meta">
                            <ul>
                                <li class="pt-post-author"><i class="fa fa-user"></i><?php echo get_the_author();?></li>
                                <li class="pt-post-date">
                                <a href="https://hostingo.peacefulqode.com/2020/12/11/">
                                <span><i class="fa fa-calendar"></i><?php echo get_the_date();?></a>
                                </li>
                                <!-- <li class="pt-post-cat">
                                    <a href="https://hostingo.peacefulqode.com/category/cloud-hosting/"><i class="fa fa-tag"></i>Cloud hosting</a>
                                </li> -->
                                
                            </ul>
                        </div>
                        <h5 class="pt-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h5>
                        <p>
                            <?php 
                                $post_excerpt = wp_trim_words(get_the_excerpt(), 20);
                                echo $post_excerpt;
                            ?>
                        </p>

                        <div class="pt-blog-bottom">
                            <div class="pt-btn-container">
                            <a href="<?php echo get_permalink(); ?>" class="pt-button pt-btn-link">
                                <div class="pt-button-block">
                                    <span class="pt-button-text">Xem thêm</span>
                                </div>
                            </a>
                            </div>
                            <div class="pt-post-comment">
                                <span><i class="fa fa-comments"></i><?php echo get_comments_number();?></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
		<?php endwhile;
		echo '</div>';
        if ($countp > 9): ?> <!-- Kiểm tra liệu bài viết -->
            <script type="text/javascript">
                $(document).ready(function(){
                    ajaxurl = '<?php echo admin_url("admin-ajax.php")?>';
                    var offset = 9; // Đặt số lượng bài viết đã hiển thị ban đầu
                    var sortValue = $('#filter').find('input[name="orderby"]:checked').val();
                    var priceMin = $('input[name="price_min"]').val();
                    var priceMax = $('input[name="price_max"]').val();
                    $( "#loadmore" ).click(function() {
                        $('.loader').addClass('active');
                        $.ajax({
                            type: "POST", //Phương thưc truyền Post
                            url: ajaxurl,
                            data:{
                                "action": "loadmore", 
                                'offset': offset, 
                            },  //Gửi các dữ liệu
                            success:function(response)
                            {
                                $('.blog-grid').append(response);
                                offset += offset; //Tăng bài viết đã hiển thị lên 
                                $('.btn-wrapper i').addClass('d-none');
                                if (offset >= <?php echo $countp ?>) { 
                                    $('#loadmore').addClass('d-none');
                                }
                                setTimeout(function(){
                                    $('.loader').removeClass('active');
                                },200); 
                            }});
                    });
                });
            </script>
            <div class="btn-wrapper d-flex align-items-center justify-content-center mt-3h">
                <a href="javascript:;" id="loadmore" class="text-third fs-lg-16 fw-bold d-flex align-items-center text-uppercase lh-1">
                    Xem thêm
                </a>
                <i class="fa fa-spinner fa-spin fa-fw d-none"></i>
            </div>
        <?php endif;
	endif;

	$list_post = ob_get_contents();

	ob_end_clean();


	return $list_post;
    
}
add_shortcode('get_blog_template', 'create_shortcode_blog_template');

// load more products

add_action( 'wp_ajax_nopriv_loadmore', 'filter_load_posts' );
add_action( 'wp_ajax_loadmore', 'filter_load_posts' );
function filter_load_posts () {
	$offset = !empty($_POST['offset']) ? intval( $_POST['offset'] ) : '';

	if ($offset ) {
		$args = array(
			'posts_per_page' => 9,
			'post_type' => 'post',
			'offset' => $offset,
		);
		
		$the_query = new WP_Query( $args );
		if( $the_query->have_posts() ): while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
            <div class="blog-item">
                <div class="pt-blog-post">
                    <div class="pt-post-media">
                        <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>">
                    </div>
                    <div class="pt-blog-contain">
                        <div class="pt-post-meta">
                            <ul>
                                <li class="pt-post-author"><i class="fa fa-user"></i><?php echo get_the_author();?></li>
                                <li class="pt-post-date">
                                <a href="https://hostingo.peacefulqode.com/2020/12/11/">
                                <span><i class="fa fa-calendar"></i><?php echo get_the_date();?></a>
                                </li>
                                <!-- <li class="pt-post-cat">
                                    <a href="https://hostingo.peacefulqode.com/category/cloud-hosting/"><i class="fa fa-tag"></i>Cloud hosting</a>
                                </li> -->
                                
                            </ul>
                        </div>
                        <h5 class="pt-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h5>
                        <p>
                            <?php 
                                $post_excerpt = wp_trim_words(get_the_excerpt(), 20);
                                echo $post_excerpt;
                            ?>
                        </p>

                        <div class="pt-blog-bottom">
                            <div class="pt-btn-container">
                            <a href="<?php echo get_permalink(); ?>" class="pt-button pt-btn-link">
                                <div class="pt-button-block">
                                    <span class="pt-button-text">Xem thêm</span>
                                </div>
                            </a>
                            </div>
                            <div class="pt-post-comment">
                                <span><i class="fa fa-comments"></i><?php echo get_comments_number();?></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
		<?php endwhile; 
		endif; wp_reset_query();
	}
	die();
}

// Thêm button vào dưới giá sản phẩm
function add_custom_button_below_price() {

    // Kiểm tra xem sản phẩm có tồn tại giá không
    if (is_product()) {
        echo '<div class="contact-wrap"><button id="show-popup-button" class="custom-button-class">Liên hệ để mua acc</button></div>';
    }
}

add_action('woocommerce_single_product_summary', 'add_custom_button_below_price', 25);

