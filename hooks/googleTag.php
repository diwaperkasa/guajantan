<?php

function google_tag_script()
{
?>
    <script async src="https://www.googletagmanager.com/gtm.js?id=GTM-TWFMJKR4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    </script>
<?php
}

add_action('wp_head', 'google_tag_script', 0);