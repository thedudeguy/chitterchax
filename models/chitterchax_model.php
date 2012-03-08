<?php

class Chitterchax_model extends  CI_Model {
    
    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Adds a user into the online databse table
     * 
     * @param int $user_id the user id
     * @param String $username the username
     * @param int $user_role Users chat role id
     * @param int $channel the channel id the user is in
     * @param String the users ip address
     * @return void
     */
    public function add_user_online($user_id, $username, $user_role, $channel, $ip)
    {
        $this->db->set("user_id", $user_id);
        $this->db->set("username", $username);
        $this->db->set("user_role", $user_role);
        $this->db->set("channel", $channel);
        $this->db->set("ip", $this->format_ip_to_db($ip));
        $this->db->set("datetime", "NOW()", false);
        
        $this->db->insert("chitterchax_online");
    }
    
    /**
     * Updates a user in the online databse table
     * 
     * @param int $user_id the user id
     * @param String $username the username
     * @param int $user_role Users chat role id
     * @param int $channel the channel id the user is in
     * @param String the users ip address
     * @return void
     */
    public function update_user_online($user_id, $username, $user_role, $channel, $ip)
    {
        $this->db->set("user_id", $user_id);
        $this->db->set("username", $username);
        $this->db->set("user_role", $user_role);
        $this->db->set("channel", $channel);
        $this->db->set("ip", $this->format_ip_to_db($ip));
        $this->db->set("datetime", "NOW()", false);
        $this->db->where("user_id", $user_id);
        $this->db->update("chitterchax_online");
    }
    
    /**
     * Check if a user is in the online table
     * 
     * @param String $user_id the users id to check
     * @return Boolean true/false whether or not the user exists in the table
     */
    public function is_user_online($user_id)
    {
        $this->db->select("user_id");
        $this->db->where("user_id", $user_id);
        $this->db->limit(1);
        $q = $this->db->get("chitterchax_online");
        
        if ($q->num_rows() == 1) return true;
        
        return false;
    }
    
    /**
     * Get the current channel of the supplied user id
     * 
     * @param int $user_id User id of the user to lookup
     * @return int|bool Returns the channel id, if no user was found returns FALSE
     */
    public function get_current_channel($user_id)
    {
        $this->db->select("channel");
        $this->db->where("user_id", $user_id);
        $this->db->limit(1);
        $q = $this->db->get("chitterchax_online");
        
        if ($q->num_rows() < 1) return false;
        $row = $q->row();
        return $row->channel;
    }
    
    /**
     * Adds a message into the database
     */
    public function add_message($user_id, $username, $user_role, $ip, $channel_id, $message)
    {
        $this->db->set("user_id", $user_id);
        $this->db->set("username", $username);
        $this->db->set("user_role", $user_role);
        $this->db->set("ip", $this->format_ip_to_db($ip));
        $this->db->set("channel", $channel_id);
        $this->db->set("text", $message);
        $this->db->set("datetime", "NOW()", false);
        
        $this->db->insert("chitterchax_messages");
    }
    
    /**
     * Gets all of the user currently connected to the chat
     * 
     * @return Array each array item is an object containing all the user data
     */
    public function get_online_users()
    {
        $q = $this->db->get("chitterchax_online");
        
        if ($q->num_rows() < 1) return array();
        
        $r = $q->result();
        
        //format the ip address.
        foreach($r as $k=>$row)
        {
            if (isset($row->ip) && !empty($row->ip))
            {
                $row->ip = $this->format_ip_from_db($row->ip);
            }
            $r[$k] = $row;
        }
        
        return $r;
    }
    
    /**
     * Prepares the result of get_online_users to variable names that the Javascript side of chitterchaxes uses.
     * 
     * @param Array $data the return result of $this->get_online_users()
     * @param Boolean $include_ip Set to true to have the ip included, otherwise scrub it out.
     * @return Array The formatted result ready to be sent to js
     */
    public function prepare_online_users_js($data, $include_ip = false)
    {
        foreach($data as $key=>$user)
        {
            $new_user->userId = $user->user_id;
            $new_user->userName = $user->username;
            $new_user->userRole = $user->user_role;
            $new_user->channelId = $user->channel;
            if ($include_ip === true)
            {
                $new_user->ip = $user->ip;
            }
            $data[$key] = $new_user;
            unset($new_user);
        }
        
        return $data;
    }
    
    /**
     * Gets messages from the database
     * 
     * @param int $last_id Will only return messages who have an id higher than the last_id provided
     * @param int $limit if specified will limit the result to the number specified
     * @return array a result containing the messages
     */
    public function get_messages($last_id=0, $limit=null)
    {
        $this->db->where("id >", $last_id);
        $this->db->order_by("id", "DESC"); //desc so we get only the LAST results in the messages limit
        $this->db->limit($limit);
        $q = $this->db->get("chitterchax_messages");
        
        if ($q->num_rows() < 1) return array();
        
        $result = $q->result();
        //format the ip
        foreach($result as $key=>$row)
        {
            if (isset($row->ip) && !empty($row->ip))
            {
                $row->ip = $this->format_ip_from_db($row->ip);
            }
            $result[$key] = $row;
        }
        
        //reverse the array so its oldest to newest.
        $result = array_reverse($result);
        
        return $result;
    }
    
    /**
     * Prepares the result of get_messages to variable names that the Javascript side of chitterchaxes uses.
     * 
     * @param Array $data the return result of $this->get_messages()
     * @param Boolean $include_ip Set to true to have the ip included, otherwise scrub it out.
     * @return Array The formatted result ready to be sent to js
     */
    public function prepare_messages_js($data, $include_ip = false)
    {
        foreach($data as $key=>$row)
        {
            $new_row->userId = $row->user_id;
            $new_row->userName = $row->username;
            $new_row->userRole = $row->user_role;
            $new_row->channelId = $row->channel;
            $new_row->datetime = $row->datetime;
            $new_row->id = $row->id;
            $new_row->message = $row->text;
            if ($include_ip === true)
            {
                $new_row->ip = $row->ip;
            }
            $data[$key] = $new_row;
            unset($new_row);
        }
        
        return $data;
    }
    
    /**
     * Converts an IP Address to a format storable in the database
     * 
     * @param String $ip An ip address
     * @return String an ip address formatted for db storage
     * @example <code>$this->chitterchax_model->format_ip_db('192.168.0.1')</code>
     * @author Sebastian Tschan
     * @copyright (c) Sebastian Tschan
     * @license GNU Affero General Public License
     * @link https://blueimp.net/ajax/
     */
    public function format_ip_to_db($ip) {
        if(function_exists('inet_pton')) {
            // ipv4 & ipv6:
            return @inet_pton($ip);
        }
        // Only ipv4:
        return @pack('N',@ip2long($ip));
    }
    
    /**
     * Converts an IP Address to from the db format to a readable format
     * 
     * @param String $ip An ip address in the format saved in the database
     * @return an ip address human readable.
     * @author Sebastian Tschan
     * @copyright (c) Sebastian Tschan
     * @license GNU Affero General Public License
     * @link https://blueimp.net/ajax/
     */
    function format_ip_from_db($ip) {
        if(function_exists('inet_ntop')) {
            // ipv4 & ipv6:
            return @inet_ntop($ip);
        }
        // Only ipv4:
        $unpacked = @unpack('Nlong',$ip);
        if(isset($unpacked['long'])) {
            return @long2ip($unpacked['long']);
        }
        return null;
    }
}
