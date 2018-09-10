var App = {
    isTouchDevice: "ontouchstart" in window,

    init: function () {
        scroll.init();
        contour.init();
        tab.init();
        accordion.init();
        // video.setup();
        bookingForm.init({
            container: 'fieldset.booking-1',
            dateFormat: 'dd.mm.yy',
            altFormat: 'dd.mm.yy',
            placeholder: true,
            today: new Date()
        });

        $("fieldset.table-reservation input.to").datepicker({
            dateFormat: 'dd.mm.yy',
            altFormat: 'dd.mm.yy',
            firstDay: 1,
            minDate: new Date()
        }).datepicker('setDate', new Date());

        $("fieldset.booking-1 input.from.hasDatepicker, fieldset.booking-1 input.to.hasDatepicker, fieldset.table-reservation input.book-a-restaurant-date").mousedown(function () {
            if ($(this).datepicker("widget").is(":visible")) {
                $(this).datepicker("hide");
            } else {
                $(this).datepicker("show");
            }
        });

        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        $("fieldset.booking-1 input.to.hasDatepicker").datepicker('setDate', tomorrow);

        subSubnav.init();
        shoppingList.init();
        hiResList.init();
        masonryGrid.init();
        fixedElements.init();
        perspective.init();

        animatedViewportEntry.init({
            container: '.box:not(.box-video):not(.box-slideshow):not(.box-16)',
            classToAdd: 'fadeInUp',
            scrollBox: '#wrapper'
        });
        animatedViewportEntry.init({
            container: '#corp-header',
            classToAdd: 'fadeInDown',
            scrollBox: '#wrapper'
        });
        animatedViewportEntry.init({
            container: 'ul.facts > li, ul.promo > li, ul.spot > li, div.moment > div, div.grid > div.grid-item, ul.info > li, ul.tips > li, ul.cols-4 > li, ul.hi-res-list > li, ul.items > li, ul.arrangements > li',
            classToAdd: 'animate',
            scrollBox: '#wrapper'
        });

        evalForm.init();

        $(window)
            .bind('load', function () {
                // FlexSlider
                slideshow.init({
                    container: '.slideshow',
                    controlNav: false,
                    slideshowSpeed: 6000
                });
                mono.init({
                    container: '.mono-carousel.suggestions',
                    slideshowSpeed: 6000,
                    slideshow: true,
                    controlNav: false,
                    directionNav: true,
                    slidesNumber: false
                });
                carousel.init({
                    mobile: [768, 1],
                    tablet: [1024, 2],
                    items: 3
                });

                // QuickBooking restaurant on sidebar:
                $("fieldset.table-reservation").find("div:first-child > select").change(function (event, data) {
                    // If selected restaurant index change then change submit href:
                    var selectedValue = $(this).val();
                    $("fieldset.table-reservation").find("div.input-submit > a").attr("href", selectedValue);
                });
            });
    }
};

var perspective = {
    init: function () {
        var $perspectiveWrapper = $('#perspective');

        $('#showMenu, #showBook').click(function (ev) {
            perspective.change($(this).attr('id')); //custom
            perspective.open(ev, $perspectiveWrapper);
        });

        $('#freezer').click(function (ev) {
            perspective.close(ev, $perspectiveWrapper);
        });

        //custom
        perspective.menu();
        perspective.bookingPanels();
    },

    open: function (ev, $perspectiveWrapper) {
        $perspectiveWrapper.addClass('modalview').addClass('animate');

        //custom
        $('#nav').removeClass().addClass('open');
    },

    close: function (ev, $perspectiveWrapper) {
        $perspectiveWrapper.removeClass('animate');
        setTimeout(function () { $perspectiveWrapper.removeClass('modalview') }, 400); //durata transform

        //custom
        $('#nav').removeClass().addClass('close');
    },

    //custom
    menu: function () {
        $('#nav > div:first-child a').click(function () {
            perspective.change($(this).attr('class'));
        })
    },
    //custom
    change: function (classe) {
        $('#perspective').removeClass().addClass(classe);
    },
    //custom
    bookingPanels: function () {
        $("#perspective #nav>div:nth-child(2)>ul:last-child li a[href='javascript:;']").click(function () {
            if (!$(this).hasClass('selected')) {
                $(this).closest('ul').find("li a[href='javascript:;']").removeClass('selected').next().slideUp('fast');
            }
            $(this).toggleClass('selected').next().slideToggle('fast');
        });
    }
}

