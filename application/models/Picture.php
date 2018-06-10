<?php

namespace application\models;

use application\components\Model;
use application\models\User;


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
		return ($this->db->row("SELECT * FROM pics ORDER BY id_pic DESC"));
	}

	public function extractPicById($id)
	{
		return ($this->db->row("SELECT * FROM pics WHERE id_pic='$id'"));
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

	public function extractPicByLink($link)
	{
		$item = $this->db->row("SELECT * FROM pics WHERE link='$link'");
		return $item;
	}

	public function extractComments($id_pic)
	{
		$item = $this->db->row("SELECT * FROM comments WHERE id_pic='$id_pic'");
		$i = 0;
		$user = new User();
		foreach ($item as $ar) {
			$user_id = $ar['who_comment'];
			$item[$i]['who_comment'] = $user->extractUserLoginById($user_id);
			$i++;
		}
		return $item;
	}

	public function insertComment($id_pic, $who_comment, $comment_txt)
	{
		$this->db->query("INSERT INTO comments (id_pic, who_comment, comment_text) VALUES ('$id_pic', '$who_comment', '$comment_txt')");
	}

	public function dellPic($id_pic)
	{
		$this->db->query("DELETE FROM pics WHERE id_pic='$id_pic'");
		$this->db->query("DELETE FROM comments WHERE id_pic='$id_pic'");
	}

}