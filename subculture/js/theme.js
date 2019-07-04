jQuery(document).ready(function(){
    imagesLoaded('section.massonry', function(){
        jQuery('section.massonry .row').masonry({
            itemSelector        : '.item',
            columnWidth         : '.item',
            transitionDuration  : 0
        });
    });
});
