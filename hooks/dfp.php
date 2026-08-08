<?php

function dfp_script()
{
?>
    <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
    <script>
        const gptadslots = [];
        var googletag = googletag || {
            cmd: []
        };
    </script>
    <script>
        googletag.cmd.push(function() {
            const dfpTarget = <?= json_encode(get_dfp_targets()) ?>;
            const adId = '21837625142';

            const mapping = googletag.sizeMapping()
                .addSize([1024, 768], [
                    [960, 300]
                ])
                .addSize([768, 0], [
                    [960, 300]
                ])
                .addSize([320, 0], [
                    [400, 500],
                    [375, 500]
                ])
                .build();

            const mapping_header = googletag.sizeMapping()
                .addSize([1024, 768], [
                    [1280, 300]
                ])
                .addSize([768, 0], [
                    [1280, 300]
                ])
                .addSize([320, 0], [
                    [375, 225],
                    [400, 225]
                ])
                .build();

            const mapping_vertical = googletag.sizeMapping()
                .addSize([1024, 768], [
                    [300, 600]
                ])
                .build();
            // Adslot 1 declaration
            gptadslots.push(googletag.defineSlot(`/${adId}/header`, [
                    [1280, 300],
                    [375, 225],
                    [400, 225]
                ], 'div-gpt-ad-header')
                .defineSizeMapping(mapping_header)
                .setTargeting('tag', dfpTarget)
                .addService(googletag.pubads()));
            // Adslot 2 declaration
            gptadslots.push(googletag.defineSlot(`/${adId}/top-lb`, [
                    [375, 500],
                    [960, 300],
                    [400, 500]
                ], 'div-gpt-ad-top-lb')
                .defineSizeMapping(mapping)
                .setTargeting('tag', dfpTarget)
                .addService(googletag.pubads()));
            // Adslot 3 declaration
            gptadslots.push(googletag.defineSlot(`/${adId}/mid-lb`, [
                    [375, 500],
                    [960, 300],
                    [400, 500]
                ], 'div-gpt-ad-mid-lb')
                .defineSizeMapping(mapping)
                .setTargeting('tag', dfpTarget)
                .addService(googletag.pubads()));
            // Adslot 4 declaration
            gptadslots.push(googletag.defineSlot(`/${adId}/bottom-lb`, [
                    [400, 500],
                    [375, 500],
                    [960, 300]
                ], 'div-gpt-ad-bottom-lb')
                .defineSizeMapping(mapping)
                .setTargeting('tag', dfpTarget)
                .addService(googletag.pubads()));
            // Adslot 5 declaration (Vertical Banner)
            gptadslots.push(googletag.defineSlot(`/${adId}/halfpage`, [
                    [300, 600],
                    [300, 600]
                ], 'div-gpt-ad-halfpage')
                .defineSizeMapping(mapping_vertical)
                .setTargeting('tag', dfpTarget)
                .addService(googletag.pubads()));

            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.pubads().setCentering(true);
            googletag.enableServices();
            // This listener will be called when a slot has finished rendering.
            googletag.pubads().addEventListener("slotRenderEnded", (event) => {
                const slotId = event.slot.getSlotElementId();

                if (event.advertiserId) {
                    const width = document.querySelector(`#${slotId}`).offsetWidth;
                    const iframe = document.querySelector(`#${slotId} iframe`);
                    const head = iframe.contentWindow.document.head;
                    const style = iframe.contentWindow.document.createElement('style');
                    const css = `.GoogleActiveViewElement img { max-width: ${width}px; width: 100%; height: auto; }`;

                    head.appendChild(style);

                    if (style.styleSheet) {
                        // This is required for IE8 and below.
                        style.styleSheet.cssText = css;
                    } else {
                        style.appendChild(document.createTextNode(css));
                    }
                }
            });
        });
    </script>
<?php
}

add_action('wp_head', 'dfp_script', 20);