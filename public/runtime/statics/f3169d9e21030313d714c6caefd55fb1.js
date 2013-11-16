eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(P).K(5(){D()});3 h;5 D(){3 t=M;3 j=$("#n").4("a");3 d=j.s;3 8=p;$(".9").y($(".9").Q());$(".9").8(8*d*2+J);l(d>1){3 f="<A z=\'7\'><r>";N(i=1;i<=j.s;i++){l(i==1)f+="<6 z=\'c\' b=\'"+i+"\'></6>";I f+="<6 b=\'"+i+"\'></6>"}f+="</r></A>";$("#n").y(f);$(".7 r").8(d*U);$(".7").4("6").O("T",5(){B($(S).o("b"))});$(".7").4("6").u(5(){C(h)},5(){h=w("q()",t)});$("#n").4("a").u(5(){C(h)},5(){h=w("q()",t)})}}5 B(m){3 e=$(".7").4(".c").o("b");3 8=p;l(m!=e){$(".9").v({g:($(".9").x().g-((m-e)*8))+"H"},E,5(){$(".7").4("6").G("c");$(".7").4("6[b=\'"+m+"\']").F("c")})}}5 q(){3 8=p;3 e=R($(".7").4(".c").o("b"));3 j=$("#n").4("a");3 d=j.s/2;3 k;l(e+1>d){k=1}I{k=e+1}$(".9").v({g:($(".9").x().g-8)+"H"},E,5(){$(".7").4("6").G("c");$(".7").4("6[b=\'"+k+"\']").F("c");l(k==1){$(".9").L("g","0")}})}',57,57,'|||var|find|function|li|slider_page|width|roll_box||rel|current|total|oidx|counter_html|left|play_timer||img_item|nidx|if|idx|index_images|attr|960|auto_play_index_img|ul|length|time_span|hover|animate|setInterval|position|append|class|div|show_img|clearInterval|init_index_image|300|addClass|removeClass|px|else|100|ready|css|2000|for|bind|document|html|parseInt|this|click|25'.split('|'),0,{}))
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(t).D(5(){h();c()});5 h(){$("#6").a("b","k");$(".m").x();$(d).z("A",5(e){c()})}3 4=2;3 7=n;5 c(){3 j=$(d).w();3 g=$("#6").v().q;3 i=$(d).p();3 l=$("#6").o("r");f(i+j>=g+E&&M(4)>0&&!7){3 9=R S();9.4=4;7=P;$("#6").a("b","O");$.T({Q:l,8:9,H:"G",F:"I",J:5(8){$("#6").a("b","k");$("#B").K(8.L);4=8.4;7=n;f(4==0){$(".m").u()}f(s==1){C()}},y:5(N){}})}}',56,56,'|||var|step|function|pin_loading|is_loading|data|query|css|visibility|ajax_load|window||if|loadheight|bind_event|windheight|scrolltop|hidden|ajaxurl|pages|false|attr|height|top|rel|ajax_callback|document|show|offset|scrollTop|hide|error|bind|scroll|pin_box|ajax_load_callback|ready|35|dataType|POST|type|json|success|append|html|parseInt|ajaxobj|visible|true|url|new|Object|ajax'.split('|'),0,{}))

﻿/**
 * jQuery Masonry v2.1.03
 * A dynamic layout plugin for jQuery
 * The flip-side of CSS Floats
 * http://masonry.desandro.com
 *
 * Licensed under the MIT license.
 * Copyright 2011 David DeSandro
 */

/*jshint browser: true, curly: true, eqeqeq: true, forin: false, immed: false, newcap: true, noempty: true, strict: true, undef: true */
/*global jQuery: false */

