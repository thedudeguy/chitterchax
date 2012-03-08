<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chitterchax extends Front_Controller {
	
	public function __construct()
	{
		parent::__construct();
        
        //the profiler causes problems. disable it
        $this->output->enable_profiler(false);
        
        $this->load->model("users/user_model");
        $this->load->model("chitterchax_model");
        $this->load->library("users/auth");
        $this->load->library("chitterchax/chitterchax_lib");
	}
	
	public function index()
	{
	    $this->lang->load("chitterchax");
        $this->load->helper('language');
        $this->load->helper("smiley");
        
        $data->smiley_address = "/bonfire/modules/chitterchax/assets/img/smileys/";
        $data->smileys = get_clickable_smileys($data->smiley_address, "inputField");
        
        
        Assets::clear_cache();
        
		Assets::add_module_css("chitterchax", "style.css");
		Assets::add_module_css("chitterchax", "positions.css");
		Assets::add_module_css("chitterchax", "borders.css");
		Assets::add_module_css("chitterchax", "fonts.css");
		Assets::add_module_css("chitterchax", "misc.css");
		Assets::add_module_css("chitterchax", "print.css");
		Assets::add_module_css("chitterchax", "themes/core.css");
        
		Assets::add_module_js("chitterchax", "libs/jquery-1.7.1.min.js");
        Assets::add_module_js("chitterchax", "jquery.chitterchax.js");
		Assets::add_module_js("chitterchax", "script.js");
		Assets::add_js($this->load->view('inline_js', null, true), 'inline');
		
		$this->load->view("index", $data);
	}
    
    public function ajax()
    {
        if ( !$this->auth->is_logged_in() ) {
            $response->actions = array(
                'redirect' => site_url("login")
            );
            $this->output->set_output(json_encode($response));
            return;
        }
        
        $action = $this->input->post("action");
        
        if (isset($action) && method_exists($this, $action)) {
            $this->{$action}();
            return;
        }
        
        show_404();
    }
    
    private function connect()
    {
        $channel = 0;
        
        $this->chitterchax_lib->connect($channel);
        
        $response = $this->chitterchax_lib->build_response();
        
        $this->output->set_output(json_encode($response));
    }

    private function submit()
    {
        $last_id = $this->input->post("last_id", true);
        $message = $this->input->post("message", true);
        
        $this->chitterchax_lib->last_id = $last_id;
        $this->chitterchax_lib->submit_message($message);
        
        $response = $this->chitterchax_lib->build_response();
        $this->output->set_output(json_encode($response));
    }
    
    private function update()
    {
        $last_id = $this->input->post("last_id", true);
        $this->chitterchax_lib->set_last_id($last_id);
        $this->chitterchax_lib->update();
        
        $response = $this->chitterchax_lib->build_response();
        $this->output->set_output(json_encode($response));
    }
}