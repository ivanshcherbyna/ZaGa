$(document).ready(function(){
  //Menu burger
  /*
      The task of the script:
      - duplicate the list from the main menu to compose an adaptive menu;
      - delete the old menu;
      - add a button that will open and close the adaptive menu.
  */
  (function(){
      if(screen.width >=769){
        $('#menu-toggle').remove();
        $('#adaptive-menu').remove();
      }
      if(screen.width <=768){
        /* structure HTML in block with id=adaptive-menu*/
        var adaptiveMenu =
            '<div class="container">' +
                '<ul class="menu">' +
                  //list li
                '</ul>'+
            '</div>'
        ;
        /*end structure HTML*/

        document.getElementById('adaptive-menu').innerHTML = adaptiveMenu;      // generation structure HTML in block with id=adaptive-menu
        $('#adaptive-menu .menu').append($('#main-menu').children());           //add all eliment li of main-menu in adaptive-menu
        $('.menu').remove('#main-menu');                                        //delete block with id=main-menu

        //button toggle adative-menu
        $('#menu-toggle').on('click', function(){
            if($('#menu-toggle').hasClass('fa-bars')){
                $('#menu-toggle').removeClass('fa-bars');
                $('#menu-toggle').addClass('fa-close');
                $('#adaptive-menu').show();
            }else{
                $('#menu-toggle').removeClass('fa-close');
                $('#menu-toggle').addClass('fa-bars');
                $('#adaptive-menu').hide();
            }
        })
      }
  }());


  //Modal window
        $('.open_modal').on('click', function(){
            $('.dark-back-modal').show();
        });
        $('.close-modal').on('click', function(){
            $('.dark-back-modal').hide();
        });
  //end modal window

  //Hover on block
        if(screen.width <= 991){
            $('.hover-on-block').on('click', function(){
                  $('.hover-on-block').find('.active-hover').css('display','none');
                  $(this).find('.active-hover').css('display','flex');
            });
        }
})