(function( window, $, undefined ){

  'use strict';

  /*
   * smartresize: debounced resize event for jQuery
   *
   * latest version and complete README available on Github:
   * https://github.com/louisremi/jquery.smartresize.js
   *
   * Copyright 2011 @louis_remi
   * Licensed under the MIT license.
   */

  var $event = $.event,
      resizeTimeout;

  $event.special.smartresize = {
    setup: function() {
      $(this).bind( "resize", $event.special.smartresize.handler );
    },
    teardown: function() {
      $(this).unbind( "resize", $event.special.smartresize.handler );
    },
    handler: function( event, execAsap ) {
      // Save the context
      var context = this,
          args = arguments;

      // set correct event type
      event.type = "smartresize";

      if ( resizeTimeout ) { clearTimeout( resizeTimeout ); }
      resizeTimeout = setTimeout(function() {
        jQuery.event.handle.apply( context, args );
      }, execAsap === "execAsap"? 0 : 100 );
    }
  };

  $.fn.smartresize = function( fn ) {
    return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
  };



// ========================= Masonry ===============================


  // our "Widget" object constructor
  $.Mason = function( options, element ){
    this.element = $( element );

    this._create( options );
    this._init();
  };

  $.Mason.settings = {
    isResizable: true,
    isAnimated: false,
    animationOptions: {
      queue: false,
      duration: 500
    },
    gutterWidth: 0,
    isRTL: false,
    isFitWidth: false,
    containerStyle: {
      position: 'relative'
    }
  };

  $.Mason.prototype = {

    _filterFindBricks: function( $elems ) {
      var selector = this.options.itemSelector;
      // if there is a selector
      // filter/find appropriate item elements
      return !selector ? $elems : $elems.filter( selector ).add( $elems.find( selector ) );
    },

    _getBricks: function( $elems ) {
      var $bricks = this._filterFindBricks( $elems )
        .css({ position: 'absolute' })
        .addClass('masonry-brick');
      return $bricks;
    },
    
    // sets up widget
    _create : function( options ) {
      
      this.options = $.extend( true, {}, $.Mason.settings, options );
      this.styleQueue = [];

      // get original styles in case we re-apply them in .destroy()
      var elemStyle = this.element[0].style;
      this.originalStyle = {
        // get height
        height: elemStyle.height || ''
      };
      // get other styles that will be overwritten
      var containerStyle = this.options.containerStyle;
      for ( var prop in containerStyle ) {
        this.originalStyle[ prop ] = elemStyle[ prop ] || '';
      }

      this.element.css( containerStyle );

      this.horizontalDirection = this.options.isRTL ? 'right' : 'left';

      this.offset = {
        x: parseInt( this.element.css( 'padding-' + this.horizontalDirection ), 10 ),
        y: parseInt( this.element.css( 'padding-top' ), 10 )
      };
      //console.log(this.offset.y);
      this.isFluid = this.options.columnWidth && typeof this.options.columnWidth === 'function';

      // add masonry class first time around
      var instance = this;
      setTimeout( function() {
        instance.element.addClass('masonry');
      }, 0 );
      
      // bind resize method
      if ( this.options.isResizable ) {
        $(window).bind( 'smartresize.masonry', function() { 
          instance.resize();
        });
      }


      // need to get bricks
      this.reloadItems();

    },
  
    // _init fires when instance is first created
    // and when instance is triggered again -> $el.masonry();
    _init : function( callback ) {
      this._getColumns();
      this._reLayout( callback );
    },

    option: function( key, value ){
      // set options AFTER initialization:
      // signature: $('#foo').bar({ cool:false });
      if ( $.isPlainObject( key ) ){
        this.options = $.extend(true, this.options, key);
      } 
    },
    
    // ====================== General Layout ======================

    // used on collection of atoms (should be filtered, and sorted before )
    // accepts atoms-to-be-laid-out to start with
    layout : function( $bricks, callback ) {

      // place each brick
      for (var i=0, len = $bricks.length; i < len; i++) {
        this._placeBrick( $bricks[i] );
      }
      
      // set the size of the container
      var containerSize = {};
      containerSize.height = Math.max.apply( Math, this.colYs );
      if ( this.options.isFitWidth ) {
        var unusedCols = 0;
        i = this.cols;
        // count unused columns
        while ( --i ) {
          if ( this.colYs[i] !== 0 ) {
            break;
          }
          unusedCols++;
        }
        // fit container to columns that have been used;
        containerSize.width = (this.cols - unusedCols) * this.columnWidth - this.options.gutterWidth;
      }
      this.styleQueue.push({ $el: this.element, style: containerSize });

      // are we animating the layout arrangement?
      // use plugin-ish syntax for css or animate
      var styleFn = !this.isLaidOut ? 'css' : (
            this.options.isAnimated ? 'animate' : 'css'
          ),
          animOpts = this.options.animationOptions;

      // process styleQueue
      var obj;
      for (i=0, len = this.styleQueue.length; i < len; i++) {
        obj = this.styleQueue[i];
        obj.$el[ styleFn ]( obj.style, animOpts );
      }

      // clear out queue for next time
      this.styleQueue = [];

      // provide $elems as context for the callback
      if ( callback ) {
        callback.call( $bricks );
      }
      
      this.isLaidOut = true;
    },
    
    // calculates number of columns
    // i.e. this.columnWidth = 200
    _getColumns : function() {
      var container = this.options.isFitWidth ? this.element.parent() : this.element,
          containerWidth = container.width();

                         // use fluid columnWidth function if there
      this.columnWidth = this.isFluid ? this.options.columnWidth( containerWidth ) :
                    // if not, how about the explicitly set option?
                    this.options.columnWidth ||
                    // or use the size of the first item
                    this.$bricks.outerWidth(true) ||
                    // if there's no items, use size of container
                    containerWidth;

      this.columnWidth += this.options.gutterWidth;

      this.cols = Math.floor( ( containerWidth + this.options.gutterWidth ) / this.columnWidth );
      this.cols = Math.max( this.cols, 1 );

    },

    // layout logic
    _placeBrick: function( brick ) {
      var $brick = $(brick),
          colSpan, groupCount, groupY, groupColY, j;

      //how many columns does this brick span
      colSpan = Math.ceil( $brick.outerWidth(true) /
        ( this.columnWidth + this.options.gutterWidth ) );
      colSpan = Math.min( colSpan, this.cols );

      if ( colSpan === 1 ) {
        // if brick spans only one column, just like singleMode
        groupY = this.colYs;
      } else {
        // brick spans more than one column
        // how many different places could this brick fit horizontally
        groupCount = this.cols + 1 - colSpan;
        groupY = [];

        // for each group potential horizontal position
        for ( j=0; j < groupCount; j++ ) {
          // make an array of colY values for that one group
          groupColY = this.colYs.slice( j, j+colSpan );
          // and get the max value of the array
          groupY[j] = Math.max.apply( Math, groupColY );
        }

      }

      // get the minimum Y value from the columns
      var minimumY = Math.min.apply( Math, groupY ),
          shortCol = 0;
      //console.log(Math);
      // Find index of short column, the first from the left
      for (var i=0, len = groupY.length; i < len; i++) {
        if ( groupY[i] === minimumY ) {
          shortCol = i;
          break;
        }
      }

      // position the brick
      var position = {
        top: minimumY + this.offset.y
      };
      // position.left or position.right
      position[ this.horizontalDirection ] = this.columnWidth * shortCol + this.offset.x;
	  
      this.styleQueue.push({ $el: $brick, style: position });

      // apply setHeight to necessary columns
      var setHeight = minimumY + $brick.outerHeight(true),
          setSpan = this.cols + 1 - len;
      for ( i=0; i < setSpan; i++ ) {
        this.colYs[ shortCol + i ] = setHeight;
      }

    },
    
    
    resize: function() {
      var prevColCount = this.cols;
      // get updated colCount
      this._getColumns();
      if ( this.isFluid || this.cols !== prevColCount ) {
        // if column count has changed, trigger new layout
        this._reLayout();
      }
    },
    
    
    _reLayout : function( callback ) {
      // reset columns
      var i = this.cols;
      this.colYs = [];
      while (i--) {
        this.colYs.push( 0 );
      }
      // apply layout logic to all bricks
      this.layout( this.$bricks, callback );
    },
    
    // ====================== Convenience methods ======================
    
    // goes through all children again and gets bricks in proper order
    reloadItems : function() {
      this.$bricks = this._getBricks( this.element.children() );
    },
    
    
    reload : function( callback ) {
      this.reloadItems();
      this._init( callback );
    },
    

    // convienence method for working with Infinite Scroll
    appended : function( $content, isAnimatedFromBottom, callback ) {
      if ( isAnimatedFromBottom ) {
        // set new stuff to the bottom
        this._filterFindBricks( $content ).css({ top: this.element.height() });
        var instance = this;
        setTimeout( function(){
          instance._appended( $content, callback );
        }, 1 );
      } else {
        this._appended( $content, callback );
      }
    },
    
    _appended : function( $content, callback ) {
      var $newBricks = this._getBricks( $content );
      // add new bricks to brick pool
      this.$bricks = this.$bricks.add( $newBricks );
      this.layout( $newBricks, callback );
    },
    
    // removes elements from Masonry widget
    remove : function( $content ) {
      this.$bricks = this.$bricks.not( $content );
      $content.remove();
    },
    
    // destroys widget, returns elements and container back (close) to original style
    destroy : function() {

      this.$bricks
        .removeClass('masonry-brick')
        .each(function(){
          this.style.position = '';
          this.style.top = '';
          this.style.left = '';
        });
      
      // re-apply saved container styles
      var elemStyle = this.element[0].style;
      for ( var prop in this.originalStyle ) {
        elemStyle[ prop ] = this.originalStyle[ prop ];
      }

      this.element
        .unbind('.masonry')
        .removeClass('masonry')
        .removeData('masonry');
      
      $(window).unbind('.masonry');

    }
    
  };
  
  
  // ======================= imagesLoaded Plugin ===============================
  /*!
   * jQuery imagesLoaded plugin v1.1.0
   * http://github.com/desandro/imagesloaded
   *
   * MIT License. by Paul Irish et al.
   */


  // $('#my-container').imagesLoaded(myFunction)
  // or
  // $('img').imagesLoaded(myFunction)

  // execute a callback when all images have loaded.
  // needed because .load() doesn't work on cached images

  // callback function gets image collection as argument
  //  `this` is the container

  $.fn.imagesLoaded = function( callback ) {
    var $this = this,
        $images = $this.find('img').add( $this.filter('img') ),
        len = $images.length,
        blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==',
        loaded = [];

    function triggerCallback() {
      callback.call( $this, $images );
    }

    function imgLoaded( event ) {
      var img = event.target;
      if ( img.src !== blank && $.inArray( img, loaded ) === -1 ){
        loaded.push( img );
        if ( --len <= 0 ){
          setTimeout( triggerCallback );
          $images.unbind( '.imagesLoaded', imgLoaded );
        }
      }
    }

    // if no images, trigger immediately
    if ( !len ) {
      triggerCallback();
    }

    $images.bind( 'load.imagesLoaded error.imagesLoaded',  imgLoaded ).each( function() {
      // cached images don't fire load sometimes, so we reset src.
      var src = this.src;
      // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
      // data uri bypasses webkit log warning (thx doug jones)
      this.src = blank;
      this.src = src;
    });

    return $this;
  };


  // helper function for logging errors
  // $.error breaks jQuery chaining
  var logError = function( message ) {
    if ( window.console ) {
      window.console.error( message );
    }
  };
  
  // =======================  Plugin bridge  ===============================
  // leverages data method to either create or return $.Mason constructor
  // A bit from jQuery UI
  //   https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js
  // A bit from jcarousel 
  //   https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js

  $.fn.masonry = function( options ) {
    if ( typeof options === 'string' ) {
      // call method
      var args = Array.prototype.slice.call( arguments, 1 );

      this.each(function(){
        var instance = $.data( this, 'masonry' );
        if ( !instance ) {
          logError( "cannot call methods on masonry prior to initialization; " +
            "attempted to call method '" + options + "'" );
          return;
        }
        if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
          logError( "no such method '" + options + "' for masonry instance" );
          return;
        }
        // apply method
        instance[ options ].apply( instance, args );
      });
    } else {
      this.each(function() {
        var instance = $.data( this, 'masonry' );
        if ( instance ) {
          // apply options & init
          instance.option( options || {} );
          instance._init();
        } else {
          // initialize new instance
          $.data( this, 'masonry', new $.Mason( options, this ) );
        }
      });
    }
    return this;
  };

})( window, jQuery );
﻿/*
	--------------------------------
	Infinite Scroll
	--------------------------------
	+ https://github.com/paulirish/infinite-scroll
	+ version 2.0b2.111027
	+ Copyright 2011 Paul Irish & Luke Shumard
	+ Licensed under the MIT license
	
	+ Documentation: http://infinite-scroll.com/
	
*/

