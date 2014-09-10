
												$terms = get_field('discipline');
                                                 function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}



												//print_r($terms);
												foreach( $terms as $term): ?>
												<li class="<?php echo $term->slug; ?>">
                            <a class="word word-discipline disc-tit"
                                href="<?php echo 'http://ir.fortylove.vleaf.co.nz/artwork/' . seoUrl($artist_name) . '/?discipline=' . $term->slug ?>" style="">

												<?php





                                               $artwork_link = get_bloginfo( 'url' ) .'/artwork/'.$artwork->post_name;
                                               print_r($artwork);
                               

                                          echo $term->name;


