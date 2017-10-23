<div id="jf-content">
    <div class="gallery" id="image_detail">
    <div>
        <h3 class="jg_imgtitle" id="jg_photo_title">{$rsProduct['name']}</h3>
    </div>
    <div class="jg_back" id="jg_back_detail">
        <a href="/">back</a>
    </div>
    <div style="text-align: center;" class="jg_dtl_photo" id="jg_dtl_photo">
        <img width="675" height="600" id="jg_photo_big" class="jg_photo" src="/images/products/{$rsProduct['image']}">
    </div>
    <div class="jg_detailnavi">
        <div class="jg_iconbar" style="font-size: 12px;">
        <a id="addCart_{$rsProduct['id']}" {if $itemIncart}style="display: none;"{/if} href="#" onclick="addToCart({$rsProduct['id']}); return false;" alt="Добавить в корзину">Добавить в корзину</a>
        <a id="removeCart_{$rsProduct['id']}" {if !$itemIncart}style="display: none;"{/if} href="#" onclick="removeFromCart({$rsProduct['id']}); return false;" alt="Удалить из корзины">Удалить из корзины</a>
        </div>
    </div>
    <div class="jg_details">
    <div class="sectiontableentry1" style="font-size: 20px; padding-top: 20px;">
        <div class="jg_photo_left">
            Стоимость
        </div>
        <div class="jg_photo_right" id="jg_photo_author">
            {$rsProduct['price']}
        </div>
    </div>
    </div>
    <div style="clear:both;"></div>
    <div id="jg_photo_description_label" style="padding-top:20px;">Описание</div>
    <div id="jg_photo_description">
        <p>{$rsProduct['description']}</p>
    </div>
    <div class="sectiontableheader">
        &nbsp;
    </div>
</div>
</div>
