<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Chitterchax</title>
	<meta name="description" content="">
	<meta name="author" content="Chris Churchwell">

	<meta name="viewport" content="width=device-width">
	
	<?php echo Assets::css(null, 'screen', true); ?>
	<?php 
	   echo Assets::external_js(array(
	       'head.min.js',
	       base_url() .'bonfire/modules/chitterchax/assets/js/libs/modernizr-2.5.3.min.js'
	   )); 
    ?>
    <?php echo smiley_js() ?>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <header>
    </header>

    <div id="content" role="main">
        
	   <div id="headlineContainer">
		  <h1><?=lang("chitterchax_title")?></h1>
	   </div>

        <div id="logoutChannelContainer">
            <input type="button" id="logoutButton" value="<?=lang("chitterchax_logout")?>" onclick="ajaxChat.logout();"/>
            
            <label for="channelSelection"><?=lang("chitterchax_channel")?>:</label>
            <select id="channelSelection" onchange="ajaxChat.switchChannel(this.options[this.selectedIndex].value);">
                [CHANNEL_OPTIONS/]
            </select>
            
            <label for="styleSelection"><?=lang("chitterchax_style")?>:</label>
            <select id="styleSelection" onchange="ajaxChat.setActiveStyleSheet(ajaxChat.getSelectedStyle());">
                [STYLE_OPTIONS/]
            </select>
            
            <label for="languageSelection"><?=lang("chitterchax_language")?>:</label>
            <select id="languageSelection" onchange="ajaxChat.switchLanguage(this.value);">
                    [LANGUAGE_OPTIONS/]
            </select>
        </div>
    
        <div id="statusIconContainer" class="statusContainerOn" onclick="ajaxChat.updateChat(null);"></div>
        
        <!--[if lt IE 7]>
            <div></div>
        <![endif]-->
    
        <div id="chatList"></div>
        
        <div id="inputFieldContainer">
            <textarea id="inputField" rows="1" cols="50" title="<?=lang("chitterchax_input_line_break")?>" ></textarea>
        </div>
        
        <div id="submitButtonContainer">
			<span id="messageLengthCounter"></span>
			<input type="button" id="submitButton" value="<?=lang("chitterchax_message_submit")?>" />
		</div>
        
        <div id="emoticonsContainer" dir="ltr">
            <?php foreach($smileys as $smiley): ?>
            <?php echo $smiley ?>
            <?php endforeach; ?>
        </div>
        
        <div id="bbCodeContainer">
            <input data-bbcode="b" type="button" value="<?=lang("chitterchax_bbcode_label_bold")?>" title="<?=lang("chitterchax_bbcode_title_bold")?>" style="font-weight:bold;"/>
            <input data-bbcode="i" type="button" value="<?=lang("chitterchax_bbcode_label_italic")?>" title="<?=lang("chitterchax_bbcode_title_italic")?>" style="font-style:italic;"/>
            <input data-bbcode="u" type="button" value="<?=lang("chitterchax_bbcode_label_underline")?>" title="<?=lang("chitterchax_bbcode_title_underline")?>" style="text-decoration:underline;"/>
            <input data-bbcode="quote" type="button" value="<?=lang("chitterchax_bbcode_label_quote")?>" title="<?=lang("chitterchax_bbcode_title_quote")?>" />
            <input data-bbcode="code" type="button" value="<?=lang("chitterchax_bbcode_label_code")?>" title="<?=lang("chitterchax_bbcode_title_code")?>" />
            <input data-bbcode="url" type="button" value="<?=lang("chitterchax_bbcode_label_url")?>" title="<?=lang("chitterchax_bbcode_title_url")?>" />
            <input data-bbcode="img" type="button" value="<?=lang("chitterchax_bbcode_label_img")?>" title="<?=lang("chitterchax_bbcode_title_img")?>" />
            <input data-bbcode="color" type="button" value="<?=lang("chitterchax_bbcode_label_color")?>" title="<?=lang("chitterchax_bbcode_title_color")?>" />
        </div>
        
        <div id="colorCodesContainer" style="display:none;" dir="ltr">
            <a href="#" style="background-color:gray;" title="gray" data-color="gray" ></a>
            <a href="#" style="background-color:silver;" title="silver" data-color="silver" ></a>
            <a href="#" style="background-color:white;" title="white" data-color="white" ></a>
            <a href="#" style="background-color:yellow;" title="yellow" data-color="yellow" ></a>
            <a href="#" style="background-color:orange;" title="orange" data-color="orange" ></a>
            <a href="#" style="background-color:red;" title="red" data-color="red" ></a>
            <a href="#" style="background-color:fuchsia;" title="fuchsia" data-color="fuchsia" ></a>
            <a href="#" style="background-color:purple;" title="purple" data-color="purple" ></a>
            <a href="#" style="background-color:navy;" title="navy" data-color="navy" ></a>
            <a href="#" style="background-color:blue;" title="blue" data-color="blue" ></a>
            <a href="#" style="background-color:aqua;" title="aqua" data-color="aqua" ></a>
            <a href="#" style="background-color:teal;" title="teal" data-color="teal" ></a>
            <a href="#" style="background-color:green;" title="green" data-color="green" ></a>
            <a href="#" style="background-color:lime;" title="lime" data-color="lime" ></a>
            <a href="#" style="background-color:olive;" title="olive" data-color="olive" ></a>
            <a href="#" style="background-color:maroon;" title="maroon" data-color="maroon" ></a>
            <a href="#" style="background-color:black;" title="black" data-color="black" ></a>
        </div>
        
        <div id="optionsContainer">
            <input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button" id="helpButton" alt="<?=lang("chitterchax_toggle_help")?>" title="<?=lang("chitterchax_toggle_help")?>" onclick="toggleContainer('helpContainer', new Array('onlineListContainer','settingsContainer'));"/>
            <input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button" id="settingsButton" alt="<?=lang("chitterchax_toggle_settings")?>" title="<?=lang("chitterchax_toggle_settings")?>" onclick="toggleContainer('settingsContainer', new Array('onlineListContainer','helpContainer'));"/>
            <input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button" id="onlineListButton" alt="<?=lang("chitterchax_toggle_online_list")?>" title="<?=lang("chitterchax_toggle_online_list")?>" onclick="toggleContainer('onlineListContainer', new Array('settingsContainer','helpContainer'));"/>
            <input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button" id="audioButton" alt="<?=lang("chitterchax_toggle_audio")?>" title="<?=lang("chitterchax_toggle_audio")?>" onclick="ajaxChat.toggleSetting('audio', 'audioButton');"/>
            <input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button" id="autoScrollButton" alt="<?=lang("chitterchax_toggle_autoscroll")?>" title="<?=lang("chitterchax_toggle_autoscroll")?>" onclick="ajaxChat.toggleSetting('autoScroll', 'autoScrollButton');"/>
        </div>
        
        <div id="onlineListContainer">
            <h3><?=lang("chitterchax_online_users")?></h3>
            <div id="onlineList"></div>
        </div>
        
        <div id="helpContainer" style="display:none;">
            <h3><?=lang("chitterchax_help")?></h3>
            <div id="helpList">
                <table>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescJoin[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeJoin[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescJoinCreate[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeJoinCreate[/LANG]</td>
                    
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescInvite[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeInvite[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescUninvite[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeUninvite[/LANG]</td>
                    </tr>
                    
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescLogout[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeLogout[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescPrivateMessage[/LANG]</td>
                        <td class="code">[LANG]helpItemCodePrivateMessage[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                    
                        <td class="desc">[LANG]helpItemDescQueryOpen[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeQueryOpen[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescQueryClose[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeQueryClose[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescAction[/LANG]</td>               
                        <td class="code">[LANG]helpItemCodeAction[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescDescribe[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeDescribe[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescIgnore[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeIgnore[/LANG]</td>
                    
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescIgnoreList[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeIgnoreList[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescWhereis[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeWhereis[/LANG]</td>
                    </tr>
                    
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescKick[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeKick[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescUnban[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeUnban[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                    
                        <td class="desc">[LANG]helpItemDescBans[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeBans[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescWhois[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeWhois[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescWho[/LANG]</td>
                    
                        <td class="code">[LANG]helpItemCodeWho[/LANG]</td>
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescList[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeList[/LANG]</td>
                    </tr>
                    <tr class="rowEven">
                        <td class="desc">[LANG]helpItemDescRoll[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeRoll[/LANG]</td>
                    
                    </tr>
                    <tr class="rowOdd">
                        <td class="desc">[LANG]helpItemDescNick[/LANG]</td>
                        <td class="code">[LANG]helpItemCodeNick[/LANG]</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div id="settingsContainer" style="display:none;">
            <h3>[LANG]settings[/LANG]</h3>
            <div id="settingsList">
                <table>
                    <tr class="rowOdd">
                        <td><label for="bbCodeSetting">[LANG]settingsBBCode[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="bbCodeSetting" onclick="ajaxChat.setSetting('bbCode', this.checked);"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="bbCodeImagesSetting">[LANG]settingsBBCodeImages[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="bbCodeImagesSetting" onclick="ajaxChat.setSetting('bbCodeImages', this.checked);"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="bbCodeColorsSetting">[LANG]settingsBBCodeColors[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="bbCodeColorsSetting" onclick="ajaxChat.setSetting('bbCodeColors', this.checked);"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="hyperLinksSetting">[LANG]settingsHyperLinks[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="hyperLinksSetting" onclick="ajaxChat.setSetting('hyperLinks', this.checked);"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="lineBreaksSetting">[LANG]settingsLineBreaks[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="lineBreaksSetting" onclick="ajaxChat.setSetting('lineBreaks', this.checked);"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="emoticonsSetting">[LANG]settingsEmoticons[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="emoticonsSetting" onclick="ajaxChat.setSetting('emoticons', this.checked);"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="autoFocusSetting">[LANG]settingsAutoFocus[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="autoFocusSetting" onclick="ajaxChat.setSetting('autoFocus', this.checked);"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="maxMessagesSetting">[LANG]settingsMaxMessages[/LANG]</label></td>
                        <td class="setting"><input type="text" class="text" id="maxMessagesSetting" onchange="ajaxChat.setSetting('maxMessages', parseInt(this.value));"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="wordWrapSetting">[LANG]settingsWordWrap[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="wordWrapSetting" onclick="ajaxChat.setSetting('wordWrap', this.checked);"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="maxWordLengthSetting">[LANG]settingsMaxWordLength[/LANG]</label></td>
                        <td class="setting"><input type="text" class="text" id="maxWordLengthSetting" onchange="ajaxChat.setSetting('maxWordLength', parseInt(this.value));"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="dateFormatSetting">[LANG]settingsDateFormat[/LANG]</label></td>
                        <td class="setting"><input type="text" class="text" id="dateFormatSetting" onchange="ajaxChat.setSetting('dateFormat', this.value);"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="persistFontColorSetting">[LANG]settingsPersistFontColor[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="persistFontColorSetting" onclick="ajaxChat.setPersistFontColor(this.checked);"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="audioVolumeSetting">[LANG]settingsAudioVolume[/LANG]</label></td>
                        <td class="setting">
                            <select class="left" id="audioVolumeSetting" onchange="ajaxChat.setAudioVolume(this.options[this.selectedIndex].value);">
                                <option value="1.0">100 %</option>
                                <option value="0.9">90 %</option>
                                <option value="0.8">80 %</option>
                                <option value="0.7">70 %</option>
                                <option value="0.6">60 %</option>
                                <option value="0.5">50 %</option>
                                <option value="0.4">40 %</option>
                                <option value="0.3">30 %</option>
                                <option value="0.2">20 %</option>
                                <option value="0.1">10 %</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="soundReceiveSetting">[LANG]settingsSoundReceive[/LANG]</label></td>
                        <td class="setting">
                            <select id="soundReceiveSetting" onchange="ajaxChat.setSetting('soundReceive', this.options[this.selectedIndex].value);"><option value="">-</option></select><input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button playback" alt="[LANG]playSelectedSound[/LANG]" title="[LANG]playSelectedSound[/LANG]" onclick="ajaxChat.playSound(this.previousSibling.options[this.previousSibling.selectedIndex].value);"/>
                        </td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="soundSendSetting">[LANG]settingsSoundSend[/LANG]</label></td>
                        <td class="setting">
                            <select id="soundSendSetting" onchange="ajaxChat.setSetting('soundSend', this.options[this.selectedIndex].value);"><option value="">-</option></select><input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button playback" alt="[LANG]playSelectedSound[/LANG]" title="[LANG]playSelectedSound[/LANG]" onclick="ajaxChat.playSound(this.previousSibling.options[this.previousSibling.selectedIndex].value);"/>
                        </td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="soundEnterSetting">[LANG]settingsSoundEnter[/LANG]</label></td>
                        <td class="setting">
                            <select id="soundEnterSetting" onchange="ajaxChat.setSetting('soundEnter', this.options[this.selectedIndex].value);"><option value="">-</option></select><input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button playback" alt="[LANG]playSelectedSound[/LANG]" title="[LANG]playSelectedSound[/LANG]" onclick="ajaxChat.playSound(this.previousSibling.options[this.previousSibling.selectedIndex].value);"/>
                        </td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="soundLeaveSetting">[LANG]settingsSoundLeave[/LANG]</label></td>
                        <td class="setting">
                            <select id="soundLeaveSetting" onchange="ajaxChat.setSetting('soundLeave', this.options[this.selectedIndex].value);"><option value="">-</option></select><input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button playback" alt="[LANG]playSelectedSound[/LANG]" title="[LANG]playSelectedSound[/LANG]" onclick="ajaxChat.playSound(this.previousSibling.options[this.previousSibling.selectedIndex].value);"/>
                        </td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="soundChatBotSetting">[LANG]settingsSoundChatBot[/LANG]</label></td>
                        <td class="setting">
                            <select id="soundChatBotSetting" onchange="ajaxChat.setSetting('soundChatBot', this.options[this.selectedIndex].value);"><option value="">-</option></select><input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button playback" alt="[LANG]playSelectedSound[/LANG]" title="[LANG]playSelectedSound[/LANG]" onclick="ajaxChat.playSound(this.previousSibling.options[this.previousSibling.selectedIndex].value);"/>
                        </td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="soundErrorSetting">[LANG]settingsSoundError[/LANG]</label></td>
                        <td class="setting">
                            <select id="soundErrorSetting" onchange="ajaxChat.setSetting('soundError', this.options[this.selectedIndex].value);"><option value="">-</option></select><input type="image" src="/bonfire/modules/chitterchax/assets/img/pixel.gif" class="button playback" alt="[LANG]playSelectedSound[/LANG]" title="[LANG]playSelectedSound[/LANG]" onclick="ajaxChat.playSound(this.previousSibling.options[this.previousSibling.selectedIndex].value);"/>
                        </td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="blinkSetting">[LANG]settingsBlink[/LANG]</label></td>
                        <td class="setting"><input type="checkbox" id="blinkSetting" onclick="ajaxChat.setSetting('blink', this.checked);"/></td>
                    </tr>
                    <tr class="rowOdd">
                        <td><label for="blinkIntervalSetting">[LANG]settingsBlinkInterval[/LANG]</label></td>
                        <td class="setting"><input type="text" class="text" id="blinkIntervalSetting" onchange="ajaxChat.setSetting('blinkInterval', parseInt(this.value));"/></td>
                    </tr>
                    <tr class="rowEven">
                        <td><label for="blinkIntervalNumberSetting">[LANG]settingsBlinkIntervalNumber[/LANG]</label></td>
                        <td class="setting"><input type="text" class="text" id="blinkIntervalNumberSetting" onchange="ajaxChat.setSetting('blinkIntervalNumber', parseInt(this.value));"/></td>
                    </tr>
                </table>
            </div>
        </div>
        <!--
            Please retain the full copyright notice below including the link to blueimp.net.
            This not only gives respect to the amount of time given freely by the developer
            but also helps build interest, traffic and use of AJAX Chat.
            
            Thanks,
            Sebastian Tschan
        //-->
        <div id="copyright"><a href="https://blueimp.net/ajax/">AJAX Chat</a> &copy; <a href="https://blueimp.net">blueimp.net</a></div>
    
    </div>

    <footer></footer>
    
    <!-- Templates for Javascript - User row in Online Users section -->
    <div id="template-online-user" class="hidden online-user-row">
        <a href="" class="user" title="Toggle user menu">
            Username
        </a>
    </div>
    <!-- End Template -->
    
    <!-- Template for Javascript - Message row in the chat messages section -->
    <div id="template-chat-message" class="hidden chat-message-row">
        <a class="delete" title="Delete this chat message" href=""></a>
        <span class="datetime">(00:00:00)</span>
        <span class="user" dir="ltr">Username</span>:&nbsp;<span class="message-text">Chat Message</span>
    </div>
    <!-- End Template -->
    
    <div id="flashInterfaceContainer"></div>

    <script>
	   head.js(<?php echo Assets::external_js(null, true) ?>);
	   head.js(<?php echo Assets::module_js(true) ?>);
    </script>
    <?php echo Assets::inline_js(); ?>
</body>
</html>
