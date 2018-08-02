jQuery(document).ready(function(){
  //Menu burger
  /*
      The task of the script:
      - duplicate the list from the main menu to compose an adaptive menu;
      - delete the old menu;
      - add a button that will open and close the adaptive menu.
  */
  (function(){
      if(screen.width >=769){
        jQuery('#menu-toggle').remove();
        jQuery('#adaptive-menu').remove();
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
        jQuery('#adaptive-menu .menu').append(jQuery('#main-menu').children());           //add all eliment li of main-menu in adaptive-menu
        jQuery('.menu').remove('#main-menu');                                        //delete block with id=main-menu

        //button toggle adative-menu
        jQuery('#menu-toggle').on('click', function(){
            if(jQuery('#menu-toggle').hasClass('fa-bars')){
                jQuery('#menu-toggle').removeClass('fa-bars');
                jQuery('#menu-toggle').addClass('fa-close');
                jQuery('#adaptive-menu').show();
            }else{
                jQuery('#menu-toggle').removeClass('fa-close');
                jQuery('#menu-toggle').addClass('fa-bars');
                jQuery('#adaptive-menu').hide();
            }
        })
      }
  }());


  //Modal window
        jQuery('.open_modal').on('click', function(){
            jQuery('.dark-back-modal').show();
        });
        jQuery('.close-modal').on('click', function(){
            jQuery('.dark-back-modal').hide();
        });
  //end modal window

  //Hover on block
        if(screen.width <= 991){
            jQuery('.hover-on-block').on('click', function(){
                  jQuery('.hover-on-block').find('.active-hover').css('display','none');
                  jQuery(this).find('.active-hover').css('display','flex');
            });
        }
})
