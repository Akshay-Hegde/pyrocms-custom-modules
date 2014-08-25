<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Team_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'default_team_team';
	}
	
	

	//make sure the slug is valid
	public function _check_slug($slug)
	{
		$slug = strtolower($slug);
		$slug = preg_replace('/\s+/', '-', $slug);

		return $slug;
	}

	public function get_many_by($params = array())
	{
	
		if ( ! empty($params['name']))
		{
			if ($params['name'])
			{
				$this->db->like('default_team_team.name', $params['name']);
			}
			else
			{
				echo "no records";
			}
		}
		$this->db->order_by("default_team_team.position","asc");
		return $this->get_all();
	}

	
}