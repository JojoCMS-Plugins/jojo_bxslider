{if $pg_body && !$filterslideshow}{$pg_body}{/if}
{if $slides}
<ul id="slider-{$slides[0].slideshowid}" class="slideshow">
	{foreach from=$slides item=s}<li>
	{if $s.titles && $s.title}<div class="slidetitle">{$s.title}</div>{/if}
	{if $s.image}{if $s.imagelink}<a href="{$s.imagelink}" rel="lightbox">{/if}<img src="{$SITEURL}/images/{$s.imagewidth}x{$s.imageheight}/{$s.image}" title="{$s.title}" alt="" />{if $s.imagelink}</a>{/if}
	{elseif $s.videourl}[[videoembed:{$s.videourl}:dim{$s.width}x{$s.height}]]{/if}
	{if $s.description}<div class="slidedescription">{$s.description}</div>{/if}
	</li>
	{/foreach}
</ul>
{/if}