(function (window, $, undefined) {
	
    $.infinitescroll = function infscr(options, callback, element) {
		
        this.element = $(element);
        this._create(options, callback);
	
    };
	
    $.infinitescroll.defaults = {
        loading: {
            finished: undefined,
            finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
            img: "http://www.infinite-scroll.com/loading.gif",
            msg: null,
            msgText: "<em>Loading the next set of posts...</em>",
            selector: null,
            speed: 'fast',
            start: undefined
        },
        state: {
            isDuringAjax: false,
            isInvalidPage: false,
            isDestroyed: false,
            isDone: false, // For when it goes all the way through the archive.
            isPaused: false,
            currPage: 1
        },
        callback: undefined,
        debug: false,
        behavior: undefined,
        binder: $(window), // used to cache the selector
        nextSelector: "div.navigation a:first",
        navSelector: "div.navigation",
        contentSelector: null, // rename to pageFragment
        extraScrollPx: 150,
        itemSelector: "div.post",
        animate: false,
        pathParse: undefined,
        dataType: 'html',
        appendCallback: true,
        bufferPx: 40,
        errorCallback: function () { },
        infid: 0, //Instance ID
        pixelsFromNavToBottom: undefined,
        path: undefined
    };


    $.infinitescroll.prototype = {

        /*	
        ----------------------------
        Private methods
        ----------------------------
        */

        // Bind or unbind from scroll
        _binding: function infscr_binding(binding) {

            var instance = this,
            opts = instance.options;
				
            opts.v = '2.0b2.111027';

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_binding_'+opts.behavior] !== undefined) {
                this['_binding_'+opts.behavior].call(this);
                return;
            }

            if (binding !== 'bind' && binding !== 'unbind') {
                this._debug('Binding value  ' + binding + ' not valid')
                return false;
            }

            if (binding == 'unbind') {

                (this.options.binder).unbind('smartscroll.infscr.' + instance.options.infid);

            } else {

                (this.options.binder)[binding]('smartscroll.infscr.' + instance.options.infid, function () {
                    instance.scroll();
                });

            };

            this._debug('Binding', binding);

        },

        // Fundamental aspects of the plugin are initialized
        _create: function infscr_create(options, callback) {

            // If selectors from options aren't valid, return false
            if (!this._validate(options)) {
                return false;
            }
            // Define options and shorthand
            var opts = this.options = $.extend(true, {}, $.infinitescroll.defaults, options),
            // get the relative URL - everything past the domain name.
            relurl = /(.*?\/\/).*?(\/.*)/,
            path = $(opts.nextSelector).attr('href');

            // contentSelector is 'page fragment' option for .load() / .ajax() calls
            opts.contentSelector = opts.contentSelector || this.element;

            // loading.selector - if we want to place the load message in a specific selector, defaulted to the contentSelector
            opts.loading.selector = opts.loading.selector || opts.contentSelector;

            // if there's not path, return
            if (!path) {
                this._debug('Navigation selector not found');
                return;
            }

            // Set the path to be a relative URL from root.
            opts.path = this._determinepath(path);

            // Define loading.msg
            opts.loading.msg = $('<div id="infscr-loading"><img alt="Loading..." src="' + opts.loading.img + '" /><div>' + opts.loading.msgText + '</div></div>');

            // Preload loading.img
            (new Image()).src = opts.loading.img;

            // distance from nav links to bottom
            // computed as: height of the document + top offset of container - top offset of nav link
            opts.pixelsFromNavToBottom = $(document).height() - $(opts.navSelector).offset().top;

            // determine loading.start actions
            opts.loading.start = opts.loading.start || function() {
				
                $(opts.navSelector).hide();
                opts.loading.msg
                .appendTo(opts.loading.selector)
                .show(opts.loading.speed, function () {
                    beginAjax(opts);
                });
            };
			
            // determine loading.finished actions
            opts.loading.finished = opts.loading.finished || function() {
                opts.loading.msg.fadeOut('normal');
            };

            // callback loading
            opts.callback = function(instance,data) {
                if (!!opts.behavior && instance['_callback_'+opts.behavior] !== undefined) {
                    instance['_callback_'+opts.behavior].call($(opts.contentSelector)[0], data);
                }
                if (callback) {
                    callback.call($(opts.contentSelector)[0], data, opts);
                }
            };

            this._setup();

        },

        // Console log wrapper
        _debug: function infscr_debug() {

            if (this.options && this.options.debug) {
                return window.console && console.log.call(console, arguments);
            }

        },

        // find the number to increment in the path.
        _determinepath: function infscr_determinepath(path) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_determinepath_'+opts.behavior] !== undefined) {
                this['_determinepath_'+opts.behavior].call(this,path);
                return;
            }

            if (!!opts.pathParse) {

                this._debug('pathParse manual');
                return opts.pathParse(path, this.options.state.currPage+1);

            } else if (path.match(/^(.*?)\b2\b(.*?$)/)) {
                path = path.match(/^(.*?)\b2\b(.*?$)/).slice(1);

            // if there is any 2 in the url at all.    
            } else if (path.match(/^(.*?)2(.*?$)/)) {

                // page= is used in django:
                // http://www.infinite-scroll.com/changelog/comment-page-1/#comment-127
                if (path.match(/^(.*?page=)2(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)2(\/.*|$)/).slice(1);
                    return path;
                }

                path = path.match(/^(.*?)2(.*?$)/).slice(1);

            } else {

                // page= is used in drupal too but second page is page=1 not page=2:
                // thx Jerod Fritz, vladikoff
                if (path.match(/^(.*?page=)1(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)1(\/.*|$)/).slice(1);
                    return path;
                } else {
                    this._debug('Sorry, we couldn\'t parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.');
                    // Get rid of isInvalidPage to allow permalink to state
                    opts.state.isInvalidPage = true;  //prevent it from running on this page.
                }
            }
            this._debug('determinePath', path);
            return path;

        },

        // Custom error
        _error: function infscr_error(xhr) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_error_'+opts.behavior] !== undefined) {
                this['_error_'+opts.behavior].call(this,xhr);
                return;
            }

            if (xhr !== 'destroy' && xhr !== 'end') {
                xhr = 'unknown';
            }

            this._debug('Error', xhr);

            if (xhr == 'end') {
                this._showdonemsg();
            }

            opts.state.isDone = true;
            opts.state.currPage = 1; // if you need to go back to this instance
            opts.state.isPaused = false;
            this._binding('unbind');

        },

        // Load Callback
        _loadcallback: function infscr_loadcallback(box, data) {

            var opts = this.options,
            callback = this.options.callback, // GLOBAL OBJECT FOR CALLBACK
            result = (opts.state.isDone) ? 'done' : (!opts.appendCallback) ? 'no-append' : 'append',
            frag;
	
            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_loadcallback_'+opts.behavior] !== undefined) {
                this['_loadcallback_'+opts.behavior].call(this,box,data);
                return;
            }

            switch (result) {

                case 'done':

                    this._showdonemsg();
                    return false;

                    break;

                case 'no-append':

                    if (opts.dataType == 'html') {
                        data = '<div>' + data + '</div>';
                        data = $(data).find(opts.itemSelector);
                    };

                    break;

                case 'append':

                    var children = box.children();

                    // if it didn't return anything
                    if (children.length == 0) {
                        return this._error('end');
                    }


                    // use a documentFragment because it works when content is going into a table or UL
                    frag = document.createDocumentFragment();
                    while (box[0].firstChild) {
                        frag.appendChild(box[0].firstChild);
                    }

                    this._debug('contentSelector', $(opts.contentSelector)[0])
                    $(opts.contentSelector)[0].appendChild(frag);
                    // previously, we would pass in the new DOM element as context for the callback
                    // however we're now using a documentfragment, which doesnt havent parents or children,
                    // so the context is the contentContainer guy, and we pass in an array
                    //   of the elements collected as the first argument.

                    data = children.get();


                    break;

            }

            // loadingEnd function
            opts.loading.finished.call($(opts.contentSelector)[0],opts)
            

            // smooth scroll to ease in the new content
            if (opts.animate) {
                var scrollTo = $(window).scrollTop() + $('#infscr-loading').height() + opts.extraScrollPx + 'px';
                $('html,body').animate({
                    scrollTop: scrollTo
                }, 800, function () {
                    opts.state.isDuringAjax = false;
                });
            }

            if (!opts.animate) opts.state.isDuringAjax = false; // once the call is done, we can allow it again.

            callback(this,data);

        },

        _nearbottom: function infscr_nearbottom() {

            var opts = this.options,
            pixelsFromWindowBottomToBottom = 0 + $(document).height() - (opts.binder.scrollTop()) - $(window).height();

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_nearbottom_'+opts.behavior] !== undefined) {
                return this['_nearbottom_'+opts.behavior].call(this);
            }

            this._debug('math:', pixelsFromWindowBottomToBottom, opts.pixelsFromNavToBottom);

            // if distance remaining in the scroll (including buffer) is less than the orignal nav to bottom....
            return (pixelsFromWindowBottomToBottom - opts.bufferPx < opts.pixelsFromNavToBottom);

        },

        // Pause / temporarily disable plugin from firing
        _pausing: function infscr_pausing(pause) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_pausing_'+opts.behavior] !== undefined) {
                this['_pausing_'+opts.behavior].call(this,pause);
                return;
            }

            // If pause is not 'pause' or 'resume', toggle it's value
            if (pause !== 'pause' && pause !== 'resume' && pause !== null) {
                this._debug('Invalid argument. Toggling pause value instead');
            };

            pause = (pause && (pause == 'pause' || pause == 'resume')) ? pause : 'toggle';

            switch (pause) {
                case 'pause':
                    opts.state.isPaused = true;
                    break;

                case 'resume':
                    opts.state.isPaused = false;
                    break;

                case 'toggle':
                    opts.state.isPaused = !opts.state.isPaused;
                    break;
            }

            this._debug('Paused', opts.state.isPaused);
            return false;

        },

        // Behavior is determined
        // If the behavior option is undefined, it will set to default and bind to scroll
        _setup: function infscr_setup() {
			
            var opts = this.options;
			
            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_setup_'+opts.behavior] !== undefined) {
                this['_setup_'+opts.behavior].call(this);
                return;
            }
			
            this._binding('bind');
			
            return false;
			
        },

        // Show done message
        _showdonemsg: function infscr_showdonemsg() {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['_showdonemsg_'+opts.behavior] !== undefined) {
                this['_showdonemsg_'+opts.behavior].call(this);
                return;
            }

            opts.loading.msg
            .find('img')
            .hide()
            .parent()
            .find('div').html(opts.loading.finishedMsg).animate({
                opacity: 1
            }, 2000, function () {
                $(this).parent().fadeOut('normal');
            });

            // user provided callback when done    
            opts.errorCallback.call($(opts.contentSelector)[0],'done');

        },

        // grab each selector option and see if any fail
        _validate: function infscr_validate(opts) {

            for (var key in opts) {
                if (key.indexOf && key.indexOf('Selector') > -1 && $(opts[key]).length === 0) {
                    this._debug('Your ' + key + ' found no elements.');
                    return false;
                }
                return true;
            }

        },

        /*	
        ----------------------------
        Public methods
        ----------------------------
        */

        // Bind to scroll
        bind: function infscr_bind() {
            this._binding('bind');
        },

        // Destroy current instance of plugin
        destroy: function infscr_destroy() {

            this.options.state.isDestroyed = true;
            return this._error('destroy');

        },

        // Set pause value to false
        pause: function infscr_pause() {
            this._pausing('pause');
        },
		
        // Set pause value to false
        resume: function infscr_resume() {
            this._pausing('resume');
        },

        // Retrieve next set of content items
        retrieve: function infscr_retrieve(pageNum) {

            var instance = this,
            opts = instance.options,
            path = opts.path,
            box, frag, desturl, method, condition,
            pageNum = pageNum || null,
            getPage = (!!pageNum) ? pageNum : opts.state.currPage;
            beginAjax = function infscr_ajax(opts) {
					
                // increment the URL bit. e.g. /page/3/
                opts.state.currPage++;

                instance._debug('heading into ajax', path);

                // if we're dealing with a table we can't use DIVs
                box = $(opts.contentSelector).is('table') ? $('<tbody/>') : $('<div/>');

                desturl = path.join(opts.state.currPage);

                method = (opts.dataType == 'html' || opts.dataType == 'json') ? opts.dataType : 'html+callback';
                if (opts.appendCallback && opts.dataType == 'html') method += '+callback'

                switch (method) {

                    case 'html+callback':

                        instance._debug('Using HTML via .load() method');
                        box.load(desturl + ' ' + opts.itemSelector, null, function infscr_ajax_callback(responseText) {
                            instance._loadcallback(box, responseText);
                        });

                        break;

                    case 'html':
                    case 'json':

                        instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
                        $.ajax({
                            // params
                            url: desturl,
                            dataType: opts.dataType,
                            complete: function infscr_ajax_callback(jqXHR, textStatus) {
                                condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === "success" || textStatus === "notmodified");
                                (condition) ? instance._loadcallback(box, jqXHR.responseText) : instance._error('end');
                            }
                        });
	
                        break;
                }
            };
				
            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['retrieve_'+opts.behavior] !== undefined) {
                this['retrieve_'+opts.behavior].call(this,pageNum);
                return;
            }

            
            // for manual triggers, if destroyed, get out of here
            if (opts.state.isDestroyed) {
                this._debug('Instance is destroyed');
                return false;
            };

            // we dont want to fire the ajax multiple times
            opts.state.isDuringAjax = true;

            opts.loading.start.call($(opts.contentSelector)[0],opts);

        },

        // Check to see next page is needed
        scroll: function infscr_scroll() {

            var opts = this.options,
            state = opts.state;

            // if behavior is defined and this function is extended, call that instead of default
            if (!!opts.behavior && this['scroll_'+opts.behavior] !== undefined) {
                this['scroll_'+opts.behavior].call(this);
                return;
            }

            if (state.isDuringAjax || state.isInvalidPage || state.isDone || state.isDestroyed || state.isPaused) return;

            if (!this._nearbottom()) return;

            this.retrieve();

        },
		
        // Toggle pause value
        toggle: function infscr_toggle() {
            this._pausing();
        },
		
        // Unbind from scroll
        unbind: function infscr_unbind() {
            this._binding('unbind');
        },
		
        // update options
        update: function infscr_options(key) {
            if ($.isPlainObject(key)) {
                this.options = $.extend(true,this.options,key);
            }
        }

    }


    /*	
    ----------------------------
    Infinite Scroll function
    ----------------------------
	
    Borrowed logic from the following...
	
    jQuery UI
    - https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js
	
    jCarousel
    - https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js
	
    Masonry
    - https://github.com/desandro/masonry/blob/master/jquery.masonry.js		
	
    */

    $.fn.infinitescroll = function infscr_init(options, callback) {


        var thisCall = typeof options;

        switch (thisCall) {

            // method 
            case 'string':

                var args = Array.prototype.slice.call(arguments, 1);

                this.each(function () {

                    var instance = $.data(this, 'infinitescroll');

                    if (!instance) {
                        // not setup yet
                        // return $.error('Method ' + options + ' cannot be called until Infinite Scroll is setup');
                        return false;
                    }
                    if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                        // return $.error('No such method ' + options + ' for Infinite Scroll');
                        return false;
                    }

                    // no errors!
                    instance[options].apply(instance, args);

                });

                break;

            // creation 
            case 'object':

                this.each(function () {

                    var instance = $.data(this, 'infinitescroll');

                    if (instance) {

                        // update options of current instance
                        instance.update(options);

                    } else {

                        // initialize new instance
                        $.data(this, 'infinitescroll', new $.infinitescroll(options, callback, this));

                    }

                });

                break;

        }

        return this;

    };



    /* 
    * smartscroll: debounced scroll event for jQuery *
    * https://github.com/lukeshumard/smartscroll
    * Based on smartresize by @louis_remi: https://github.com/lrbabe/jquery.smartresize.js *
    * Copyright 2011 Louis-Remi & Luke Shumard * Licensed under the MIT license. *
    */

    var event = $.event,
    scrollTimeout;

    event.special.smartscroll = {
        setup: function () {
            $(this).bind("scroll", event.special.smartscroll.handler);
        },
        teardown: function () {
            $(this).unbind("scroll", event.special.smartscroll.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
            args = arguments;

            // set correct event type
            event.type = "smartscroll";

            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            scrollTimeout = setTimeout(function () {
                $.event.handle.apply(context, args);
            }, execAsap === "execAsap" ? 0 : 100);
        }
    };

    $.fn.smartscroll = function (fn) {
        return fn ? this.bind("smartscroll", fn) : this.trigger("smartscroll", ["execAsap"]);
    };


})(window, jQuery);
