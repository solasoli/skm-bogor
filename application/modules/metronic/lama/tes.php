
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Popup iframes - jQuery Mobile Demos</title>
    <link rel="stylesheet" href="http://127.0.0.1/siklinik/vendor/jmobile/jquery.mobile-1.4.5.min.css">
    <script src="http://127.0.0.1/siklinik/vendor/jmobile/jquery.min.js"></script>
    <script src="http://127.0.0.1/siklinik/vendor/jmobile/jquery.mobile-1.4.5.min.js"></script>
    <script id="map-script">
        
// popup examples
$( document ).on( "pagecreate", function() {

    // The window width and height are decreased by 30 to take the tolerance of 15 pixels at each side into account
    function scale( width, height, padding, border ) {
        var scrWidth = $( window ).width() - 30,
            scrHeight = $( window ).height() - 30,
            ifrPadding = 2 * padding,
            ifrBorder = 2 * border,
            ifrWidth = width + ifrPadding + ifrBorder,
            ifrHeight = height + ifrPadding + ifrBorder,
            h, w;

        if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
            w = ifrWidth;
            h = ifrHeight;
        } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
            w = scrWidth;
            h = ( scrWidth / ifrWidth ) * ifrHeight;
        } else {
            h = scrHeight;
            w = ( scrHeight / ifrHeight ) * ifrWidth;
        }

        return {
            'width': w - ( ifrPadding + ifrBorder ),
            'height': h - ( ifrPadding + ifrBorder )
        };
    };

    $( ".ui-popup iframe" )
        .attr( "width", 0 )
        .attr( "height", "auto" );

    $( "#popupMap iframe" ).contents().find( "#map_canvas" )
        .css( { "width" : 0, "height" : 0 } );

    $( "#popupMap" ).on({
        popupbeforeposition: function() {
            var size = scale( 540, 320, 0, 1 ),
                w = size.width,
                h = size.height;

            $( "#popupMap iframe" )
                .attr( "width", w )
                .attr( "height", h );

            $( "#popupMap iframe" ).contents().find( "#map_canvas" )
                .css( { "width": w, "height" : h } );
        },
        popupafterclose: function() {
            $( "#popupMap iframe" )
                .attr( "width", 0 )
                .attr( "height", 0 );

            $( "#popupMap iframe" ).contents().find( "#map_canvas" )
                .css( { "width": 0, "height" : 0 } );
        }
    });
});        
    </script>

</head>
<body>


                <a href="#popupMap" data-rel="popup" data-position-to="window" >Open Map</a>

                <div data-role="popup" id="popupMap" data-overlay-theme="a" data-theme="a" data-corners="false" data-tolerance="15,15">
                    <a href="#" data-rel="back" class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                    <iframe src="http://127.0.0.1"></iframe>
                </div>

</body>
</html>
