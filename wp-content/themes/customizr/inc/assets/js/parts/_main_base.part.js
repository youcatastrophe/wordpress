//@global TCParams
var czrapp = czrapp || {};

(function($, czrapp) {
  //short name for the slice method from the built-in Array js prototype
  //used to handle the event methods
  var slice = Array.prototype.slice;

  $.extend( czrapp, {
    instances        : {},//will store all subclasses instances
    methods          : {},//will store all subclasses methods

    //parent class constructor
    Base : function() {},

    _inherits : function( classname ) {
      //add the class to the czrapp and sets the parent this to it
      czrapp[classname] = function() {
        czrapp.Base.call(this);
      };

      //set the classical prototype chaining with inheritance
      czrapp[classname].prototype = Object.create( czrapp.Base.prototype );
      czrapp[classname].prototype.constructor = czrapp[classname];
      return czrapp;
    },


    _instanciates : function( classname) {
      czrapp.instances[classname] = czrapp.instances[classname] || new czrapp[classname]();
      return czrapp;
    },


    /**
     * [_init description]
     * @param  {[type]} classname string
     * @param  {[type]} methods   array of methods
     * @return {[type]} czrapp object
     */
    _init : function(classname, methods) {
      var _instance = czrapp.instances[classname] || false;
      if ( ! _instance )
        return;

      //always fire the init method if exists
      if ( _instance.init )
        _instance.init();

      //fire the array of methods on load
      _instance.emit(methods);

      //return czrapp for chaining
      return czrapp;
    },

    //extend a classname prototype with a set of methods
    _addMethods : function(classname) {
      $.extend( czrapp[classname].prototype , czrapp._getMethods(classname) );
      return czrapp;
    },

    _getMethods : function(classname) {
      return czrapp.methods[classname] || {};
    },


    /**
     * Cache properties on Dom Ready
     * @return {[type]} [description]
     */
    cacheProp : function() {
      $.extend( czrapp, {
        //cache various jQuery el in czrapp obj
        $_window         : $(window),
        $_html           : $('html'),
        $_body           : $('body'),
        $_tcHeader       : $('.tc-header'),
        $_wpadminbar     : $('#wpadminbar'),

        //various properties definition
        localized        : TCParams || {},
        reordered_blocks : false,//store the states of the sidebar layout
      });

      return czrapp;
    },


    /***************************************************************************
    * Event methods, offering the ability to bind to and trigger events.
    * Inspired from the customize-base.js event manager object
    * @uses slice method, alias of Array.prototype.slice
    ****************************************************************************/
    trigger: function( id ) {
      if ( this.topics && this.topics[ id ] )
        this.topics[ id ].fireWith( this, slice.call( arguments, 1 ) );
      return this;
    },

    bind: function( id ) {
      this.topics = this.topics || {};
      this.topics[ id ] = this.topics[ id ] || $.Callbacks();
      this.topics[ id ].add.apply( this.topics[ id ], slice.call( arguments, 1 ) );
      return this;
    },

    unbind: function( id ) {
      if ( this.topics && this.topics[ id ] )
        this.topics[ id ].remove.apply( this.topics[ id ], slice.call( arguments, 1 ) );
      return this;
    },


    /**
     * Load the various { constructor [methods] }
     *
     * Constructors and methods can be disabled by passing a localized var TCParams._disabled (with the hook 'tc_disabled_front_js_parts' )
     * Ex : add_filter('tc_disabled_front_js_parts', function() {
     *   return array('Czr_Plugins' => array() , 'Czr_Slider' => array('addSwipeSupport') );
     * });
     * => will disabled all Czr_Plugin class (with all its methods) + will disabled the addSwipeSupport method from the Czr_Slider class
     * @todo : check the classes dependencies and may be add a check if ( ! method_exits() )
     *
     * @param  {[type]} args [description]
     * @return {[type]}      [description]
     */
    loadCzr : function( args ) {
      var that = this,
          _disabled = that.localized._disabled || {};

      _.each( args, function( methods, key ) {
        //normalize methods into an array if string
        methods = 'string' == typeof(methods) ? [methods] : methods;

        //key is the constructor
        //check if the constructor has been disabled => empty array of methods
        if ( that.localized._disabled[key] && _.isEmpty(that.localized._disabled[key]) )
          return;

        if ( that.localized._disabled[key] && ! _.isEmpty(that.localized._disabled[key]) ) {
          var _to_remove = that.localized._disabled[key];
          _to_remove = 'string' == typeof(_to_remove) ? [_to_remove] : _to_remove;
          methods = _.difference( methods, _to_remove );
        }
        //chain various treatments
        czrapp._inherits(key)._instanciates(key)._addMethods(key)._init(key, methods);
      });//_.each()

      czrapp.trigger('czrapp-ready', this);
    }//loadCzr

  });//extend
})(jQuery, czrapp);



/*************************
* ADD BASE CLASS METHODS
*************************/
(function($, czrapp) {
  var _methods = {
    emit : function( cbs, args ) {
      cbs = _.isArray(cbs) ? cbs : [cbs];
      var self = this;
      _.map( cbs, function(cb) {
        if ( 'function' == typeof(self[cb]) ) {
          self[cb].apply(self, 'undefined' == typeof( args ) ? Array() : args );
          czrapp.trigger( cb, _.object( _.keys(args), args ) );
        }
      });//_.map
    },

    triggerSimpleLoad : function( $_imgs ) {
      if ( 0 === $_imgs.length )
        return;

      $_imgs.map( function( _ind, _img ) {
        $(_img).load( function () {
          $(_img).trigger('simple_load');
        });//end load
        if ( $(_img)[0] && $(_img)[0].complete )
          $(_img).load();
      } );//end map
    },//end of fn

    isUserLogged     : function() {
      return czrapp.$_body.hasClass('logged-in') || 0 !== czrapp.$_wpadminbar.length;
    },

    isCustomizing    : function() {
      return czrapp.$_body.hasClass('is-customizing');
    }

  };//_methods{}

  $.extend( czrapp.Base.prototype, _methods );//$.extend

})(jQuery, czrapp);
