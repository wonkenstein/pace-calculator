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
    var self = this;
    $('#calculator-type').find('input').click(function(e){
      self.hideCalculatorInput($(this).val());      
    });
    
    var calculator_type = $('input[name="calculator-type"]').val();
    self.hideCalculatorInput(calculator_type);
    
  };

  //scroll direction taken from options.scroll
  Plugin.prototype.hideCalculatorInput = function(fieldset_id) {
    var self = this;
    $('fieldset', self.element).show();    
    $('#' + fieldset_id).hide();
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
