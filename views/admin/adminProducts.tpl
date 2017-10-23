<h2>Управление товарами</h2>
<input type="button" onclick="createXML();" value="Сохранить в XML">
<div id="xml-place"></div>
<hr>
Импорт
<form action="/admin/loadfromxml/" method="POST" enctype="multipart/form-data">
    <input type="file" name="filename"><br>
    <input type="submit" value="Загрузить"><br>
</form>
<hr>
<table border='1' cellpadding='1' cellspacing='1'>
    <caption>Добавить продукт</caption>
    <tr>
        <th>Название</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Описание</th>
        <th>Сохранить</th>
    </tr>
    <tr>
        <td>
            <input type="edit" id="newItemName" value="">
        </td>
        <td>
            <input type="edit" id="newItemPrice" value="">
        </td>
        <td>
            <select id="newItemCatId">
                <option value="0">Главная категория
                {foreach $rsCategories as $itemCat}
                <option value="{$itemCat['id']}">{$itemCat['name']}
                {/foreach}
            </select>
        </td>
        <td>
            <textarea id="newItemDesc"></textarea>
        </td>
        <td>
            <input type="button" value="Сохранить" onclick="addProduct();">
        </td>
    </tr>
</table>
<table border='1' cellpadding='1' cellspacing='1'>
    <caption>Редактировать</caption>
    <tr>
        <th>№</th>
        <th>ID</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Описание</th>
        <th>Удалить</th>
        <th>Изображение</th>
        <th>Сохранить</th>
    </tr>
    {foreach $rsProducts as $item name=products}
        <tr>
            <td>{$smarty.foreach.products.iteration}</td>
            <td>{$item['id']}</td>
            <td>
                <input type="edit" id="itemName_{$item['id']}" value="{$item['name']}">
            </td>
            <td>
                <input type="edit" id="itemPrice_{$item['id']}" value="{$item['price']}">
            </td>
            <td>
                <select id="itemCatId_{$item['id']}">
                    <option value="0">Главная категория
                    {foreach $rsCategories as $itemCat}
                    <option value="{$itemCat['id']}" {if $item['category_id'] == {$itemCat['id']}} selected {/if}>{$itemCat['name']}
                    {/foreach}
                </select>
            </td>
            <td>
                <textarea id="itemDesc_{$item['id']}">{$item['description']}</textarea>
            </td>
            <td>
                <input type="checkbox" id="itemStatus_{$item['id']}" {if $item['status'] == 0} checked="checked"{/if}>
            </td>
            <td>
                {if $item['image']}
                    <img src="/images/products/{$item['image']}" width="100">
                {/if}
                <form action="/admin/upload/" method="POST" enctype="multipart/form-data">
                    <input type="file" name="filename"><br>
                    <input type="hidden" name="itemId" value="{$item['id']}">
                    <input type="submit" value="Загрузить"><br>
                </form>
            </td>
            <td>
                <input type="button" value="Сохранить" onclick="updateProduct('{$item['id']}');">
            </td>
        </tr>
    {/foreach}
</table>
