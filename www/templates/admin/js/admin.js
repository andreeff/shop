/**
 * Получение данных с формы
 * 
 */
function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
        if(this.name && this.name != ''){
            hData[this.name] = this.value;
            console.log('hData[' + this.name + '] = ' + hData[this.name]);
        }
    });
    return hData;
}

function newCategory(){
    var postData = getData('#blockNewCategory');
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/addnewcat/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newCategoryName').val('');
            } else {
                alert(data['message']);
            }
        }
    });
}

function updateCat(itemId){
    var parentId = $('#parentId_'+itemId).val();
    var newName = $('#itemName_'+itemId).val();
    var postData = {itemId: itemId, parentId: parentId, newName: newName};
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatecategory/",
        data: postData,
        dataType: 'json',
        success: function(data){
                alert(data['message']);
        }
    });
}
/**
 * добавление продукта
 */
function addProduct(){
    var itemName = $('#newItemName').val();
    var itemPrice = $('#newItemPrice').val();
    var itemDesc = $('#newItemDesc').val();
    var itemCatId = $('#newItemCatId').val();
    var postData = {itemName: itemName, itemPrice: itemPrice, itemDesc: itemDesc, itemCatId: itemCatId};
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/addproduct/",
        data: postData,
        dataType: 'json',
        success: function(data){
                alert(data['message']);
                if (data['success']){
                    $('#newItemName').val('');
                    $('#newItemPrice').val('');
                    $('#newItemDesc').val('');
                    $('#newItemCatId').val('');
                }
            }
    });
}

/**
 * Изменение данных продукта
 */
function updateProduct(itemId){
    var itemName = $('#itemName_'+itemId).val();
    var itemPrice = $('#itemPrice_'+itemId).val();
    var itemCatId = $('#itemCatId_'+itemId).val();
    var itemDesc = $('#itemDesc_'+itemId).val();
    var itemStatus = $('#itemStatus_'+itemId).attr('checked');
    if (!itemStatus){
        itemStatus = 1;
    } else {
        itemStatus = 0;
    }
    var postData = {itemId: itemId, itemName: itemName, itemPrice: itemPrice, itemCatId: itemCatId, itemDesc: itemDesc, itemStatus: itemStatus};
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/updateproduct/",
       data: postData,
       dataType: 'json',
       success: function(data){
           alert(data['message']);
       }
    });
}

/**
 * показать ил скрыть данные о заказе
 */
function showProducts(id){
    var objName = "#purchaseForOrderId_"+id;
    if ($(objName).css('display') != 'table-row'){
        $(objName).show();
    } else {
        $(objName).hide();
    }
}

function updateOrderStatus(itemId){
    var status = $('#itemStatus_'+itemId).attr('checked');
    if (!status){
        status = 0;
    } else {
        status = 1;
    }
    var postData = {itemId: itemId, status: status};
    $.ajax({
       type: 'POST',
       async: false,
       url: '/admin/setorderstatus/',
       data: postData,
       dataType: 'json',
       success: function(data){
           if (!data['success']){
               alert(data['message']);
           }
       }
    });
}

function updateOrderDatePayment(itemId){
    var datePayment = $('#datePayment_'+itemId).val();
    var postData = {itemId: itemId, datePayment: datePayment};
    $.ajax({
       type: 'POST',
       async: false,
       url: '/admin/setorderdatepayment/',
       data: postData,
       dataType: 'json',
       success: function(data){
           if (!data['success']){
               alert(data['message']);
           }
       }
    });
}

function createXML(){
    $.ajax({
       type: 'POST',
       async: false,
       url: '/admin/createxml/',
       dataType: 'html',
       success: function(data){
           $('#xml-place').html(data);
           window.open('http://www.myshop.local/xml/products.xml', '_blank');
       }
    });
}