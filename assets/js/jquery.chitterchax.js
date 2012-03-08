/**
 * @projectDescription Chitterchax is a jQuery plugin to hand the communication between the chat server and chit client, as well as handling the gui elements.
 * 
 * @author Chris Churchwell chrisrulesall@gmail.com
 */

/**
 * @param {jQuery} jQuery Object
 */
(function( $ ) {
	
	/**
	 * Main global usage function to handle user input.
	 * 
	 * @param {String, Object} [arg1] If empty or an object it will start the initialization of the plugin. If a string will call the method that matches the string.
     * @return {jQuery} Returns itself for chaining
	 * @example $.chitterchax();
	 */
	$.chitterchax = function( arg1, arg2 ) {
		
		if ( arg1 === undefined || typeof arg1 === 'object' ) {
			return $.chitterchax.methods.init.apply(this, arguments);
		
		} else if ( $.chitterchax.methods[arg1] ) {
			return $.chitterchax.methods[ arg1 ].apply(this, $.makeArray(arguments).slice(1));
		
		} else {
   			$.error( 'Method ' +  arg1 + ' does not exist on jQuery.chitterchax' );
    	}
    	
    	return this;
	};
	
	$.fn.chitterchax = function( arg1 ) {
        
        if ( $.chitterchax.fnmethods[arg1] ) {
            return $.chitterchax.fnmethods[ arg1 ].apply(this, $.makeArray(arguments).slice(1));
        
        } else {
            $.error( 'Method ' +  arg1 + ' does not exist on jQuery.fn.chitterchax' );
        }
	    return this; 
	    
	};
	
	/**
	 * A request object to create, 
	 */
	$.chitterchax.communication = {
        
        //connect the chat. basically all this mean is request user info from server and starting data
        connect: function() {
            
            $.chitterchax("notify", "networkStatus", 1); //1= status connecting
            
            var data = {
                'action': 'connect',
                'last_id': $.chitterchax.data.last_id
            };
            this._request( data );
        },
        
        //submit chat
        submit: function( message ) {
            var data = {
                'action': 'submit',
                'last_id': $.chitterchax.data.last_id,
                'message': $.trim( message )
            }
            this._request( data );
        },
        
        //send an update request.
        update: function() {
            var data = {
                'action': 'update',
                'last_id': $.chitterchax.data.last_id
            }
            this._request( data );
        },
        
        //send request
        _request: function( pdata ) {
            
            $.chitterchax('cancelTimer');
            
            $.ajax({
                url: $.chitterchax('setting', 'ajax_url'),
                dataType: "json",
                type: "POST",
                data: pdata
            })
            //on success
            .done( function(msg){
                //console.log(msg);
                $.chitterchax("notify", "networkStatus", 0); //0 = status connected
                $.chitterchax.communication._parseResponse(msg);
            })
            //called whethere successs, or error, regardless when done
            .always(function(){
                //console.log( "always");
                $.chitterchax("resetTimer");
            })
            //error
            .fail(function( jqXHR, textStatus ) {
                //console.log( "Request failed: " + textStatus, jqXHR );
                $.chitterchax("notify", "networkStatus", 2); //2 = status error
            });
        },
        
        _parseResponse : function(data)
        {
            //console.dir(data);
            if (data.actions){
                if (data.actions.redirect) {
                    window.location = data.actions.redirect;
                }
            }
            
            if ( data.data ) {
                $.each(data.data, function( key, val ) {
                    $.chitterchax.data[key] = val;
                });
            }
            
            if ( data.users ) {
                //console.dir(data.users);
                var users = data.users;
                $.chitterchax("notify", "usersOnline", users); //2 = status error
            }
            
            if ( data.messages ) {
                //try to find the highest value id and update lastId.
                $.each(data.messages, function( key, val ) {
                    if (parseInt(val.id) > $.chitterchax.data.last_id) {
                        $.chitterchax.data.last_id = parseInt(val.id);
                    }
                });
                $.chitterchax("notify", "newChatMessages", data.messages);
            }
        }
        
    };
    
    $.chitterchax.data = {
        'is_connected': false,
        'last_id': 0,
        'user_id': undefined,
        'username': undefined,
        'user_role': undefined,
        'channel_id': undefined,
        'channel_name': undefined,
        'timerRateId': undefined
    }
    
	$.chitterchax.defaults = {
	    main: {
            'ajax_url':'/index.php/chitterchax/ajax',    //NO TRAILING SLASH!!!
            'updateTimer': 2000
	    },
	    linkNetworkStatus: {
	        'styleConnected' : 'statusContainerOff',
	        'styleConnecting' : 'statusContainerOn',
	        'styleDisconnected' : 'statusContainerAlert',
	        'onStatusUpdate' : function(e, status){
	            var data = $(this).data('chitterchax');
	            $(this).toggleClass(data.styleConnected, (status == 0));
	            $(this).toggleClass(data.styleConnecting, (status == 1));
	            $(this).toggleClass(data.styleDisconnected, (status == 2));
	        }
	    },
	    linkOnlineUsers: {
	        'templateId': 'template-online-user',
	        'onUserList':function( e, users ) {
                $(this).empty();
                var templateId = $(this).data("chitterchax").templateId;
                var $this = $(this);
                $.each( users, function( key, val ) {
                    var $newitem = $('#'+templateId).clone();
                    $newitem.removeClass("hidden");
                    $newitem.attr("id", "");
                    //add the data to html5 data-attributes. remember jquery forces lower case.
                    $.each( val, function( k, v ) {
                        $newitem.attr( "data-"+k, v );
                    });
                    $(".user", $newitem).text( val.username );
                    $this.append($newitem);
                });
                //remembering that counts are 0 based, the first element (odd) will be 0, and the second element (even) will be 1.
                $this.children(":even").addClass("rowOdd");
                $this.children(":odd").addClass("rowEven");
            }
	    },
	    linkChat: {
            'templateId': 'template-chat-message',
            'onMessages': function( e, messages ) {
                var templateId = $(this).data("chitterchax").templateId;
                var $this = $(this);
                $.each( messages, function( key, val ) {
                    var $newRow = $('#'+templateId).clone();
                    $newRow.removeClass('hidden');
                    $newRow.attr('id', '');
                    $('.datetime', $newRow).text( val.datetime );
                    $('.user', $newRow).text( val.username );
                    $('.message-text', $newRow).html( val.text );
                    var countNext = $this.children().length + 1;
                    if(countNext%2 == 0) {
                        $newRow.addClass("rowEven");
                    } else {
                        $newRow.addClass("rowOdd");
                    }
                    //no need for message in data-atts
                    delete val.text;
                    $.each( val, function( k, v ) {
                        $newRow.attr( "data-"+k, v );
                    });
                    $this.append($newRow);
                });
                //$(this).animate({ scrollTop: $(this).attr("scrollHeight") - $(this).height() }, 3000);
                
                $(this).animate({   
                    scrollTop: $(this)[0].scrollHeight + "px"
                });
                
            }
        },
        linkInput: {
            'maxCharacters': 1040,
            'counterId': 'messageLengthCounter',
            'buttonId': 'submitButton',
            'onKeyUp': function( e ) {
                var data = $(this).data("chitterchax");
                var chars = $(this).val().length;
                $('#'+data.counterId).text( chars+" / "+data.maxCharacters );
            },
            'onKeyPress': function( e ) {
                if (e.which == 13 && e.shiftKey == false)
                {
                    e.preventDefault();
                    $(this).trigger('submitChat');
                }
            },
            'onSubmit': function( e ) {
                var text = $(this).val();
                var data = $(this).data('chitterchax');
                //reset field.
                $(this).val("");
                $('#'+data.counterId).text( "0 / " + data.maxCharacters );
                text = $.trim(text);
                if (text) {
                    $.chitterchax.communication.submit( text );
                }
            }
        }
    };
    
    $.chitterchax.fnmethods = {
        
        linkNetworkStatus: function( options ) {
            
            return this.each( function() {
                var $this = $(this);
                var data = $this.data('chitterchax');
                
                // If the plugin hasn't been initialized yet
                if ( ! data ) {
                    $this.data( "chitterchax", $.extend( $.chitterchax.defaults.linkNetworkStatus, options ));
                    $this.chitterchax("bindEvent", "networkStatus", $this.data("chitterchax").onStatusUpdate);
                }
            });
        },
        
        linkChat: function( options ) {
            
            return this.each( function() {
                var $this = $(this);
                var data = $this.data('chitterchax');
                
                // If the plugin hasn't been initialized yet
                if ( ! data ) {
                    $this.data( "chitterchax", $.extend( $.chitterchax.defaults.linkChat, options ));
                    $this.chitterchax("bindEvent", "newChatMessages", $this.data("chitterchax").onMessages);
                }
            });
        },
        
        linkOnlineUsers: function( options ) {
            
            return this.each( function() {
                var $this = $(this);
                var data = $this.data('chitterchax');
                
                // If the plugin hasn't been initialized yet
                if ( ! data ) {
                    $this.data( "chitterchax", $.extend( $.chitterchax.defaults.linkOnlineUsers, options ));
                    $this.chitterchax("bindEvent", "usersOnline", $this.data("chitterchax").onUserList);
                }
            });
        },
        
        linkInput: function( options ) {
            return this.each( function() {
                var $this = $(this);
                var data = $this.data('chitterchax');
                
                // If the plugin hasn't been initialized yet
                if ( ! data ) {
                    $this.data( "chitterchax", $.extend( $.chitterchax.defaults.linkInput, options ));
                    data = $this.data('chitterchax');
                    $this.keyup( data.onKeyUp );
                    $this.keypress( data.onKeyPress );
                    $this.bind( "submitChat", data.onSubmit );
                    $('#'+data.counterId).text("0 / "+data.maxCharacters);
                    $('#'+data.buttonId).data('chitterchax', $(this));
                    $('#'+data.buttonId).click(function( e ) {
                        $(this).data('chitterchax').trigger('submitChat');
                    });
                }
            });
        },
        
        bindEvent: function( eventName, callback ) {
            return this.each( function() {
                $(this).bind( eventName, callback );
            });
        }
        
    };
    
    $.chitterchax.methods = {
            
        init: function( options ) {
                
            if ( !$.chitterchax.settings ) {
                $.chitterchax.settings = $.extend( $.chitterchax.defaults.main, options ) ;
            } else {
                $.error( 'chitterchax has already been initiated.' );
            }
            return this;
        },
        
        //gets a setting, or sets a setting if a second value is present.
        setting: function( key, value ) {
            
            if ( value ) {
                //value is prsent update the setting.
                $.chitterchax.settings[key] = value;
                return this;
            } else {
                return $.chitterchax.settings[key];
            }
        },
        
        start: function() {
            
            $.chitterchax.communication.connect();
            
        },
        
        update: function() {
            $.chitterchax.communication.update();
        },
        
        notify: function( eventName, eventData ) {
            //console.dir(eventData);
            $.event.trigger( eventName, [eventData] );
        },
        
        resetTimer: function() {
            if( $.chitterchax.data.timerRateId ) {
                window.clearTimeout( $.chitterchax.data.timerRateId );
                $.chitterchax.data.timerRateId = undefined;
            }  
            $.chitterchax.data.timerRateId = window.setTimeout(function() {  
                $.chitterchax("update");
            }, $.chitterchax('setting', 'updateTimer'));  
        },
        
        cancelTimer: function() {
            if( $.chitterchax.data.timerRateId ) {
                window.clearTimeout( $.chitterchax.data.timerRateId );
                $.chitterchax.data.timerRateId = undefined;
            }  
        }
    };
	
})( jQuery );