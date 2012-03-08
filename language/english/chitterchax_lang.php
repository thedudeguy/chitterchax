<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Language Interpretations
 *
 * @package ChitterChax
 * @author Sebastian Tschan
 * @author Chris Churchwell
 * @copyright (c) Sebastian Tschan
 * @copyright 2012 Chris Churchwell
 * @license GNU Affero General Public License
 */

$lang['chitterchax_title']                          = 'Chitterchax';
$lang['chitterchax_username']                       = 'Username';
$lang['chitterchax_password']                       = 'Password';
$lang['chitterchax_login']                          = 'Login';
$lang['chitterchax_logout']                         = 'Logout';
$lang['chitterchax_channel']                        = 'Channel';
$lang['chitterchax_style']                          = 'Style';
$lang['chitterchax_language']                       = 'Language';
$lang['chitterchax_input_line_break']               = 'Press SHIFT+ENTER to input a line break';
$lang['chitterchax_message_submit']                 = 'Submit';
$lang['chitterchax_registered_users']               = 'Registered Users';
$lang['chitterchax_online_users']                   = 'Online users';

$lang['chitterchax_toggle_autoscroll']              = 'Autoscroll on/off';
$lang['chitterchax_toggle_audio']                   = 'Sound on/off';
$lang['chitterchax_toggle_help']                    = 'Show/hide help';
$lang['chitterchax_toggle_settings']                = 'Show/hide settings';
$lang['chitterchax_toggle_online_list']             = 'Show/hide online list';

$lang['chitterchax_bbcode_label_bold']              = 'b';
$lang['chitterchax_bbcode_label_italic']            = 'i';
$lang['chitterchax_bbcode_label_underline']         = 'u';
$lang['chitterchax_bbcode_label_quote']             = 'Quote';
$lang['chitterchax_bbcode_label_code']              = 'Code';
$lang['chitterchax_bbcode_label_url']               = 'URL';
$lang['chitterchax_bbcode_label_img']               = 'Image';
$lang['chitterchax_bbcode_label_color']             = 'Font Color';
$lang['chitterchax_bbcode_title_bold']              = 'Bold text: [b]text[/b]';
$lang['chitterchax_bbcode_title_italic']            = 'Italic text: [i]text[/i]';
$lang['chitterchax_bbcode_title_underline']         = 'Underline text: [u]text[/u]';
$lang['chitterchax_bbcode_title_quote']             = 'Quote text: [quote]text[/quote] or [quote=author]text[/quote]';
$lang['chitterchax_bbcode_title_code']              = 'Code display: [code]code[/code]';
$lang['chitterchax_bbcode_title_url']               = 'Insert URL: [url]http://example.org[/url] or [url=http://example.org]text[/url]';
$lang['chitterchax_bbcode_title_img']               = 'Insert image: [img]http://example.org/image.jpg[/img]';
$lang['chitterchax_bbcode_title_color']             = 'Font Color: [color=red]text[/color]';

$lang['chitterchax_help']                           = 'Help';
$lang['chitterchax_help_item_desc_join']            = 'Join a channel:';
$lang['chitterchax_help_item_code_join']            = '/join Channelname';
$lang['chitterchax_help_item_desc_join_create']     = 'Create a private room (Registered users only):';
$lang['chitterchax_help_item_code_join_create']     = '/join';
$lang['chitterchax_help_item_desc_invite']          = 'Invite someone (e.g. to a private room):';
$lang['chitterchax_help_item_code_invite']          = '/invite Username';
$lang['chitterchax_help_item_desc_uninvite']        = 'Revoke invitation:';
$lang['chitterchax_help_item_code_uninvite']        = '/uninvite Username';
$lang['chitterchax_help_item_desc_logout']          = 'Logout from Chat:';
$lang['chitterchax_help_item_code_logout']          = '/quit';
$lang['chitterchax_help_item_desc_private_message'] = 'Private message:';
$lang['chitterchax_help_item_code_private_message'] = '/msg Username Text';
$lang['chitterchax_help_item_desc_query_open']      = 'Open a private channel:';
$lang['chitterchax_help_item_code_query_open']      = '/query Username';
$lang['chitterchax_help_item_desc_query_close']     = 'Close a private channel:';
$lang['chitterchax_help_item_code_query_close']     = '/query';
$lang['chitterchax_help_item_desc_action']          = 'Describe action:';
$lang['chitterchax_help_item_code_action']          = '/action Text';
$lang['chitterchax_help_item_desc_describe']        = 'Describe action in private message:';
$lang['chitterchax_help_item_code_describe']        = '/describe Username Text';
$lang['chitterchax_help_item_desc_ignore']          = 'Ignore/accept messages from user:';
$lang['chitterchax_help_item_code_ignore']          = '/ignore Username';
$lang['chitterchax_help_item_desc_ignore_list']     = 'List ignored users:';
$lang['chitterchax_help_item_code_ignore_list']     = '/ignore';
$lang['chitterchax_help_item_desc_whereis']         = 'Display user channel:';
$lang['chitterchax_help_item_code_whereis']         = '/whereis Username';
$lang['chitterchax_help_item_desc_kick']            = 'Kick a user (Moderators only):';
$lang['chitterchax_help_item_code_kick']            = '/kick Username [Minutes banned]';
$lang['chitterchax_help_item_desc_unban']           = 'Unban a user (Moderators only):';
$lang['chitterchax_help_item_code_unban']           = '/unban Username';
$lang['chitterchax_help_item_desc_bans']            = 'List banned users (Moderators only):';
$lang['chitterchax_help_item_code_bans']            = '/bans';
$lang['chitterchax_help_item_desc_whois']           = 'Display user IP (Moderators only):';
$lang['chitterchax_help_item_code_whois']           = '/whois Username';
$lang['chitterchax_help_item_desc_who']             = 'List online users:';
$lang['chitterchax_help_item_code_who']             = '/who [Channelname]';
$lang['chitterchax_help_item_desc_list']            = 'List available channels:';
$lang['chitterchax_help_item_code_list']            = '/list';
$lang['chitterchax_help_item_desc_roll']            = 'Roll dice:';
$lang['chitterchax_help_item_code_roll']            = '/roll [number]d[sides]';
$lang['chitterchax_help_item_desc_nick']            = 'Change username:';
$lang['chitterchax_help_item_code_nick']            = '/nick Username';

