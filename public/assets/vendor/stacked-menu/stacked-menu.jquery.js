/**
 * StackedMenu jquery bridge
 * jQuery prototypal inheritance plugin for StackedMenu.
 * This is just a bridge plugin. So, we must load both stacked-menu.js and stacked-menu.jquery.js file.
 *
 * Author: Beni Arisandi <bent10@stilearning.com>
 *
 * @example
 * // We could now essentially do this:
 * $(selector).stackedMenu(options);
 *
 * @example
 * // and at this point we could do the following
 * $('#menu').stackedMenu();
 * // then get the instance object
 * var inst = $('#menu').data('stackedMenu');
 * // now we can access all StackedMenu methods from instance variable
 * inst.hoverable(true);
 *
 *
 * http://stilearning.com/stacked-menu
 *
 * Copyright (c) 2017 Stilearning.
 */
;(function($, window, document, undefined) {

  'use strict';
  // plugin name
  var pluginName = 'stackedMenu';

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function(options) {
    return this.each(function() {
      options = options || {};
      options.selector = this;

      if(!$.data(this, pluginName)) {
        $.data(this, pluginName, new StackedMenu(options));
      }
    });
  };
})(jQuery, window, document);