/**
 * UCFBands Genesis Child Theme
 * 
 * Masonry JS Init
 */

//jQuery(function($) {
//    var $container = $('section.masonry-blocks');
// 
//    $container.imagesLoaded( function(){
//        $container.masonry({
//            columnWidth: '.masonry-block-sizer',
//            gutter: '.masonry-gutter-sizer',
//            itemSelector: '.masonry-block',
//            percentPosition: true,
//            isAnimated: true,
//        });
//    });
//});


jQuery(function($) {
//    var $container = $('section.masonry-blocks');
 
    jQuery('.masonry-grid').masonry({
        itemSelector: '.masonry-block',
        columnWidth: '.masonry-grid-sizer',
        gutter: '.masonry-gutter-sizer',
        percentPosition: true,
    });
});

// Sizing Stuff: http://masonry.desandro.com/options.html#element-sizing
