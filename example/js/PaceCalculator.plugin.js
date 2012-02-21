// https://github.com/addyosmani/jquery-plugin-patterns/blob/master/jquery.basic.plugin-boilerplate.js

;(function ( $, window, document, undefined ) {

  // Create the defaults once
  var pluginName = 'PaceCalculator',
    defaults = {
      propertyName: "value"
    };

  // The actual plugin constructor
  function Plugin( element, options ) {
    this.element = element;
    this.options = $.extend( {}, defaults, options) ;

    this._defaults = defaults;
    this._name = pluginName;

    // do something interesting
    this.init();
  }


  //
  Plugin.prototype.init = function() {
    console.log('HELLO');
    var self = this;
    $('#calculator-type').find('input').click(function(e){
      var el = $(this);
      $('fieldset', self.element).show();
      $('#' + el.val()).hide();
    });
  };




  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function ( options ) {
    return this.each(function () {
      if (!$.data(this, 'plugin_' + pluginName)) {
        $.data(this, 'plugin_' + pluginName,
        new Plugin( this, options ));
      }
    });
  }

})( jQuery, window, document );
