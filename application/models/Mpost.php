<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpost extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->table = _PREFIX . 'post';
		$this->tablepict = _PREFIX . 'post_picture';
		$this->load->database();
	}

	public function getAll()
	{
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getPublished()
	{
		$this->db->where('status', '1');
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getById($id)
	{
		$this->db->where('id', $id);
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getPostJoin()
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getJoinBy($param, $value)
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->where(_PREFIX . $param, $value);
		$this->db->order_by('sort', 'asc');
		$this->db->order_by('date', 'desc');

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getJoinByWhere($where, $limit = 999, $from = 0)
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->where(_PREFIX . $where);

		$sql = $this->db->get($this->table, $limit, $from);

		return $sql;
	}

	public function getPostContent($limit = 999, $from = 0)
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->where_in(_PREFIX . 'post_category.id', [1, 2, 3, 4, 5, 16, 17]);
		$this->db->order_by(_PREFIX . 'post.date', 'desc');

		$sql = $this->db->get($this->table, $limit, $from);

		return $sql;
	}

	public function getJoinAllBy($value = [], $attr = '', $limit = 0, $offset = 0, $desc = 'DESC')
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->order_by(_PREFIX . 'post.id', $desc);

		// if ($value != '' && $attr != '') {
			if (@count($value) > 1 && $attr != '') {
				for ($i = 0; $i < count($value); $i++) {
					$this->db->where($attr[$i], $value[$i]);
				}
			} else {
				$this->db->where($attr, $value);
			}
		// }

		$sql = $this->db->get($this->table, $limit, $offset);

		return $sql;
	}

	/**
	 * Get data by defined category id || name
	 *
	 *
	 * @param string $category
	 * @return mixed
	 **/
	public function getByMenuCategory($category)
	{
		$this->db->select("*");
		// $this->db->select(_PREFIX.'post.title as post_title'._PREFIX.'post.title as title'._PREFIX.'post.slug as slug,'. _PREFIX . 'post.idcategory as idcategory');
		$this->db->where('idcategory', $category);
		$this->db->where('status', 1);
		$sql = $this->db->get($this->table);
		return $sql;
	}

	public function getJoinPublishedBy($value = '', $attr = '', $limit = 0, $offset = 0, $desc = 'DESC')
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->where('status', '1');



		if ($value == 3 or $value == 4) {
			$this->db->order_by(_PREFIX . "post.title", "ASC");
		} else {
			$this->db->order_by(_PREFIX . 'post.id', $desc);
		}
		$this->db->where($attr, $value);

		$sql = $this->db->get($this->table, $limit, $offset);

		return $sql;
	}

	public function getPicture($id)
	{
		$this->db->select("*");
		$this->db->join(_PREFIX . 'post_picture', _PREFIX . 'post_picture.idpost = ' . _PREFIX . 'post.id');
		$this->db->where(_PREFIX . 'post.id', $id);

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getApiBanner($where)
	{
		$this->db->select("id,image,attach as link, CASE WHEN date IS NULL THEN '' else date END as expired_date");
		$this->db->where(_PREFIX . $where);

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function getApiPost($where)
	{
		$this->db->select("id,title,slug,content,image,thumbnail");
		$this->db->where(_PREFIX . $where);

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function insert_postpicture($data)
	{
		return $this->db->insert($this->tablepict, $data);
	}

	public function delete_postpicture($id)
	{
		$sql = $this->db->delete($this->tablepict, array('idpost' => $id));

		return $sql;
	}

	public function delete($id)
	{
		$sql = $this->db->delete($this->table, array('id' => $id));

		return $sql;
	}

	public function deleteBy($param, $value)
	{
		$this->db->where(_PREFIX . $param, $value);
		$sql = $this->db->delete($this->table);

		return $sql;
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$sql = $this->db->update($this->table, $data);

		return $sql;
	}

	public function scopeCoe()
	{
		$this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->where('status', '1');
		$this->db->order_by(_PREFIX . "post.title", "ASC");
		// $this->db->where_in('idcategory', ['3', '4']);
		$this->db->where('idcategory', '16');

		$sql = $this->db->get($this->table);

		return $sql;
	}

	public function scope_s_f()
	{
		// $this->db->select("*");
		$this->db->select(_PREFIX . 'post_category.title as cat_title,' . _PREFIX . 'post.title as post_title,' . _PREFIX . 'post.id as post_id');
		$this->db->join(_PREFIX . 'account', _PREFIX . 'account.username = ' . _PREFIX . 'post.user');
		$this->db->join(_PREFIX . 'post_category', _PREFIX . 'post_category.id = ' . _PREFIX . 'post.idcategory');
		$this->db->where('status', '1');
		$this->db->order_by(_PREFIX . "post.title", "ASC");
		$this->db->where_in('idcategory', ['3', '4']);

		$sql = $this->db->get($this->table);
		return $sql;
	}
}