var fixedElements = {
    init: function () {
        var scrollBarWidth = fixedElements.getScrollBarWidth();

        // $('#wrapper').bind('scroll', function () {
        //     var $top = $('#top'),
        //         $subnav = $('#wrapper .subnav'),
        //         $third = $('.third-level-menu'),
        //         topHeight = $top.height();

        //     if ($(this).find('> *:first-child').offset().top < 0) {
        //         if (!($top.hasClass('is_stuck'))) {
        //             $top.addClass('is_stuck');
        //         }
        //     }
        //     if ($(this).find('> *:first-child').offset().top >= 0) {
        //         $top.removeClass('is_stuck');
        //     }


        //     if (($subnav.length > 0) && ($subnav.height() != 0)) {
        //         if ($subnav.offset().top < (topHeight - $subnav.height())) {
        //             if ($('#container > .subnav').length == 0) {
        //                 $subnav
        //                 .clone()
        //                 .hide()
        //                 .appendTo("#container")
        //                 .addClass('is_stuck')
        //                 .fadeIn('fast');
        //             }
        //         } else {
        //             $('#container > .subnav').fadeOut('fast').remove();
        //         }
        //     }

        //     if (($third.length > 0) && !$('#sub-subnav-list').is(':visible')) {
        //         if ($third.offset().top < 0) {
        //             $('#sub-subnav-tab').fadeIn('fast')
        //         } else {
        //             $('#sub-subnav-tab').fadeOut('fast')
        //         }
        //     }
        //     $top.css('right', scrollBarWidth);
        //     $subnav.css('right', scrollBarWidth);
        //     $('#sub-subnav-tab, #sub-subnav-list').css('right', scrollBarWidth);
        // }).scroll();

        //==========
        $('#wrapper').scroll(function () {
            var winWidth = $(window).width();
            //if(winWidth>767)
            //{
              var headerHeight = $('.home-landing').height();
              if($(this).scrollTop() > headerHeight)
              {
                  if (!$('#top').hasClass('is_stuck'))
                  {
                      $('#top').stop().addClass('is_stuck').css('top', '0').animate(
                          {
                              'top': '0px'
                          }, 500);
                  }
              }
              else
              {
                  $('#top').removeClass('is_stuck');
                  if($(this).scrollTop() == 0){
                    $('#top').css('top', '40px');
                  }else{
                      $('#top').css('top', '0px');
                      // $('#top').animate(
                      // {
                      //   'top': '0px'
                      // }, 500);
                  }
                  
              }
            //}

        });
        //==========
    },
    getScrollBarWidth: function () {
        var containerEl = $('#wrapper')[0];
        var scrollbarWidth = containerEl.offsetWidth - containerEl.clientWidth;
        return scrollbarWidth;
    }
}

var subSubnav = {
    init: function () {
        subSubnav.open();
        subSubnav.close();
    },
    open: function () {
        $('#sub-subnav-tab').click(function () {
            $(this).hide(0, function () {
                $('#sub-subnav-list').show();
            });
        });
    },
    close: function () {
        $('#sub-subnav-list').click(function () {
            $('#sub-subnav-list').hide(0, function () {
                if ($('.third-level-menu').offset().top < 0) {
                    $('#sub-subnav-tab').show();
                }
            });
        })
    }
}

//scroll down (video / slideshow)
var scroll = {
    init: function () {
        $('.scrollable > a.scroll').click(function () {
            var n = $('#top').height();
            var $o = $(this).closest('.box').next('div');
            var m = $o.css('margin-top').replace('px', '');
            $('#wrapper').animate({
                scrollTop: ($o.offset().top - (parseInt(n) + parseInt(m)))
            }, 750, 'easeInOutExpo');
        })
    }
}

var bookingFormApp = {
    send: function (container, today, el) {
        var $el = $(el),
            $container = $el.closest(container),
            arrival = $container.find('.from').datepicker("getDate"),
            departure = $container.find('.to').datepicker("getDate"),
            adults = $container.find('.adults').val(),
            children = $container.find('.children').val(),
            promo = $container.find('.promo').val(),
            url = $el.attr('href');

        if (promo == null) { promo = '' }
        if (arrival == null) { arrival = today }
        if (departure == null) {
            departure = new Date(bookingForm.tomorrow(today));
        }

        if ($container.hasClass("booking-1")) {
            var nights = (departure - arrival) / 1000 / 60 / 60 / 24;
            arrival = arrival.getFullYear() + '-' + ("0" + parseInt(arrival.getMonth() + 1)).slice(-2) + '-' + ("0" + arrival.getDate()).slice(-2);
            departure = departure.getFullYear() + '-' + ("0" + parseInt(departure.getMonth() + 1)).slice(-2) + '-' + ("0" + departure.getDate()).slice(-2);
            url += '&from=' + arrival + '&to=' + departure + '&adults=' + adults + '&numchild1=' + children + '&promo=' + promo;
        } else if ($container.hasClass("table-reservation")) {

            // Table reservation:
            url += "&day=" + ("0" + departure.getDate()).slice(-2) + "&month=" + ("0" + parseInt(departure.getMonth() + 1)).slice(-2) + "&year=" + departure.getFullYear() + "&time=Abend&guest[P]=" + adults;
        }

        window.open(url);
        return false;
    }
}

var shoppingList = {
    init: function () {
        $('.shopping-list a[data-pos]').click(function () {
            mono.openInOverlay($(this).data('pos'), $('.shopping-list').data('url'), 0, false, '', false, true, false, this);
        })
    }
}

var hiResList = {
    init: function () {
        $('.hi-res-list a').click(function () {
            mono.openInOverlay($(this).parent().index(), $(this).closest('ul.hi-res-list').data('url'), 0, false, '', false, true, false, this);
        })
    }
}

var evalForm = {
    init: function () {
        var form = $("#evaluation-form").show();
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.after(error); }//,
        });

        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            labels:
            {
                finish: $("#evaluation-form").data('validate-finish'),
                next: $("#evaluation-form").data('validate-next'),
                previous: $("#evaluation-form").data('validate-previous'),
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                form.submit();
            }
        });

        $('.required').each(function () {
            $(this).rules("add", {
                messages: {
                    email: $("#evaluation-form").data('validate-email'),
                    required: $("#evaluation-form").data('validate-required')
                }
            });
        });
    }
}

App.init();