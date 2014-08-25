<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Team extends Public_Controller
{
	protected $section = 'team';

	public function __construct()
	{
		parent::__construct();
		$this->load->driver('Streams');
		$this->lang->load('team');
		$this->data = new stdClass();
		$this->load->model('team_m');
		$this->template
				->append_css('module::team.css');
	}

	/**
	 * List all items
	 */
	public function index($offset=0)
	{
		$limit =6;

		$team = $this->team_m->limit($limit)
			->offset($offset)
			->order_by('position')
			->where('publish',1)
			->get_all();
		
		$team_exist = count($team) > 0;
		// we're using the pagination helper to do the pagination for us. Params are: (module/method, total count, limit, uri segment)
		$pagination = create_pagination('team', $this->team_m->count_all(), $limit, 2);
		
		// Build the view with sample/views/admin/items.php
		$this->template
			->title($this->module_details['name'])
			->set('team', $team)
			->set('team_exist',$team_exist)
			->set_breadcrumb('about','about-us')
			->set_breadcrumb('Team')
			->set('pagination', $pagination)
			->build('team/index');
	}

	function detail($slug)
    {
        $where = '';
        $where .= '`slug`=' . "'" . $slug . "'";
        $params = array(
            'stream' => 'team',
            'namespace' => 'team',
            'paginate' => 'no',
            'where' => $where,
            'limit' => '1'
        );

        $data['team'] = $this->streams->entries->get_entries($params);        
        
        
        if (empty($data['team']['entries'])) {
            show_404();
        }
        $data['team'] = $data['team']['entries']['0'];
        // Build the page
        $this->template->title($this->module_details['name'])
        		->set_breadcrumb($this->module_details['name'],'team')
				->set_breadcrumb($slug)
                ->build('detail', $data);
    }
}