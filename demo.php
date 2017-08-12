<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        jQuery.noConflict();
    </script>
</head>
<body>

<style>
    #vr-1 .thumbnail {
        height: 270px;
        width: 200px;
        list-style: none;
        float: left;
        margin: 15px;
        background-size: cover;
        cursor: pointer;
        padding: 2px;
    }

    #vr-1 .thumbnail.sel {
        border: 2px solid darkred;
        padding: 0px;
    }

    #vr-1 .please-open {
        height: 300px;
        width: 400px;
        position: absolute;
        top: calc(50% - 150px);
        left: calc(50% - 200px);
        background-color: #ffffff;
        border: 1px solid green;
        text-align: center;
    }
    #vr-1 .please-open .note {
        padding: 20px;
    }

    #vr-1 .please-open #qr-close {
        width: 100px;
        height: 50px;
        font-size: 16px;
    }

</style>
<div id="vr-1">
    <ul class="vr-thumbnails">
        <li class="thumbnail" data-url="10vr.JPG"></li>
        <li class="thumbnail" data-url="11vr.JPG"></li>
        <li class="thumbnail" data-url="12vr.JPG"></li>
        <li class="thumbnail" data-url="13vr.JPG"></li>
        <li class="thumbnail" data-url="14vr.JPG"></li>
        <li class="thumbnail" data-url="15vr.JPG"></li>
        <li class="thumbnail" data-url="16vr.JPG"></li>
        <li class="thumbnail" data-url="17vr.JPG"></li>
    </ul>

    <div class="please-open" id="qr-dialog" style="display:none;">
        <div class="note">Please open this QR code on yor devices browser:</div>
        <img class="qr" src="#">
        <div class="close-btn">
            <input type="button" id="qr-close" value="Ok">
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function() {
        // Lets set thumbnail background
        jQuery(".vr-thumbnails li").each(function() {
            jQuery(this).css( 'background-image', 'url(http://virtu.mobi:9000/vrimage/' + jQuery(this).data("url") + ')');
            jQuery(this).click(function(){

                //add selected class
                jQuery(".vr-thumbnails li").removeClass("sel");
                jQuery(this).addClass("sel");

                jQuery.post("http://local.virtu.test:9000/v1/vr", { email: "session", image: encodeURI(jQuery(this).data("url")) })
                    .done(function( data ) {
                        if (data.code == 1) {
                            // Mobile view is not open
                            jQuery("#vr-1 .please-open").show();
                            jQuery("#vr-1 .qr").attr('src', data.data);
                        }
                    });
            });
        });

        //close button
        jQuery('#qr-close').click(function(){
            jQuery('#qr-dialog').hide();
        });
    });
</script>

</body>
</html>
