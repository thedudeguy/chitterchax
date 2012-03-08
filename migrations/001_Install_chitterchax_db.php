<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_chitterchax_db extends Migration {

    public function up()
    {
        
        $this->dbforge->add_field('user_id BIGINT(20) NOT NULL');
        $this->dbforge->add_field('username VARCHAR(64) NOT NULL');
        $this->dbforge->add_field('user_role INT(1) NOT NULL');
        $this->dbforge->add_field('channel INT(11) NOT NULL');
        $this->dbforge->add_field('datetime DATETIME NOT NULL');
        $this->dbforge->add_field('ip VARBINARY(16) NOT NULL');
        $this->dbforge->create_table('chitterchax_online');
        
        $this->dbforge->add_field('id BIGINT(20) NOT NULL AUTO_INCREMENT');
        $this->dbforge->add_field('user_id BIGINT(20) NOT NULL');
        $this->dbforge->add_field('username VARCHAR(64) NOT NULL');
        $this->dbforge->add_field('user_role INT(1) NOT NULL');
        $this->dbforge->add_field('channel INT(11) NOT NULL');
        $this->dbforge->add_field('datetime DATETIME NOT NULL');
        $this->dbforge->add_field('ip VARBINARY(16) NOT NULL');
        $this->dbforge->add_field('text TEXT NOT NULL');
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('chitterchax_messages');
        
        /*
        $this->dbforge->add_field('user_id INT(11) NOT NULL');
        $this->dbforge->add_field('userName VARCHAR(64) NOT NULL');
        $this->dbforge->add_field('dateTime DATETIME NOT NULL');
        $this->dbforge->add_field('ip VARBINARY(16) NOT NULL');
        $this->dbforge->create_table('ajax_chat_bans');
        
        $this->dbforge->add_field('userID INT(11) NOT NULL');
        $this->dbforge->add_field('channel INT(11) NOT NULL');
        $this->dbforge->add_field('dateTime DATETIME NOT NULL');
        $this->dbforge->create_table('ajax_chat_invitations');
         */
    
    }
    
    //--------------------------------------------------------------------

    public function down()
    {
        $this->dbforge->drop_table('chitterchax_online');
        $this->dbforge->drop_table('chitterchax_messages');
        //$this->dbforge->drop_table('ajax_chat_bans');
        //$this->dbforge->drop_table('ajax_chat_invitations');
    }

    //--------------------------------------------------------------------

}
