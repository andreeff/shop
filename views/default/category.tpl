<h1>Товары категории {$rsCategory['name']}</h1>
{if $rsProducts || $rsChildCats !== null}
{foreach $rsProducts as $item name=products}
    <div style="float: left; padding: 0px 30px 40px 0px;">
        <a href="/product/{$item['id']}/">
            <img src="/images/products/{$item['image']}" width="100">
        </a><br>
        <a href="/product/{$item['id']}/">{$item['name']}</a>
    </div>
    {if $smarty.foreach.products.iteration mod 3 == 0}
        <div style="clear: both;"></div>
    {/if}
{/foreach}
{foreach $rsChildCats as $item}
    <h2><a href="/category/{$item['id']}/">{$item['name']}</a></h2>
{/foreach}
{else}
    <h2>Ничего не найдено</h2>
{/if}