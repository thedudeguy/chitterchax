<?php

class Chitterchax_lib
{
    private $ci;
    
    public $data = null;
    public $messages = null;
    public $actions = null;
    public $info = null;
    public $users = null;
    
    public $last_id = 0;
    
    private $smiley_address = "/bonfire/modules/chitterchax/assets/img/smileys/";
    
    public function __construct()
    {
        $this->ci =& get_instance();
        
        $this->ci->load->helper("smiley");
        $this->ci->load->helper("bbcode");
    }
    
    public function set_last_id($id)
    {
        $this->last_id = $id;
    }
    public function get_last_id()
    {
        return $this->last_id;
    }
    
    public function connect($channel_id)
    {
        $user_id = $this->ci->auth->user_id();
        $username = $this->ci->auth->username();
        $ip = $this->ci->input->ip_address();
        $user_role = 0;
        
        if ($this->ci->chitterchax_model->is_user_online($user_id))
        {
            $this->ci->chitterchax_model->update_user_online($user_id, $username, $user_role, $channel_id, $ip);
        } else {
            $this->ci->chitterchax_model->add_user_online($user_id, $username, $user_role, $channel_id, $ip);
        }
        
        $this->data->is_connected = true;
        $this->data->user_id = $user_id;
        $this->data->username = $username;
        $this->data->user_role = $user_role;
        $this->data->channel_id = $channel_id;
        $this->data->channel_name = "Public";
        
        $this->users = $this->ci->chitterchax_model->get_online_users();
        $this->messages = $this->ci->chitterchax_model->get_messages(0, 10);
        
        return;
    }
    
    public function update()
    {
        $this->users = $this->ci->chitterchax_model->get_online_users();
        $this->messages = $this->ci->chitterchax_model->get_messages($this->get_last_id(), 10);
    }
    
    public function submit_message($message)
    {
        $user_id = $this->ci->auth->user_id();
        $channel_id = $this->ci->chitterchax_model->get_current_channel($user_id);
        
        if ( $message !== false && $channel_id !== false)
        {
            $username = $this->ci->auth->username();
            $user_role = 0;
            $ip = $this->ci->input->ip_address();
            $this->ci->chitterchax_model->add_message($user_id, $username, $user_role, $ip, $channel_id, $message);
        }
        
        if (!$this->last_id) $this->last_id = 0;
        
        $this->users = $this->ci->chitterchax_model->get_online_users();
        $this->messages = $this->ci->chitterchax_model->get_messages($this->last_id);
        
    }
    
    /**
     * Replaces any bbcode tags or smileys with the styling or images.
     * @param array $messages messages array like that returned by $this->get_messages()
     * @return array New array with all message strings formated.
     */
    public function render_message_strings($messages)
    {
        foreach($messages as $k=>$v)
        {
            $new_message = $v->text;
            $new_message = parse_bbcode($new_message);
            $new_message = parse_smileys($new_message, $this->smiley_address);
            $messages[$k]->text = $new_message;
            
            unset($new_message);
        }
        return $messages;
    }
    
    public function build_response()
    {
        $response = (object) array();
        if (!is_null($this->actions)) $response->actions = $this->actions;
        if (!is_null($this->data)) $response->data = $this->data;
        if (!is_null($this->info)) $response->info = $this->info;
        if (!is_null($this->users)) $response->users = $this->users;
        if (!is_null($this->messages)) $response->messages = $this->render_message_strings($this->messages);
        
        return $response;
    }
}
