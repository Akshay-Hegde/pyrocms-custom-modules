<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Team extends Module
{
    public $version = '1.0';

    public function info()
    {
        $info = array(
            'name' => array(
                'en' => 'Team'
            ),
            'description' => array(
                'en' => 'Add Team Member'
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
            'sections' => array(
                'teams' => array(
                    'name' => 'team:teams',
                    'uri' => 'admin/team',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'team:create',
                            'uri' => 'admin/team/create',
                            'class' => 'add'
                        )
                    )
                ),
                
            )
        );
        if (function_exists('group_has_role')) {
            if (group_has_role('team', 'admin_teams_fields')) {
                $info['sections']['fields'] = array(
                    'name' => 'global:custom_fields',
                    'uri' => 'admin/team/fields/index',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'streams:add_field',
                            'uri' => 'admin/team/fields/create',
                            'class' => 'add'
                        )
                    )
                );
            }
        }
        return $info;
    }

    /**
     * Install
     *
     * This function will set up our
     * FAQ/Category streams.
     */
    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->library('files/files');
        $folder = $this->file_folders_m->get_by('slug','teamimg');
       
        if ($folder == null) {
            $fld = Files::create_folder('0', 'teamimg');
        }
        $id = $fld ? $fld["data"]["id"] : $folder->id;
        
        $this->load->driver('Streams');
        $this->load->language('team/team');

        // Add profiles streams
        if ( ! $this->streams->streams->add_stream('lang:team:team', 'team', 'team', 'team_', null)) return "not installed";
        
        // Add some fields
        $fields = array(
            array(
                'name' => 'Name',
                'slug'=>'name',
                'namespace' => 'team',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'team',
                'title_column' => true,
                'required' => true,
                'unique' => true,
            ),
            array(
                'name' => 'Slug',
                'slug'=>'slug',
                'namespace' => 'team',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'team',
                'title_column' => true,
                'required' => true,
                'unique' => true,
            ),
            array(
                'name' => 'Image',
                'slug'=>'image',
                'namespace' => 'team',
                'type' => 'image',
                'folder' => 'teamimg',
                'extra' => array('folder'=>$id,'allowed_types'=>'jpg|png'),
                'assign' => 'team',
                'title_column' => true,
                'required' => true
            ),
            array(
                'name' => 'Designation',
                'slug'=>'designation',
                'namespace' => 'team',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'team',
                'title_column' => true,
            ),
            array(
                'name' => 'Location',
                'slug'=>'location',
                'namespace' => 'team',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'team',
                'title_column' => true,
            ),
            array(
                'name' => 'Description',
                'slug'=>'description',
                'namespace' => 'team',
                'type' => 'wysiwyg',
                'extra'     => array('editor_type' => 'simple', 'allow_tags' => 'y'),
                'assign' => 'team',
                'title_column' => true,
                'required' => true
            ),
            array(
                'name' => 'Position',
                'slug'=>'position',
                'namespace' => 'team',
                'type' => 'integer',
                'assign' => 'team',
                'title_column' => true,
                'required' => true
            ),
            array(
                'name' => 'Publish',
                'slug' => 'publish',
                'namespace' => 'team',
                'type' => 'choice',
                'assign' => 'team',
                'extra'=>array('choice_type'=>'dropdown','choice_data'=> "0 : No \n 1 : Yes",'default_value'=>'1'),
                'required' => true
            )
        );
        $this->streams->fields->add_fields($fields);

        $this->streams->streams->update_stream('team', 'team', array(
            'view_options' => array(
                'name',
                'image',
                'position'
            )
        ));

        return true;

    }
    /**
     * Uninstall
     *
     * Uninstall our module - this should tear down
     * all information associated with it.
     */
    public function uninstall()
    {
        $this->load->driver('Streams');

        // For this teardown we are using the simple remove_namespace
        // utility in the Streams API Utilties driver.
        $this->streams->utilities->remove_namespace('team');
        

        return true;
    }

    public function upgrade($old_version)
    {
        return true;
    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}