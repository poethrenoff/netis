$(function(){
    var eliteProduct_tt = null;
    var eliteProductCurrent = 0;
    var $eliteProduct = $('#eliteProduct');
    var $eliteProducts = $eliteProduct.find('div.products');
    
    $eliteProduct.mouseover(function(){
        clearInterval(eliteProduct_tt);
    }).mouseout(function(){
        eliteProduct_tt = setInterval(function(){
            if (eliteProductCurrent < $eliteProducts.length - 1) {
                eliteProductCurrent++;
            } else {
                eliteProductCurrent = 0;
            }
            $eliteProducts.hide();
            $eliteProducts.eq(eliteProductCurrent).show();
        }, 3000);
    }).mouseout();
});