$lang['chitterchax_settings']                       = 'Settings';
$lang['chitterchax_settings_bbcode']                = 'Enable BBCode:';
$lang['chitterchax_settings_bbcode_images']         = 'Enable image BBCode:';
$lang['chitterchax_settings_bbcode_colors']         = 'Enable font color BBCode:';
$lang['chitterchax_settings_hyperlinks']            = 'Enable hyperlinks:';
$lang['chitterchax_settings_line_breaks']           = 'Enable line breaks:';
$lang['chitterchax_settings_emoticons']             = 'Enable emoticons:';
$lang['chitterchax_settings_autofocus']             = 'Automatically set the focus on the input field:';
$lang['chitterchax_settings_max_messages']          = 'Maximum number of messages in the chatlist:';
$lang['chitterchax_settings_wordwrap']              = 'Enable wrapping of long words:';
$lang['chitterchax_settings_max_word_length']       = 'Maximum length of a word before it gets wrapped:';
$lang['chitterchax_settings_date_format']           = 'Format of date and time display:';
$lang['chitterchax_settings_persist_font_color']    = 'Persist font color:';
$lang['chitterchax_settings_audio_volume']          = 'Sound Volume:';
$lang['chitterchax_settings_sound_receive']         = 'Sound for incoming messages:';
$lang['chitterchax_settings_sound_send']            = 'Sound for outgoing messages:';
$lang['chitterchax_settings_sound_enter']           = 'Sound for login and channel enter messages:';
$lang['chitterchax_settings_sound_leave']           = 'Sound for logout and channel leave messages:';
$lang['chitterchax_settings_sound_chat_bot']        = 'Sound for chatbot messages:';
$lang['chitterchax_settings_sound_error']           = 'Sound for error messages:';
$lang['chitterchax_settings_blink']                 = 'Blink window title on new messages:';
$lang['chitterchax_settings_blink_interval']        = 'Blink interval in milliseconds:';
$lang['chitterchax_settings_blink_interval_number'] = 'Number of blink intervals:';

$lang['chitterchax_play_selectedsound']             = 'Play selected sound';
$lang['chitterchax_requires_javascript']            = 'JavaScript is required for this Chat.';

$lang['chitterchax_error_invalid_user']             = 'Invalid username.';
$lang['chitterchax_error_user_in_use']              = 'Username in use.';
$lang['chitterchax_error_banned']                   = 'User or IP is banned.';
$lang['chitterchax_error_max_users_logged_in']      = 'The chat has reached the maximum number of logged-in users.';
$lang['chitterchax_error_chat_Closed']              = 'The chat is closed at the moment.';

$lang['chitterchax_logs_title']                     = 'AJAX Chat - Logs';
$lang['chitterchax_logs_date']                      = 'Date';
$lang['chitterchax_logs_time']                      = 'Time';
$lang['chitterchax_logs_search']                    = 'Search';
$lang['chitterchax_logs_private_channels']          = 'Private Channels';
$lang['chitterchax_logs_private_messages']          = 'Private Messages';