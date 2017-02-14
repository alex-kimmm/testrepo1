$(document).ready(function(){
    sidebar.init();
    // $('#datetimepicker1').datetimepicker({
    //     allowInputToggle:true,
    //     format: 'DD/MM/YYYY'
    // });

    $(".gadget-cover").click(function(e){
        $(".gadget-cover").css('z-index',3);
        $(".card-text").css('z-index',2);
        $(".gadget-card").css('z-index',1);
    })

    $(".gadget-card").click(function(e){
        $(".gadget-card").css('z-index',3);
        $(".card-text").css('z-index',2);
        $(".gadget-cover").css('z-index',1);
    })

    $(".card-text").click(function(e){
        $(".card-text").css('z-index',3);
        $(".gadget-card").css('z-index',2);
        $(".gadget-cover").css('z-index',1);
    })
})

var sidebar = {
    init: function() {
        $("a#card-cover-open").click(function(e){
            e.preventDefault();
            sidebar.toggle();
        });
    },
    toggle: function() {
        if($('.box-wrapper').hasClass('loading')) {
            $(".box-wrapper").show();
            $(".box-wrapper .box").css('height',$(".excess").css('height'));
            $(".box-wrapper .box").css('width',$(window).width()/2);
            //$(".box-wrapper").css('z-index',parseInt($('.insurance-form').css('z-index'));
            $('.box-wrapper').removeClass('loading');
            $('.gadget-card').addClass('active');
            $('.gadget-card').addClass('animated');
            $('.gadget-card .open-bg-container').css('visibility','hidden');
            setTimeout(function(){
                $('img#gadget-card-plus').fadeIn('fast');
            },400)


        } else {
            $('.box-wrapper').addClass('loading');
            $('.gadget-card').removeClass('active');
            $('.gadget-card').removeClass('animated');
            $('.gadget-card').addClass('dismissed');
            $('img#gadget-card-plus').hide();
            $('.gadget-card .open-bg-container').css('visibility','visible');
        }
    }
};