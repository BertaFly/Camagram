<?php

namespace application\models;

use application\components\Model;

class Picture extends Model
{
	public function insertLink($user_id, $link)
	{
		print("in insertLink\n");
		$this->db->query("INSERT INTO pics (user_id,link,likes) VALUES ($user_id,'$link', 0)");
		// $item = $this->db->row("SELECT id_pic FROM pics WHERE link='$link'");
		// print_r($item);
		// $id_pic = $item[0]['id_pic'];
		// $this->db->query("INSERT INTO likes (id_pic,user_id) VALUES ('$id_pic','$user_id')");
	}

	public function extractPics()
	{
		return ($this->db->row("SELECT * FROM pics"));
	}

	public function likeCheck($pic_id, $user_id)
	{
		$item = $this->db->row("SELECT user_id FROM likes WHERE id_pic='$pic_id'");
		foreach ($item as $val) {
			if ($val['user_id'] == $user_id)
				return false;
		}
		return true;
	}

	public function likeAdd($pic_id, $user_id)
	{
		$this->db->query("INSERT INTO likes (id_pic,user_id) VALUES ($pic_id,$user_id)");
		$item = $this->db->row("SELECT likes FROM pics WHERE id_pic='$pic_id'");
		$new_like_sum = $item[0]['likes'] + 1;
		$this->db->query("UPDATE pics SET likes = $new_like_sum WHERE id_pic='$pic_id'");
	}

	public function likeDel($pic_id, $user_id)
	{
		$item = $this->db->row("SELECT likes FROM pics WHERE id_pic='$pic_id'");
		$new_like_sum = $item[0]['likes'] - 1;
		$this->db->query("UPDATE pics SET likes = $new_like_sum WHERE id_pic='$pic_id'");
		$this->db->query("DELETE FROM likes WHERE user_id='$user_id' AND id_pic='$pic_id'");
	}

	public function likeCount($pic_id)
	{
		$item = $this->db->row("SELECT likes FROM pics WHERE id_pic='$pic_id'");
		return $item[0]['likes'];
	}

}