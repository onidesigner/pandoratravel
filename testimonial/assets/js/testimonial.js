(function ($) {
    'use strict';
    $(function () {
        preFunction();
        $(document).on('mouseover', '.tss-isotope-button-wrapper .rt-iso-button',
            function () {
                var self = $(this),
                    count = self.attr('data-filter-counter'),
                    id = self.parents('.tss-wrapper').attr('id');
                console.log(count);
                $tooltip = '<div class="tss-tooltip" id="tss-tooltip-' + id + '">' +
                    '<div class="tss-tooltip-content">' + count + '</div>' +
                    '<div class="tss-tooltip-bottom"></div>' +
                    '</div>';
                $('body').append($tooltip);
                var $tooltip = $('body > .tss-tooltip');
                var tHeight = $tooltip.outerHeight();
                var tBottomHeight = $tooltip.find('.tss-tooltip-bottom').outerHeight();
                var tWidth = $tooltip.outerWidth();
                var tHolderWidth = self.outerWidth();
                var top = self.offset().top - (tHeight + tBottomHeight);
                var left = self.offset().left;
                $tooltip.css({
                    'top': top + 'px',
                    'left': left + 'px',
                    'opacity': 1
                }).show();
                if (tWidth <= tHolderWidth) {
                    var itemLeft = (tHolderWidth - tWidth) / 2;
                    left = left + itemLeft;
                    $tooltip.css('left', left + 'px');
                } else {
                    var itemLeft = (tWidth - tHolderWidth) / 2;
                    left = left - itemLeft;
                    if (left < 0) {
                        left = 0;
                    }
                    $tooltip.css('left', left + 'px');
                }
            })
            .on('mouseout', '.tss-isotope-buttons .rt-iso-button', function () {
                $('body > .tss-tooltip').remove();
            });
    });

    $(window).on('load resize', function () {
        preFunction();
    });

    function preFunction() {
        HeightResize();
        overlayIconResize();
    }
    $('.tss-wrapper').each(function () {
        var container = $(this);
        var str = $(this).attr("data-layout");
        console.log(str);
        if (str) {
            var qsRegex,
                buttonFilter,
                Iso = container.find(".tss-isotope"),
                caro = container.find('.tss-carousel'),
                html_loading = '<div class="rt-loading-overlay"></div><div class="rt-loading rt-ball-clip-rotate"><div></div></div>',
                preLoader = container.find('.tss-pre-loader');
            if (preLoader.find('.rt-loading-overlay').length == 0) {
                preLoader.append(html_loading);
            }
            if (caro.length) {
                var items = caro.data('items-desktop'),
                    tItems = caro.data('items-tab'),
                    mItems = caro.data('items-mobile'),
                    loop = caro.data('loop'),
                    nav = caro.data('nav'),
                    dots = caro.data('dots'),
                    autoplay = caro.data('autoplay'),
                    autoPlayHoverPause = caro.data('autoplay-hover-pause'),
                    autoPlayTimeOut = caro.data('autoplay-timeout'),
                    autoHeight = caro.data('auto-height'),
                    lazyLoad = caro.data('lazy-load'),
                    rtl = caro.data('rtl'),
                    smartSpeed = caro.data('smart-speed');
                caro.imagesLoaded(function () {
                    if (str === 'carousel11' || str === 'carousel12') {
                        var images = [];
                        caro.find('.tss-grid-item').each(function () {
                            var imgItem = $(this).find('.profile-img-wrapper').remove();
                            images.push(imgItem);
                        });
                        var caroThumbs = $("<div class='tss-carousel-thumb' />");
                        $.map(images, function (img) {
                            caroThumbs.append(img);
                        });
                        if (str === 'carousel11') {
                            caro.parent().prepend(caroThumbs);
                        } else {
                            caro.parent().append(caroThumbs);
                        }
                        caroThumbs.imagesLoaded(function () {

                            caro.slick({
                                infinite: !!loop,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                prevArrow: '<span class="rt-slick-nav rt-prev"><i class="fa fa-chevron-left"></i></span>',
                                nextArrow: '<span class="rt-slick-nav rt-next"><i class="fa fa-chevron-right"></i></span>',
                                arrows: !!nav,
                                dots: !!dots,
                                autoplay: !!autoplay,
                                autoplaySpeed: autoPlayTimeOut ? autoPlayTimeOut : 5000,
                                adaptiveHeight: !!autoHeight,
                                pauseOnHover: !!autoPlayHoverPause,
                                asNavFor: caroThumbs
                            });

                            caroThumbs.slick({
                                slidesToShow: items ? items : 3,
                                slidesToScroll: 1,
                                asNavFor: caro,
                                dots: false,
                                arrows: false,
                                centerMode: true,
                                centerPadding: '0px',
                                focusOnSelect: true,
                                responsive: [
                                    {
                                        breakpoint: 767,
                                        settings: {
                                            slidesToShow: tItems ? tItems : 2,
                                            slidesToScroll: 1
                                        }
                                    },
                                    {
                                        breakpoint: 480,
                                        settings: {
                                            slidesToShow: mItems ? mItems : 1,
                                            slidesToScroll: 1
                                        }
                                    }
                                ]
                            });
                        });
                        // caroThumbs
                    } else {
                        caro.slick({
                            slidesToShow: items ? items : 3,
                            slidesToScroll: items ? items : 3,
                            infinite: !!loop,
                            arrows: !!nav,
                            prevArrow: '<span class="rt-slick-nav rt-prev"><i class="fa fa-chevron-left"></i></span>',
                            nextArrow: '<span class="rt-slick-nav rt-next"><i class="fa fa-chevron-right"></i></span>',
                            dots: !!dots,
                            autoplay: !!autoplay,
                            autoplaySpeed: autoPlayTimeOut ? autoPlayTimeOut : 5000,
                            adaptiveHeight: !!autoHeight,
                            pauseOnHover: !!autoPlayHoverPause,
                            speed: smartSpeed ? smartSpeed : 300,
                            lazyLoad: lazyLoad ? 'progressive' : 'ondemand',
                            rtl: !!rtl,
                            responsive: [
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: tItems ? tItems : 2,
                                        slidesToScroll: tItems ? tItems : 2
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: mItems ? mItems : 1,
                                        slidesToScroll: mItems ? mItems : 1
                                    }
                                }
                            ]
                        });
                    }
                    caro.parents('.rt-row').removeClass('tss-pre-loader');
                    caro.parents('.rt-row').find('.rt-loading-overlay, .rt-loading').remove();
                });
            }else if (Iso.length) {
                var IsoButton = container.find(".tss-isotope-button-wrapper");
                if (!buttonFilter) {
                    buttonFilter = IsoButton.find('.rt-iso-button.selected').data('filter');
                }
                var isotope = Iso.imagesLoaded(function () {
                    Iso.parents('.rt-row').removeClass('tss-pre-loader');
                    Iso.parents('.rt-row').find('.rt-loading-overlay, .rt-loading').remove();
                    preFunction();
                    isotope.isotope({
                        itemSelector: '.isotope-item',
                        masonry: {columnWidth: '.isotope-item'},
                        filter: function () {
                            var $this = $(this);
                            var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
                            var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                            return searchResult && buttonResult;
                        }
                    });
                    isoFilterCounter(container, isotope);
                });
                // use value of search field to filter
                var $quicksearch = container.find('.iso-search-input').keyup(debounce(function () {
                    qsRegex = new RegExp($quicksearch.val(), 'gi');
                    isotope.isotope();
                }));

                IsoButton.on('click', '.rt-iso-button', function (e) {
                    e.preventDefault();
                    buttonFilter = $(this).attr('data-filter');
                    isotope.isotope();
                    $(this).parent().find('.selected').removeClass('selected');
                    $(this).addClass('selected');
                });
            } else if (container.find('.rt-row.tss-masonry').length) {
                var masonryTarget = container.find('.rt-row.tss-masonry');
                preFunction();
                var isotopeM = masonryTarget.imagesLoaded(function () {
                    isotopeM.isotope({
                        itemSelector: '.masonry-grid-item',
                        masonry: {columnWidth: '.masonry-grid-item'}
                    });
                });
            }
        }
    });

    function isoFilterCounter(container, isotope) {
        var total = 0;
        container.find('.tss-isotope-button-wrapper .rt-iso-button').each(function () {
            var self = $(this),
                filter = self.data("filter"),
                itemTotal = isotope.find(filter).length;
            if (filter != "*") {
                self.attr("data-filter-counter", itemTotal);
                total = total + itemTotal
            }
        });
        container.find('.tss-isotope-button-wrapper .rt-iso-button[data-filter="*"]').attr("data-filter-counter", total);
    }

    function renderIsotope(container, $isotope, data, IsoButton) {

        var qsRegexG, buttonFilter;
        if (!buttonFilter) {
            buttonFilter = IsoButton.find('.rt-iso-button.selected').data('filter');
        }

        $isotope.append(data)
            .isotope('appended', data)
            .isotope('reloadItems')
            .isotope('updateSortData');
        $isotope.imagesLoaded(function () {
            preFunction();
            $isotope.isotope();
        });

        $(IsoButton).on('click', '.rt-iso-button', function (e) {
            e.preventDefault();
            buttonFilter = $(this).attr('data-filter');
            $isotope.isotope();
            $(this).parent().find('.selected').removeClass('selected');
            $(this).addClass('selected');
        });
        var $quicksearch = container.find('.iso-search-input').keyup(debounce(function () {
            qsRegexG = new RegExp($quicksearch.val(), 'gi');
            $isotope.isotope();
        }));
        isoFilterCounter(container, $isotope);
    }

    function HeightResize() {
        var wWidth = $(window).width();
        $(".tss-wrapper").each(function () {
            var self = $(this),
                dCol = self.data('desktop-col'),
                tCol = self.data('tab-col'),
                mCol = self.data('mobile-col'),
                target = $(this).find('.rt-row.tss-even');
            if ((wWidth >= 992 && dCol > 1) || (wWidth >= 768 && tCol > 1) || (wWidth < 768 && mCol > 1)) {
                target.imagesLoaded(function () {
                    var tlpMaxH = 0;
                    target.find('.even-grid-item').height('auto');
                    target.find('.even-grid-item').each(function () {
                        var $thisH = $(this).outerHeight();
                        if ($thisH > tlpMaxH) {
                            tlpMaxH = $thisH;
                        }
                    });
                    target.find('.even-grid-item').height(tlpMaxH + "px");

                    var isoMaxH = 0;
                    target.find('.tss-portfolio-isotope').children('.even-grid-item').height("auto");
                    target.find('.tss-portfolio-isotope').children('.even-grid-item').each(function () {
                        var $thisH = $(this).outerHeight();
                        console.log($thisH);
                        if ($thisH > isoMaxH) {
                            isoMaxH = $thisH;
                        }
                    });
                    target.find('.tss-portfolio-isotope').children('.even-grid-item').height(isoMaxH + "px");
                });
            } else {
                target.find('.even-grid-item').height('auto');
                target.find('.tss-portfolio-isotope').children('.even-grid-item').height('auto');
            }

        });
    }

    // debounce so filtering doesn't happen every millisecond
    function debounce(fn, threshold) {
        var timeout;
        return function debounced() {
            if (timeout) {
                clearTimeout(timeout);
            }
            function delayed() {
                fn();
                timeout = null;
            }

            setTimeout(delayed, threshold || 100);
        };
    }


    function overlayIconResize() {
        $('.tlp-item').each(function () {
            var holder_height = $(this).height();
            var a_height = $(this).find('.tlp-overlay .link-icon').height();
            var h = (holder_height - a_height) / 2;
            $(this).find('.link-icon').css('margin-top', h + 'px');
        });
    }
})(jQuery);