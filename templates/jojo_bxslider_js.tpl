$(document).ready(function(){ldelim}
    var slider{$slideshow.slideshowid} = $('#slider-{$slideshow.slideshowid}').bxSlider({ldelim}
        mode: '{$slideshow.transition}',
        speed: {$slideshow.speed},{if !$slideshow.loop}
        infiniteLoop: false,{/if}{if $slideshow.random}
        randomStart: true,{/if}{if !$slideshow.controls}
        controls: false,{/if}{if $slideshow.captions}
        captions: true,{/if}{if $slideshow.auto}
        auto: true,
        pause: {$slideshow.pause},{if $slideshow.autocontrols}
        autoControls: true,{/if}{if $slideshow.autostart}
        autoStart: true,{/if}{if $slideshow.autohoverpause}
        autoHover: true,{/if}{/if}{if $slideshow.pager}
        pager: true,{if !$slideshow.pagerbottom}
        pagerLocation: 'top',{/if}{/if}{if $slideshow.ticker}
        ticker: true,
        tickerspeed: {$slideshow.speed},{if $slideshow.tickerhoverpause}
        tickerHover: true,{/if}{/if}{if $slideshow.controls && !$slideshow.loop}
        hideControlOnEnd: true,{/if}
        displaySlideQty: {$slideshow.slidedisplayqty},
        moveSlideQty: {$slideshow.slidemoveqty}{if $slideshow.pager},
        buildPager: function(slideIndex){ldelim}
          switch (slideIndex){ldelim}
            {foreach from=$slides key=k item=s}case {$k}:
              return {if $slideshow.pagerimages}'<img src="{$SITEURL}/images/{$s.thumbimagesize}/{if $s.thumbimage}slides/{$s.thumbimage}{else}{$s.image}{/if}" /><span>{if $s.titles && $s.title}{$s.title}{/if}</span>'{else}
              '<span>{if $s.titles && $s.title}{$s.title}{else}{$k+1}{/if}</span>'{/if};
            {/foreach}
          {rdelim}
        {rdelim}
        {/if}
    {rdelim});

    $(document).keydown(function(e){ldelim}
        if (e.keyCode == 37) {ldelim}
            slider{$slideshow.slideshowid}.goToPreviousSlide();
            return false;
        {rdelim} else if (e.keyCode == 39) {ldelim}
            slider{$slideshow.slideshowid}.goToNextSlide();
            return false;
        {rdelim}
    {rdelim});
{rdelim});
