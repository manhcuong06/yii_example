/*
	Add to cart fly effect with jQuery. - May 05, 2013
	(c) 2013 @ElmahdiMahmoud - fikra-masri.by
	license: http://www.opensource.org/licenses/mit-license.php
*/
var product_quantity = 0;
$('.add-to-cart').on('click', function () {
    var imgtodrag = $(this).parent('.item').find("img").eq(0);
    var cart = $('.shopping-cart');
    var quantity = $('.quantity');
    product_quantity++;
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
        .css({
        	top: imgtodrag.position().top + 80,
            left: imgtodrag.position().left,
            opacity: '0.5',
            position: 'absolute',
            height: '150px',
            width: '150px',
            zIndex: '100',
        })
        .appendTo($('body'))
        .animate({
            top: cart.position().top + 90,
            left: cart.position().left + 10,
            width: 75,
            height: 75,
        }, 1000, 'easeInOutExpo');

        setTimeout(function () {
            cart.effect("shake", {
            	times: 2
            }, 200);
            quantity.text(product_quantity);
        }, 1500);

        imgclone.animate({
            width: 0,
            height: 0,
        });
    }
});