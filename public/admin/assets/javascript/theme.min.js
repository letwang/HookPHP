"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Theme =
/*#__PURE__*/
function () {
  function Theme() {
    var _this = this;

    _classCallCheck(this, Theme);

    // looper color scheme refer from our _variable-bs-overrides.scss
    this.colors = {
      black: '#14141F',
      brand: {
        blue: '#0179A8',
        indigo: '#346CB0',
        purple: '#5F4B8B',
        pink: '#B76BA3',
        red: '#EA6759',
        orange: '#EC935E',
        yellow: '#F7C46C',
        green: '#A7C796',
        teal: '#00A28A',
        cyan: '#3686A0'
      },
      gray: {
        100: '#f6f7f9',
        200: '#e6e8ed',
        300: '#d6d8e1',
        400: '#c6c9d5',
        500: '#a6abbd',
        600: '#888c9b',
        700: '#363642',
        800: '#222230',
        900: '#191927'
      },
      white: '#ffffff' // list of supported skin

    };
    this.skins = ['default', 'dark']; // current skin

    this.skin = localStorage.getItem('skin') || 'default'; // initialized

    $(document).ready(function () {
      _this.init();
    });
  }

  _createClass(Theme, [{
    key: "init",
    value: function init() {
      // handle polyfill
      // =============================================================
      this.placeholderShown();
      this.objectFitFallback(); // handle bootstrap components
      // =============================================================

      this.tooltips();
      this.popovers();
      this.inputClearable();
      this.inputGroup();
      this.fileInputBehavior();
      this.togglePasswordVisibility();
      this.indeterminateCheckboxes();
      this.formValidation();
      this.cardExpansion();
      this.modalOverflow();
      this.autofocusInputBehaviour(); // handle theme skins (default, dark)
      // =============================================================

      this.setSkin(this.skin);

      if (this.skin === 'dark') {
        this.invertGrays();
      } // handle theme layouts
      // =============================================================


      this.asideBackdrop();
      this.aside();
      this.asideMenu();
      this.sidebar();
      this.pageExpander(); // handle theme components
      // =============================================================

      this.hamburger();
      this.publisher();
      this.tasksStyle();
      this.filterList();
      this.radioList();
      this.checkboxList();
      this.smoothScroll(); // handle plugins initialization
      // =============================================================

      this.perfectScrollbar();
      this.masonry();
      this.chartjs();
      this.sparkline();
      this.easypie();
      this.knob();
      this.sortable();
      this.nestable();
      this.plyr();
      this.select2();
      this.atwho();
      this.tribute();
      this.flatpickr();
      this.colorpicker();
      this.touchspin();
      this.nouislider();
      this.summernote();
      this.quill();
      this.simplemde(); // handle events – how our components should react on events?
      // =============================================================

      this.eventProps();
      this.watchMQ(); // utilities
      // =============================================================

      this.browserFlagging();
      this.osFlagging(); // trigger the document

      $(document).trigger('theme:init', this);
    } // Polifyll
    // =============================================================

    /**
     * Polyfill for Array.values()
     * returns an array of a given object's own enumerable property values,
     * in the same order as that provided
     */

  }, {
    key: "objToArray",
    value: function objToArray(obj) {
      return Object.keys(obj).map(function (key) {
        return obj[key];
      });
    }
    /**
     * Polyfill for :placeholder-shown
     * used by floating label input
     */

  }, {
    key: "placeholderShown",
    value: function placeholderShown() {
      $(document).on('focus blur keyup change', '.form-label-group > input', function () {
        this.classList[this.value ? 'remove' : 'add']('placeholder-shown');
      }); // fire .placeholder-shown for IE

      $('.form-label-group > input').trigger('change');
    }
    /**
     * object-fit fallbaack for ie and edge
     */

  }, {
    key: "objectFitFallback",
    value: function objectFitFallback() {
      if (this.isIE() || this.isEdge()) {
        var selectors = ['.user-avatar img', '.tile > img', '.figure-attachment > img', '.page-cover > .cover-img', '.list-group-item-figure > img'];
        $(selectors.toString()).each(function () {
          var $img = $(this);
          var url = $img.prop('src');
          var $container = $img.parent(); // .user-avatar with dropdown has deep markup

          if ($container.is('[data-toggle="dropdown"]')) {
            $container = $container.parent();
          }

          if (url) {
            // copy img url then put as container bg
            $container.css({
              backgroundImage: "url(".concat(url, ")"),
              backgroundSize: 'cover',
              backgroundPosition: 'center center'
            });

            if ($container.hasClass('user-avatar') || $container.hasClass('user-avatar')) {
              $container.css('background-position', 'top center');
            } // hide the image


            $img.css('opacity', 0);
          }
        });
      }
    } // Bootstrap Components
    // =============================================================

    /**
     * Init bootstrap tooltips
     */

  }, {
    key: "tooltips",
    value: function tooltips() {
      // Turn off the transform placement on Popper
      Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;
      $('[data-toggle="tooltip"]').tooltip();
    }
    /**
     * Init bootstrap popovers
     */

  }, {
    key: "popovers",
    value: function popovers() {
      $('[data-toggle="popover"]').popover();
    }
    /**
     * Hide/show clearable button due to input value
     */

  }, {
    key: "inputClearable",
    value: function inputClearable() {
      // hide/show due to input value
      var toggleClear = function toggleClear(input) {
        var isEmpty = !$(input).val();
        var clearable = $(input).parent().children('.close');
        clearable.toggleClass('show', !isEmpty);
      }; // give natural state onload
      // show close button when input has value


      $('.has-clearable > .form-control').each(function () {
        toggleClear(this);
      }); // handle input clearable events

      $(document).on('keyup', '.has-clearable > .form-control', function () {
        toggleClear(this);
      }).on('click', '.has-clearable > .close', function () {
        var $input = $(this).parent().children('.form-control');
        $input.val('').focus();
        toggleClear($input[0]);
        $input.trigger('keyup');
      });
    }
    /**
     * Toggle focus class in input-group when input is focused
     */

  }, {
    key: "inputGroup",
    value: function inputGroup() {
      // handle input group events
      $(document).on('focusin focusout', '.input-group:not(.input-group-alt) .form-control', function (e) {
        var $parent = $(this).parent();
        var hasInputGroup = $parent.has('.input-group');
        var hasFocus = e.type === 'focusin';

        if (hasInputGroup) {
          $parent.toggleClass('focus', hasFocus);
        }
      });
    }
    /**
     * Add text value to our custom file input
     */

  }, {
    key: "fileInputBehavior",
    value: function fileInputBehavior() {
      // copy label text to data label which we'll use later
      $('.custom-file > .custom-file-label').each(function () {
        var label = $(this).text();
        $(this).data('label', label);
      }); // update label text with current input value

      $(document).on('change', '.custom-file > .custom-file-input', function () {
        var files = this.files;
        var $fileLabel = $(this).next('.custom-file-label'); // use when no file chosen

        var $originLabel = $fileLabel.data('label'); // truncate text when user chose more than 2 files

        $fileLabel.text(files.length + ' files selected');

        if (files.length <= 2) {
          var fileNames = [];

          for (var i = 0; i < files.length; i++) {
            fileNames.push(files[i].name);
          }

          $fileLabel.text(fileNames.join(', '));
        } // reset label text if no file chosen


        if (!files.length) {
          $fileLabel.text($originLabel);
        }
      });
    }
    /**
     * Toggle visibility password input value
     */

  }, {
    key: "togglePasswordVisibility",
    value: function togglePasswordVisibility() {
      $(document).on('click', '[data-toggle="password"]', function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        var $input = $(target);
        var hasFa = $(this).has('.fa');
        var isPassword = $input.is('[type="password"]');
        var inputType = isPassword ? 'text' : 'password';
        var triggerText = isPassword ? 'Hide' : 'Show'; // toggle icon

        $(this).children('.fa, .far').toggleClass('fa-eye fa-eye-slash', hasFa); // toggle trigger text

        $(this).children().last().text(triggerText); // toggle input type

        $input.prop('type', inputType);
      });
    }
    /**
     * Add indeterminate state in custom checkbox
     */

  }, {
    key: "indeterminateCheckboxes",
    value: function indeterminateCheckboxes() {
      $('input[type="checkbox"][indeterminate]').prop('indeterminate', true);
    }
    /**
     * Validate form on submit
     */

  }, {
    key: "formValidation",
    value: function formValidation() {
      $(window).on('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('.needs-validation'); // Loop over them and prevent submission

        forms.each(function (i, form) {
          $(form).on('submit', function (e) {
            if (form.checkValidity() === false) {
              e.preventDefault();
              e.stopPropagation();
            }

            $(form).addClass('was-validated');
          });
        });
      });
    }
    /**
     * Toggle card expansion like accordion
     */

  }, {
    key: "cardExpansion",
    value: function cardExpansion() {
      $(document).on('show.bs.collapse hide.bs.collapse', '.card-expansion-item > .collapse', function (e) {
        var $item = $(this).parent();
        var isShown = e.type === 'show';
        $item.toggleClass('expanded', isShown);
      });
    }
    /**
     * Toggle class overflow when the modal body scroll reach the top/bottom
     */

  }, {
    key: "modalOverflow",
    value: function modalOverflow() {
      $('.modal').on('shown.bs.modal', function () {
        $(this).addClass('has-shown').find('.modal-body').trigger('scroll');
      });
      $('.modal-dialog-overflow .modal-body, .modal-drawer .modal-body').on('scroll', function () {
        var $elem = $(this);
        var elem = $elem[0];
        var isTop = $elem.scrollTop() === 0;
        var isBottom = elem.scrollHeight - $elem.scrollTop() === $elem.outerHeight();
        $elem.prev().toggleClass('modal-body-scrolled', isTop);
        $elem.next().toggleClass('modal-body-scrolled', isBottom);
      });
    }
    /**
     * Make input with [autofocus] attribute in modal and dropdown work as native [autofocus]
     */

  }, {
    key: "autofocusInputBehaviour",
    value: function autofocusInputBehaviour() {
      $(document).on('shown.bs.modal shown.bs.dropdown', '.modal, .dropdown', function (e) {
        var $modal = $(e.target);
        $modal.find('input[autofocus]:first').focus();
      });
    } // Theme Skins
    // =============================================================

    /**
     * Get gray colors from colors
     */

  }, {
    key: "getColors",
    value: function getColors(color) {
      return this.colors[color];
    }
    /**
     * Get muted colors based on active skin
     */

  }, {
    key: "getMutedColor",
    value: function getMutedColor() {
      return this.skin === 'dark' ? this.colors.gray[400] : this.colors.gray[600];
    }
    /**
     * Get light color based on active skin
     */

  }, {
    key: "getLightColor",
    value: function getLightColor() {
      return this.colors.gray[100];
    }
    /**
     * Get dark color based on active skin
     */

  }, {
    key: "getDarkColor",
    value: function getDarkColor() {
      return this.colors.gray[900];
    }
    /**
     * Set current skin to given value
     * We need to reload the browser when perform this method
     * to apply changes to all components
     */

  }, {
    key: "setSkin",
    value: function setSkin(skin) {
      // reset to default when using un-appropriate value
      skin = this.skins.indexOf(skin) < 0 ? 'default' : skin; // inverse gray colors

      if (this.skin !== skin) {
        this.invertGrays();
      }

      localStorage.setItem('skin', skin);
      this.skin = skin;
    }
    /**
     * Invert gray colors due to active skin
     */

  }, {
    key: "invertGrays",
    value: function invertGrays() {
      var _this2 = this;

      var self = this;
      var gray = this.getColors('gray'); // get gray colors in array that reserve it

      var reverseGray = this.objToArray(gray).reverse();
      var x = 0;
      $.each(gray, function (i, v) {
        _this2.colors.gray[i] = reverseGray[x];
        x++;
      });
    } // Theme Layout
    // =============================================================

    /**
     * Append aside-backdrop to .app
     */

  }, {
    key: "asideBackdrop",
    value: function asideBackdrop() {
      $('.app').append('<div class="aside-backdrop"/>');
    }
    /**
     * Showing aside-backdrop
     */

  }, {
    key: "showAsideBackdrop",
    value: function showAsideBackdrop() {
      $('.aside-backdrop').addClass('show');
      return $('.aside-backdrop');
    }
    /**
     * Hiding aside-backdrop
     */

  }, {
    key: "hideAsideBackdrop",
    value: function hideAsideBackdrop() {
      $('.aside-backdrop').removeClass('show');
      return $('.aside-backdrop');
    }
    /**
     * Show aside
     */

  }, {
    key: "showAside",
    value: function showAside() {
      var _this3 = this;

      // show aside-backdrop
      var backdrop = this.showAsideBackdrop(); // add .show class to aside

      $('.app-aside').addClass('show'); // add .active state to trigger button

      $('[data-toggle="aside"]').addClass('active');
      backdrop.one('click', function () {
        _this3.hideAside();
      });
    }
    /**
     * Hide aside
     */

  }, {
    key: "hideAside",
    value: function hideAside() {
      // hide aside-backdrop
      this.hideAsideBackdrop(); // remove .show class to aside

      $('.app-aside').removeClass('show'); // remove .active state to trigger button

      $('[data-toggle="aside"]').removeClass('active');
    }
    /**
     * Handle show/hide aside
     */

  }, {
    key: "aside",
    value: function aside() {
      var _this4 = this;

      var $trigger = $('[data-toggle="aside"]');
      $trigger.on('click', function () {
        var isShown = $('.app-aside').hasClass('show');
        $trigger.toggleClass('active', !isShown);
        if (isShown) _this4.hideAside();else _this4.showAside();
      });
    }
    /**
     * Handle aside menu
     */

  }, {
    key: "asideMenu",
    value: function asideMenu() {
      var ps;

      if (window.StackedMenu && this.isExists('#stacked-menu')) {
        this.asideMenu = new StackedMenu(); // update perfect scrollbar

        $(this.asideMenu.selector).on('menu:open menu:close', function () {
          // wait until translation done
          setTimeout(function () {
            ps.update();
          }, 300);
        }); // perfect scrollbar for aside menu

        if (window.PerfectScrollbar) {
          ps = new PerfectScrollbar('.aside-menu', {
            suppressScrollX: true
          });
        }
      }
    }
    /**
     * Showing sidebar
     */

  }, {
    key: "showSidebar",
    value: function showSidebar(relatedTarget) {
      $('.has-sidebar').addClass('has-sidebar-open'); // trigger event

      $('.page-sidebar').trigger({
        type: 'toggle.sidebar',
        isOpen: true,
        relatedTarget: relatedTarget
      });
    }
    /**
     * Hiding sidebar
     */

  }, {
    key: "hideSidebar",
    value: function hideSidebar(relatedTarget) {
      $('.has-sidebar').removeClass('has-sidebar-open'); // trigger event

      $('.page-sidebar').trigger({
        type: 'toggle.sidebar',
        isOpen: false,
        relatedTarget: relatedTarget
      });
    }
    /**
     * Toggle sidebar
     */

  }, {
    key: "toggleSidebar",
    value: function toggleSidebar(relatedTarget) {
      var $target = $('.has-sidebar');
      var isOpen = $target.hasClass('has-sidebar-open');

      if (this.isExists('.has-sidebar') && isOpen) {
        this.hideSidebar(relatedTarget);
      } else if (this.isExists('.has-sidebar') && !isOpen) {
        this.showSidebar(relatedTarget);
      }
    }
    /**
     * Add sidebar backdrop to the .page
     */

  }, {
    key: "sidebarBackdrop",
    value: function sidebarBackdrop() {
      // append backdrop only when .page has .sidebar component
      if (this.isExists('.has-sidebar')) {
        $('.page').prepend('<div class="sidebar-backdrop" />');
      }
    }
    /**
     * Handle sidebar
     */

  }, {
    key: "sidebar",
    value: function sidebar() {
      var self = this; // handle sidebar

      this.sidebarBackdrop();
      $(document).on('click', '[data-toggle="sidebar"], .sidebar-backdrop', function (e) {
        e.preventDefault();
        var state = $(this).data('sidebar');

        switch (state) {
          case 'show':
            self.showSidebar(this);
            break;

          case 'hide':
            self.hideSidebar(this);
            break;

          default:
            self.toggleSidebar(this);
        }
      });
    }
    /**
     * Toggle .page-expanded class on .page
     * best fit to used in board layout
     */

  }, {
    key: "pageExpander",
    value: function pageExpander() {
      $(document).on('click', '[data-toggle="page-expander"]', function (e) {
        e.preventDefault();
        $('.page').toggleClass('page-expanded');
      });
    } // Theme Components
    // =============================================================

    /**
     * Handle hamburger .active state
     */

  }, {
    key: "hamburger",
    value: function hamburger() {
      $(document).on('click', '.hamburger-toggle', function () {
        $(this).toggleClass('active');
      });
    }
    /**
     * Handle publisher focus state
     */

  }, {
    key: "publisher",
    value: function publisher() {
      $(document).on('focusin', '.publisher .form-control', function () {
        var $publisher = $(this).parents('.publisher'); // normalize all empty publisher

        $('.publisher').each(function () {
          var hasEmpty = !$(this).find('.form-control').val();

          if (hasEmpty) {
            $(this).removeClass('active');
            $(this).not('.keep-focus').removeClass('focus');
          }
        }); // add state classes

        $publisher.addClass('focus active');
      }).on('click', 'html', function () {
        var $publisher = $('.publisher.active');
        var isEmpty = !$publisher.find('.form-control').val(); // always remove active state

        $publisher.removeClass('active'); // remove focus if input is empty

        if (isEmpty) {
          $publisher.not('.keep-focus').removeClass('focus');
        }
      }).on('click', '.publisher.active', function (e) {
        e.stopPropagation();
      });
    }
    /**
     * Add hover state when task header is hovered
     */

  }, {
    key: "tasksStyle",
    value: function tasksStyle() {
      $(document).on('mouseenter mouseleave', '.task-header', function (e) {
        var isHover = e.type === 'mouseenter';
        $(this).parent().toggleClass('hover', isHover);
      });
    }
    /**
     * Filter list(s) through input
     */

  }, {
    key: "filterList",
    value: function filterList() {
      $(document).on('keyup', '[data-filter]', function () {
        var target = $(this).data('filter');
        var value = $(this).val().toLowerCase();
        $(target).filter(function () {
          var text = $(this).text().toLowerCase();
          $(this).toggle(text.indexOf(value) > -1);
        });
      });
    }
    /**
     * Make list items selectable like input[radio]
     */

  }, {
    key: "radioList",
    value: function radioList() {
      $(document).on('click', '[data-toggle="radiolist"] > *', function () {
        var $list = $(this).parent();
        var $listItems = $list.children(); // remove all selected item

        $listItems.removeClass('active'); // selected item

        $(this).addClass('active');
        $list.trigger({
          type: 'change',
          relatedTarget: this
        });
      });
    }
    /**
     * Make list items selectable like input[checkbox]
     */

  }, {
    key: "checkboxList",
    value: function checkboxList() {
      $(document).on('click', '[data-toggle="checkboxlist"] > *', function () {
        var $list = $(this).parent();
        var isActive = $(this).hasClass('active'); // selected item

        $(this).toggleClass('active', !isActive);
        $list.trigger({
          type: 'change',
          relatedTarget: $list.children('.active')
        });
      });
    }
    /**
     * Animate scroll on internal link
     */

  }, {
    key: "smoothScroll",
    value: function smoothScroll() {
      $(document).on('click', 'a.smooth-scroll[href^="#"]', function (e) {
        var hash = $(this).attr('href');
        var target = $(hash);

        if (!target.length) {
          return;
        }

        e.preventDefault();
        var headerHeight = $('.app-header').height() + 20;
        var offset = target.offset().top - headerHeight;
        $('html, body').animate({
          scrollTop: offset < 0 ? 0 : offset
        }, 700);
      });
    } // Theme Plugins
    // =============================================================

    /**
     * Handle perfect scrollbar
     */

  }, {
    key: "perfectScrollbar",
    value: function perfectScrollbar() {
      // initialization for any components
      if (window.PerfectScrollbar && this.isExists('.perfect-scrollbar')) {
        $('.perfect-scrollbar:not(".aside-menu")').each(function () {
          new PerfectScrollbar(this, {
            suppressScrollX: true
          });
        });
      }
    }
    /**
     * Handle masonry
     */

  }, {
    key: "masonry",
    value: function masonry() {
      if (window.Masonry) {
        $(document).ready(function () {
          $('.masonry-layout').masonry({
            itemSelector: '.masonry-item',
            columnWidth: '.masonry-item:first-child',
            percentPosition: true
          });
        });
      }
    }
    /**
     * Handle ChartJS default options
     */

  }, {
    key: "chartjs",
    value: function chartjs() {
      if (window.Chart) {
        var colors = this.colors;
        var skin = this.skin;
        var isDarkSkin = skin === 'dark';
        var gray = this.getColors('gray'); // our settings for Chart JS

        var settings = {
          global: {
            responsive: true,
            maintainAspectRatio: false,
            defaultColor: isDarkSkin ? this.hexToRgba(colors.white, .08) : this.hexToRgba(colors.black, .1),
            defaultFontColor: isDarkSkin ? gray[400] : gray[600],
            fontFamily: '-apple-system, BlinkMacSystemFont, "Fira Sans", "Helvetica Neue", "Apple Color Emoji", sans-serif',
            tooltips: {
              backgroundColor: isDarkSkin ? this.hexToRgba(colors.white, .98) : this.hexToRgba(colors.black, .98),
              xPadding: 8,
              yPadding: 8,
              titleMarginBottom: 8,
              footerMarginTop: 8,
              titleFontColor: gray[200],
              bodyFontColor: gray[200],
              footerFontColor: gray[200],
              multiKeyBackground: gray[200]
            },
            title: {
              fontColor: gray[700],
              fontStyle: 500
            },
            legend: {
              display: false
            }
          },
          scale: {
            gridLines: {
              color: isDarkSkin ? this.hexToRgba(colors.white, .08) : this.hexToRgba(colors.black, .1),
              zeroLineColor: isDarkSkin ? this.hexToRgba(colors.white, .08) : this.hexToRgba(colors.black, .1)
            }
          } // Merge settings to Chart JS default options

        };
        $.extend(true, Chart.defaults, settings);
      }
    }
    /**
     * Handle Flot default options
     */

  }, {
    key: "flotDefaultOptions",
    value: function flotDefaultOptions() {
      var colors = this.colors;
      var skin = this.skin;
      var isDarkSkin = skin === 'dark';
      var gray = this.getColors('gray'); // our setting to merge with flot default options

      return {
        xaxis: {
          tickColor: isDarkSkin ? this.hexToRgba(colors.white, .08) : this.hexToRgba(colors.black, .1),
          color: isDarkSkin ? gray[400] : gray[600]
        },
        yaxis: {
          tickColor: isDarkSkin ? this.hexToRgba(colors.white, .08) : this.hexToRgba(colors.black, .1),
          color: isDarkSkin ? gray[400] : gray[600]
        }
      };
    }
    /**
     * Handle Sparkline initialization
     */

  }, {
    key: "sparkline",
    value: function sparkline() {
      if ($.fn.sparkline) {
        $('[data-toggle="sparkline"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          var values = options.values || 'html';
          $(selector).sparkline(values, options);
        });
      }
    }
    /**
     * Handle easyPieChart initialization
     */

  }, {
    key: "easypie",
    value: function easypie() {
      if ($.fn.easyPieChart) {
        var self = this;
        $('[data-toggle="easypiechart"]').each(function () {
          var selector = this;
          var options = $(selector).data(); // default for undefined

          options.barColor = options.barColor || self.colors.brand.teal;
          options.trackColor = options.trackColor || self.skin === 'dark' ? self.getColors('gray')[200] : self.colors.white;
          options.scaleColor = options.scaleColor || 'transparent';
          options.lineWidth = options.lineWidth ? parseInt(options.lineWidth) : 8;
          options.size = options.size ? parseInt(options.size) : 120;
          options.rotate = options.rotate ? parseInt(options.rotate) : 0;
          options.trackColor = options.trackColor == 'false' || options.trackColor == '' ? false : options.trackColor;
          options.scaleColor = options.scaleColor == 'false' || options.scaleColor == '' ? false : options.scaleColor;
          $(selector).easyPieChart(options);
        });
      }
    }
    /**
     * Handle knob initialization
     */

  }, {
    key: "knob",
    value: function knob() {
      if ($.fn.knob) {
        var self = this;
        $('[data-toggle="knob"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options.bgColor = options.bgcolor || self.getLightColor();
          options.fgColor = options.fgcolor || self.colors.brand.teal;

          options.draw = function () {
            // 'tron' case
            if (this.$.data('skin') == 'tron') {
              this.cursorExt = 0.3;
              var a = this.arc(this.cv); // Arc

              var pa; // Previous arc

              var r = 1;
              this.g.lineWidth = this.lineWidth;

              if (this.o.displayPrevious) {
                pa = this.arc(this.v);
                this.g.beginPath();
                this.g.strokeStyle = this.pColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                this.g.stroke();
              }

              this.g.beginPath();
              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
              this.g.stroke();
              this.g.lineWidth = 2;
              this.g.beginPath();
              this.g.strokeStyle = this.o.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
              this.g.stroke();
              return false;
            }
          };

          $(selector).knob(options);
        });
      }
    }
    /**
     * Handle Sortable initialization
     */

  }, {
    key: "sortable",
    value: function sortable() {
      if (window.Sortable) {
        $('[data-toggle="sortable"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options.animation = options.animation || 150;
          options.filter = options.filter || '.ignore-sort';
          Sortable.create(selector, options);
        });
      }
    }
    /**
     * Handle Nestable initialization
     */

  }, {
    key: "nestable",
    value: function nestable() {
      if ($.fn.nestable) {
        $('[data-toggle="nestable"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          $(selector).nestable(options);
        });
      }
    }
    /**
     * Handle Plyr initialization
     */

  }, {
    key: "plyr",
    value: function plyr() {
      if (window.Plyr) {
        $('[data-toggle="plyr"]').each(function () {
          var selector = this;
          new Plyr(selector);
        });
      }
    }
    /**
     * jsTree common types setup
     */

  }, {
    key: "jsTreeTypes",
    value: function jsTreeTypes() {
      return {
        '#': {
          max_children: 1,
          max_depth: 4,
          valid_children: ['root']
        },
        'root': {
          icon: 'fa fa-hdd text-yellow',
          valid_children: ['default', 'file']
        },
        default: {
          icon: 'fa fa-folder text-yellow',
          valid_children: ['default', 'file']
        },
        file: {
          icon: 'fa fa-file',
          valid_children: []
        },
        text: {
          icon: 'far fa-file-alt',
          valid_children: []
        },
        word: {
          icon: 'far fa-file-word',
          valid_children: []
        },
        excel: {
          icon: 'far fa-file-excel',
          valid_children: []
        },
        ppt: {
          icon: 'far fa-file-powerpoint',
          valid_children: []
        },
        pdf: {
          icon: 'far fa-file-pdf',
          valid_children: []
        },
        archive: {
          icon: 'far fa-file-archive',
          valid_children: []
        },
        image: {
          icon: 'far fa-file-image',
          valid_children: []
        },
        audio: {
          icon: 'far fa-file-audio',
          valid_children: []
        },
        video: {
          icon: 'far fa-file-video',
          valid_children: []
        }
      };
    }
    /**
     * Handle select2 initialization
     * See https://select2.org/configuration/data-attributes
     * to use select2 with data-* attributes
     */

  }, {
    key: "select2",
    value: function select2() {
      if ($.fn.select2) {
        // responsive setting
        $.fn.select2.defaults.set('width', '100%');
        $('[data-toggle="select2"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options = options.options ? options.options : options;
          $(selector).select2(options);
        });
      }
    }
    /**
     * Handle At.js initialization
     */

  }, {
    key: "atwho",
    value: function atwho() {
      if ($.fn.atwho) {
        $('[data-toggle="atwho"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          $(selector).atwho(options);
        });
      }
    }
    /**
     * Handle Tribute initialization
     */

  }, {
    key: "tribute",
    value: function tribute() {
      if (window.Tribute) {
        $('[data-toggle="tribute"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options.menuContainer = document.querySelector(options.menuContainer) || false; // define custom template

          if (options.itemTemplate == true) {
            options.menuItemTemplate = function (item) {
              return "<span class=\"user-avatar user-avatar-sm mr-2\"><img src=\"".concat(item.original.avatar, "\"></span> ").concat(item.string);
            };
          } // define select template


          if (options.selectTemplate == true) {
            options.selectTemplate = function (item) {
              // function called on select that returns the content to insert
              return "<a href=\"#!\" class=\"mention\">@".concat(item.original.value, "</a>");
            };
          } // set values from data-remote if exist


          if (options.remote) {
            $.ajax({
              async: false,
              dataType: 'json',
              url: options.remote,
              success: function success(data) {
                options.values = data;
              }
            });
          }

          var tribute = new Tribute(options);
          tribute.attach(this);
        });
      }
    }
    /**
     * Handle flatpickr initialization
     */

  }, {
    key: "flatpickr",
    value: function (_flatpickr) {
      function flatpickr() {
        return _flatpickr.apply(this, arguments);
      }

      flatpickr.toString = function () {
        return _flatpickr.toString();
      };

      return flatpickr;
    }(function () {
      if (window.flatpickr) {
        flatpickr.defaultConfig.disableMobile = true;
        $('[data-toggle="flatpickr"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options.disable = options.disables || [];
          flatpickr(selector, options);
        });
      }
    })
    /**
     * Handle colorpicker initialization
     */

  }, {
    key: "colorpicker",
    value: function colorpicker() {
      if ($.fn.colorpicker) {
        $('[data-toggle="colorpicker"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          $(selector).colorpicker(options);
        });
      }
    }
    /**
     * Handle TouchSpin initialization
     */

  }, {
    key: "touchspin",
    value: function touchspin() {
      if ($.fn.TouchSpin) {
        $('[data-toggle="touchspin"]').each(function () {
          var selector = this;
          var settings = $(selector).data();
          var options = {
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            verticalupclass: '+',
            verticaldownclass: '-' // Merge options

          };
          $.extend(true, options, settings);
          $(selector).TouchSpin(options);
        });
      }
    }
    /**
     * Handle nouislider initialization
     */

  }, {
    key: "nouislider",
    value: function nouislider() {
      if (window.noUiSlider) {
        $('[data-toggle="nouislider"]').each(function () {
          var selector = this;
          var options = $(selector).data();

          if (window.wNumb && options.formatWnumb) {
            options.format = wNumb(options.formatWnumb);
          }

          noUiSlider.create(selector, options);
        });
      }
    }
    /**
     * Handle summernote initialization
     */

  }, {
    key: "summernote",
    value: function summernote() {
      if ($.fn.summernote) {
        $('[data-toggle="summernote"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options.callbacks = {
            // fix broken checkbox on link modal
            onInit: function onInit(e) {
              var editor = $(e.editor);
              editor.find('.custom-control-description').addClass('custom-control-label d-block').parent().removeAttr('for');
            }
          };
          $(selector).summernote(options);
        });
      }
    }
    /**
     * Handle Quill initialization
     */

  }, {
    key: "quill",
    value: function quill() {
      if (window.Quill) {
        $('[data-toggle="quill"]').each(function () {
          var selector = this;
          var options = $(selector).data();

          if (options.modules == null) {
            options.modules = {
              'formula': true,
              'syntax': true,
              'toolbar': [[{
                'font': []
              }, {
                'size': []
              }], ['bold', 'italic', 'underline', 'strike'], [{
                'color': []
              }, {
                'background': []
              }], [{
                'script': 'super'
              }, {
                'script': 'sub'
              }], [{
                'header': [false, 1, 2, 3, 4, 5, 6]
              }, 'blockquote', 'code-block'], [{
                'list': 'ordered'
              }, {
                'list': 'bullet'
              }, {
                'indent': '-1'
              }, {
                'indent': '+1'
              }], ['direction', {
                'align': []
              }], ['link', 'image', 'video', 'formula'], ['clean']]
            };
          }

          options.theme = options.theme ? options.theme : 'snow';
          new Quill(selector, options);
        });
      }
    }
    /**
     * Handle SimpleMDE initialization
     */

  }, {
    key: "simplemde",
    value: function simplemde() {
      if (window.SimpleMDE) {
        $('[data-toggle="simplemde"]').each(function () {
          var selector = this;
          var options = $(selector).data();
          options.element = this;
          new SimpleMDE(options);
        });
      }
    } // Events
    // =============================================================

    /**
     * Handle prevent default & propagation
     */

  }, {
    key: "eventProps",
    value: function eventProps() {
      $('body').on('click', '.stop-propagation', function (e) {
        e.stopPropagation();
      }).on('click', '.prevent-default', function (e) {
        e.preventDefault();
      });
    }
    /**
     * Handle window resize
     */

  }, {
    key: "watchMQ",
    value: function watchMQ() {
      var _this5 = this;

      $(window).on('resize', function () {
        // force close aside on toggle screen up
        if (_this5.isToggleScreenUp() && $('.app-aside').hasClass('has-open') && !$('.app').hasClass('has-fullwidth')) {
          _this5.closeAside();
        } // disable transition temporarily


        $('.app-aside, .page-sidebar').addClass('notransition');
        setTimeout(function () {
          $('.app-aside, .page-sidebar').removeClass('notransition');
        }, 1);
      });
    } // Utilities
    // =============================================================

    /**
     * Opera 8.0+
     * @return {Boolean}
     */

  }, {
    key: "isOpera",
    value: function isOpera() {
      return !!window.opr && !!opr.addons || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    }
    /**
     * Firefox 1.0+
     * @return {Boolean}
     */

  }, {
    key: "isFirefox",
    value: function isFirefox() {
      return typeof InstallTrigger !== 'undefined';
    }
    /**
     * Safari 3.0+ "[object HTMLElementConstructor]"
     * @return {Boolean}
     */

  }, {
    key: "isSafari",
    value: function isSafari() {
      // Safari 3.0+ "[object HTMLElementConstructor]"
      return /constructor/i.test(window.HTMLElement) || function (p) {
        return p.toString() === '[object SafariRemoteNotification]';
      }(!window['safari'] || typeof safari !== 'undefined' && safari.pushNotification);
    }
    /**
     * Internet Explorer 6-11
     * @return {Boolean}
     */

  }, {
    key: "isIE",
    value: function isIE() {
      return (
        /*@cc_on!@*/
        false || !!document.documentMode
      );
    }
    /**
     * Edge 20+
     * @return {Boolean}
     */

  }, {
    key: "isEdge",
    value: function isEdge() {
      return !this.isIE() && !!window.StyleMedia;
    }
    /**
     * Chrome 1+
     * @return {Boolean}
     */

  }, {
    key: "isChrome",
    value: function isChrome() {
      return !!window.chrome && !!window.chrome.webstore;
    }
    /**
     * Blink engine detection
     * @return {Boolean}
     */

  }, {
    key: "isBlink",
    value: function isBlink() {
      return (this.isChrome() || this.isOpera()) && !!window.CSS;
    }
    /**
     * Add class to body by browser name
     */

  }, {
    key: "browserFlagging",
    value: function browserFlagging() {
      if (this.isOpera()) {
        $('body').addClass('opera');
      }

      if (this.isFirefox()) {
        $('body').addClass('firefox');
      }

      if (this.isSafari()) {
        $('body').addClass('safari');
      }

      if (this.isIE()) {
        $('body').addClass('ie');
      }

      if (this.isEdge()) {
        $('body').addClass('edge');
      }

      if (this.isChrome()) {
        $('body').addClass('chrome');
      }

      if (this.isBlink()) {
        $('body').addClass('blink');
      }
    }
    /**
     * We used diferent font-family between mac and other os
     * so we need to flaggin it to avoid unconsistent line-height
     */

  }, {
    key: "osFlagging",
    value: function osFlagging() {
      // add flagging class on macos due to fonts line-height issue
      if (navigator.appVersion.toLowerCase().indexOf('mac') != -1) {
        $('body').addClass('macos');
      }
    }
    /**
     * Detect if current screen size wider than our toggleScreen
     * refer to our media-breakpoint-up("md")
     */

  }, {
    key: "isToggleScreenUp",
    value: function isToggleScreenUp() {
      return window.matchMedia('(min-width: 768px)').matches;
    }
    /**
     * Detect if current screen size lower than our toggleScreen
     * refer to our media-breakpoint-down("md")
     */

  }, {
    key: "isToggleScreenDown",
    value: function isToggleScreenDown() {
      return window.matchMedia('(max-width: 767.98px)').matches;
    }
    /**
     * Check the existence of an element
     */

  }, {
    key: "isExists",
    value: function isExists(selector) {
      return $(selector).length > 0;
    }
    /**
     * Convert rgb color to hex
     * Credit: https://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb?rq=1
     */

  }, {
    key: "rgbToHex",
    value: function rgbToHex(r, g, b) {
      return '#' + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
    }
    /**
     * Convert hex color to rgb
     * Credit: https://stackoverflow.com/questions/5623838/rgb-to-hex-and-hex-to-rgb?rq=1
     */

  }, {
    key: "hexToRgb",
    value: function hexToRgb(hex) {
      // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
      var regex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
      hex = hex.replace(regex, function (m, r, g, b) {
        return r + r + g + g + b + b;
      });
      var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
      return result ? "rgb(".concat(parseInt(result[1], 16), ", ").concat(parseInt(result[2], 16), ", ").concat(parseInt(result[3], 16), ")") : null;
    }
    /**
     * Convert hex color to rgba
     */

  }, {
    key: "hexToRgba",
    value: function hexToRgba(hex, alpha) {
      // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
      var regex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
      hex = hex.replace(regex, function (m, r, g, b) {
        return r + r + g + g + b + b;
      });
      var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
      return result ? "rgba(".concat(parseInt(result[1], 16), ", ").concat(parseInt(result[2], 16), ", ").concat(parseInt(result[3], 16), ", ").concat(alpha, ")") : null;
    }
  }]);

  return Theme;
}();
/**
 * Initialize Theme as Looper,
 * we can use it as global variable.
 * @example
 * Looper.setSkin('dark')
 */


var Looper = function () {
  var Looper = new Theme(); // toggle skin thought button

  $('[data-toggle="skin"]').on('click', function (e) {
    e.preventDefault();
    var skin = Looper.skin === 'dark' ? 'default' : 'dark';
    Looper.setSkin(skin); // we need to refresh our page after change the skin

    location.reload();
  }).each(function () {
    var isDarkSkin = Looper.skin === 'dark';
    var $icon = $(this).find('.fa-moon');

    if (isDarkSkin) {
      $icon.addClass('far');
      $icon.removeClass('fas');
    }
  }); // make it global

  return Looper;
}();