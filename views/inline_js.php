$(document).ready( function() {
	$.chitterchax({
	    'ajax_url':'/index.php/chitterchax/ajax'
	});
	
	$('#statusIconContainer').chitterchax('linkNetworkStatus');
	$('#chatList').chitterchax('linkChat');
	$('#onlineList').chitterchax('linkOnlineUsers');
	$('#inputField').chitterchax('linkInput');
	
	$.chitterchax('start');
	
	//cheating a little bit for noew. just going to straight up js the bb code functions instead of add it to the plugin
	
	/**
	 * bb code buttons click events and handlers
	 * 
	 * @author Sebastian Tschan
	 * @copyright (c) Sebastian Tschan
	 * @license GNU Affero General Public License
	 * @link https://blueimp.net/ajax/
	 */
	$('#bbCodeContainer input').click(function( e ) {
	    e.preventDefault();
	    var bbcode = $(this).data().bbcode;
	    
        switch(bbcode) {            
            case 'url':
                //TODO: i18nify the prompt label.
                var url = prompt("Please enter the address (URL) of the webpage:", 'http://');
                if(url)
                    insert_bbcode('[url=' + url + ']', '[/url]');
                else
                    $('#inputField').focus();
                break;
            case 'color':
                $('#colorCodesContainer').toggle();
                break;
            default:
                insert_bbcode('[' + bbcode + ']', '[/' + bbcode + ']');       
        }
	});
	
	/**
     * hands the click events on color section
     * 
     * @author Sebastian Tschan
     * @copyright (c) Sebastian Tschan
     * @license GNU Affero General Public License
     * @link https://blueimp.net/ajax/
     */
	$('#colorCodesContainer a').click(function( e ) {
	    e.preventDefault();
	    var color = $(this).data().color;
	    console.log(color);
	    
	    $('#colorCodesContainer').hide();
	    
	    //TODO: Reimplement the persistFontColor
	    /*
	    if(this.settings['persistFontColor']) {
            this.settings['fontColor'] = color;
            if(this.dom['inputField']) {
                this.dom['inputField'].style.color = color;
            }
            if(this.dom['colorCodesContainer']) {
                this.dom['colorCodesContainer'].style.display = 'none';
                if(this.dom['inputField']) {
                    this.dom['inputField'].focus();
                }
            }
        } else {
            this.insert('[color=' + color + ']', '[/color]');
        }
	    */
	   insert_bbcode('[color=' + color + ']', '[/color]');
	});
	
	/**
     * function that handles inserting bb code into the inputField
     * 
     * @author Sebastian Tschan
     * @copyright (c) Sebastian Tschan
     * @license GNU Affero General Public License
     * @link https://blueimp.net/ajax/
     */
	function insert_bbcode( startTag, endTag ) {
        
        //TODO: Implement the jquery-fields-selection plugin to handle highlighted text replacement
    
        $('#inputField').focus();
        
        // Internet Explorer:
        if(typeof document.selection != 'undefined') {
            // Insert the tags:
            var range = document.selection.createRange();
            var insText = range.text;
            range.text = startTag + insText + endTag;
            // Adjust the cursor position:
            range = document.selection.createRange();
            if (insText.length == 0) {
                range.move('character', -endTag.length);
            } else {
                range.moveStart('character', startTag.length + insText.length + endTag.length);         
            }
            range.select();
        }
        // Firefox, etc. (Gecko based browsers):
        else if(typeof $('#inputField')[0].selectionStart != 'undefined') {
            // Insert the tags:
            var start = $('#inputField')[0].selectionStart;
            var end = $('#inputField')[0].selectionEnd;
            var insText = $('#inputField')[0].value.substring(start, end);
            $('#inputField')[0].value =  $('#inputField')[0].value.substr(0, start)
                                            + startTag
                                            + insText
                                            + endTag
                                            + $('#inputField')[0].value.substr(end);
            // Adjust the cursor position:
            var pos;
            if (insText.length == 0) {
                pos = start + startTag.length;
            } else {
                pos = start + startTag.length + insText.length + endTag.length;
            }
            $('#inputField')[0].selectionStart = pos;
            $('#inputField')[0].selectionEnd = pos;
        }
        // Other browsers:
        else {
            var pos = $('#inputField')[0].value.length;
            $('#inputField')[0].value =  $('#inputField')[0].value.substr(0, pos)
                                            + startTag
                                            + endTag
                                            + $('#inputField')[0].value.substr(pos);
        }
    }
    
});