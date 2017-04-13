/**
 * Created by m_bryo on 1/15/17.
 */
$(document).ready(function(){
    $('.carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        autoplay: true,
        autoplaySpeed: 2000
});

    $('#date').datepick({dateFormat: 'D, d MM yyyy'});
    $('input').blur(function () {
        if($(this).val().length > 0 ){
            $(this).siblings('em').addClass('filled');

        }
    })
    $('input').each(function () {
        if($(this).val().length > 0 ){
            $(this).siblings('em').addClass('filled');

        }
    })
});