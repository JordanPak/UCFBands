<?php

/*
 *  UCFBands Theme Archive: Staff Members
 *    
 *  @author Jordan Pakrosnis
*/

// REMOVE SIDEBAR & STANDARD LOOP //
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action ('genesis_loop', 'genesis_do_loop');



// Add page header before content_sidebar_wrap
add_action( 'genesis_before_content_sidebar_wrap', 'ucfbands_page_header_manual' );

/*
 *  UCFBands Theme "Manual" Header
 *
 *  @author Jordan Pakrosnis
*/
function ucfbands_page_header_manual() {

    ?>

    <section class="page-header page-header-lg">

        <div class="page-header-inner">

            <h1 class="entry-title" itemprop="headline">Faculty &amp; Staff</h1>

        </div>

    </section>

    <?php

} // ucfbands_page_header_manual()



add_action( 'genesis_before_content', 'archive_masonry_grid');
/**
 * Archive Masonry Grid
 *
 * @author Jordan Pakrosnis
 * @link http://ucfbands.com/
 */
function archive_masonry_grid() {
    
    
    //-- CPT QUERY --//
    
    // Query Options
    $staff_args = array(
        'post_type'         => 'ucfbands_staff',
        'fields'            => 'ids',
        'order'             => 'ASC',
        'posts_per_page'    => 20,
        'paged'             => true,
    );
    
    // Query/Get Post IDs
    $staff = new WP_Query( $staff_args );
    
    
    // If there's Staff, do the grid
    if ( $staff->have_posts() ):
        
        
        // MASONRY GRID CONTAINER //
    
        // Column Layout
        $masonry_column_layout = '6col';

        // Use Layout Option with container output
        echo '<section class="masonry-' . $masonry_column_layout . '-grid">';
            echo '<div class="masonry-' . $masonry_column_layout . '-grid-sizer"></div>';
            echo '<div class="masonry-' . $masonry_column_layout . '-gutter-sizer"></div>';

        
        // Get Posts
        $staff = $staff->get_posts();
    
        
        //-- LOOP --//
        foreach( $staff as $staff_member ) {
            
            
            // Get Current Post
            $staff_member_post = get_post( $staff_member );


            // Get "Default" event meta (params get what we want)
            $staff_meta = ucfbands_staff_get_meta( $staff_member );
            
            
            // Format Biography
            apply_filters( 'the_content', $staff_meta['biography'] ) ;

            ?>
            
            <!-- MASONRY BLOCK -->
            <div class="block masonry-block masonry-block-size--one-half">

                
                <!-- POST THUMBNAIL -->
                <?php echo get_the_post_thumbnail( $staff_member, 'medium', array( 'class' => 'alignright staff-img' ) ); ?>
                    
                
                <!-- BLOCK TITLE -->
                <h3 class="block-header"><?php echo $staff_member_post->post_title; ?></h3>
                
                
                <!-- BLOCK CONTENT -->
                <div class="entry-content">
                    
                    <p>
                    
                        <!-- Position -->
                        <span class="staff-position"><b><i><?php echo $staff_meta['position']; ?></i></b></span><br>


                        <!-- Contact Info -->
                        <?php if ( $staff_meta['email'] ) { ?>

                            <br><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $staff_meta['email']; ?>" target="_blank"><?php echo $staff_meta['email']; ?></a>
                        
                        <?php } // endif ?>
                        
                        
                        <?php if ( $staff_meta['phone'] ) { ?>
                    
                            <br><i class="fa fa-phone"></i> <?php echo $staff_meta['phone']; ?>     
                    
                        <?php } //endif ?>
                        
                    </p>

                    <!-- Biography -->
                    <?php echo wpautop( $staff_meta['biography'] ); ?>
                
                </div><!-- /.entry-content -->


            </div><!-- / .block.masonry-block -->
            

            <?php
        
        } // end foreach
               
        
        // End Grid
        echo '</section>';
        
    
    
        // PAGINATION //
        ?>    
        
        <!-- Pagination Container -->
        <div class="archive-pagination pagination">
            <ul>
                
                <!-- Previous Posts -->
                <li><?php previous_posts_link( 'Previous' ); ?></li>
                
                <!-- Older Announcements -->
                <li><?php next_posts_link( 'Next' ); ?></li>

            </ul>
        </div><!-- /.archive-pagination.pagination -->
        
        <?php
    
    
    endif; // if posts found
    

} // archive_masonry_grid()



//-- INCLUDE MASONRY --//
require_once( CHILD_DIR . '/inc/masonry.php' );


//-- LOAD FRAMEWORK --//
genesis();
