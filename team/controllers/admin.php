<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SLIDER Module
 *
 *
 */
class Admin extends Admin_Controller
{
    // This will set the active section tab
    protected $section = 'teams';
    
    public function __construct()
    {
        parent::__construct();

        $this->load->model('team_m');
        $this->lang->load('team');
        $this->load->driver('Streams');
        //$this->template->append_js('admin/filter.js');
        $this->template->append_js('module::team_slug.js');
        
    }

    
    public function index()
    {
        $base_where=array();
        if ($this->input->post('f_name'))
        {
            $base_where['name'] = $this->input->post('f_name');
        }

       $records=$this->team_m->get_many_by($base_where);
       
        //do we need to unset the layout because the request is ajax?
        $this->input->is_ajax_request() and $this->template->set_layout(false);

        // Build the view with sample/views/admin/items.php
        $this->template
            ->title($this->module_details['name'])
            ->append_js('admin/filter.js')
            ->set('records',$records);

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/team_data') : $this->template->build('admin/team');
   

    }

    public function create()
    {
        $extra = array(
            'return' => 'admin/team',
            'success_message' => lang('team:submit_success'),
            'failure_message' => lang('team:submit_failure'),
            'title' => 'Create Team',
         );

        
        $this->streams->cp->entry_form('team', 'team', 'new', null, true, $extra, array('position'));
    }

    public function edit($id = 0)
    {
        $extra = array(
            'return' => 'admin/team',
            'success_message' => lang('team:submit_success'),
            'failure_message' => lang('team:submit_failure'),
            'title' => 'Edit Team'
        );

        $this->streams->cp->entry_form('team', 'team', 'edit', $id, true, $extra, array('position'));
    }

     public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'team', 'team');
        $this->session->set_flashdata('error', lang('team:deleted'));
 
        redirect('admin/team/');
    }

    public function setOrder()
    {
        $position=$this->input->post('position');
        $id=$this->input->post('id');

        foreach ($position as $key => $value) {

            if(!empty($key) && !empty($value)){
                $this->db->where('id',$key);
                $this->db->set('position',$value);
                $this->db->update('team_team');
            }
        }
        redirect('admin/team');
    }
}