<?php

class rex_com_comment {
	
	private $user,
			$email,
			$name,
			$www,
			$create_datetime,
			$update_datetime,
			$status,
			$ckey,
			$ukey,
			$pageLink = '',
			$data = array()
			;
	
	function rex_com_comment($params)
	{
		if(!is_array($params))
		{
			$id = (int) $params;
			$cs = rex_sql::factory();
			$cs->setQuery('select * from rex_com_user where id='.$id.'');
			if($cs->getRows() == 0)
				return FALSE;
			$params = $cs->getArray();
		}

		if(!isset($params["id"]))
			return FALSE;
		
		foreach($params as $k => $p)
		{
			$this->data[$k] = $p;
		}
		return TRUE;
		
	}
	
	
	static function get($params)
	{
		if(($c = new rex_com_comment($params)));
			return $c;
		return FALSE;
	}
	
	public function setPageLink($pageLink = "")
	{
		$this->pageLink = $pageLink;
	}

	public function setDefaultUserImage($defaultUserImage = "")
	{
		$this->defaultUserImage = $defaultUserImage;
	}

	public function getDefaultUserImage()
	{
		if($this->defaultUserImage == "")
		
			return 'data:image/jpg;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAIAAAADnC86AAAEUElEQVRYhe1Xa1MbNxQ950rGNdgw8bQYSAJM/v8/apo0AcqjYJuQ9WN3dW8/aFdeOw5myIR+aDUeRisknfs894pZlomImZFUVZL4+aMoCk8yoppZkuBnAzvnPAAIDQAJw8toDEBeBuZ/4P8qsP1bwC+UQMvDf7tkhFmV0TSYxSSnouKZ+AnCzAjCxAxCTcfj4KOWXAOcBEi2EJEQAp2Y2Wg0Go/HeZ4XRaGqrVar5du9Xu9Vf++XrXYUxWSz/ziZTCBsyqgwABTCqpXIow/Z18+fP395eDDVxLJk1Nja7fbh0eD14VHcD+EjGocQ1mhc2dNqSwIkh8Ph+z8+FkUBcPEzmAEwknmef/zwqSzL4zdvSW7UeF06qQlIg6MYYcR0Pvvz01lRFCTJJp8bGo4XkYuLi8vrq/j5JGCDWS0kyXiXmamqKS//up5OpgRVdfUCQzK7mcHk7OxsXuRPBSbIRlolkZ1zs9ns6uqKQoM556yBFGM7GiD+NbNQ2s3NjW3K0fXMla7WgPF4nFZUtTY1m4U8bYiT4XC40drrgRsK6WQyqS9l7V3GdEnObthASJaFzubz5wA3JZhOZ0BUK4WBrexprJmZhRDyHwQGkOfzGG5AYpTkwPo7RohV8xiVPwRc+0+XXWbLk8q1SZ6FoM8GBiAiy2DfCqfLn9V4/FoPpFhZM0h67xvir2zlWplExDn3OLCsO5gsbAA6nU5DA1vZF5lr5aBzrt1uPwF4ncKJv3Z2dgCQy05ZOJem1gi3ykhPBW5GQnKPmQm4t9sVGhHQtATTzjiPZQoiDsCr/t7jxRhrgyvFZNS40+ns7e2hwU01My8RSFxXDSKyv7+/AfaRqE7kRfL4+LiObaQEJasKkY5Efnnz9qi11Xo+cNJPVbvd7snJiXMuvq+SWBWTGdKjazAYHB4dEnxmkUDD0xHj4OBgMBhEANXKsNUQhqAAdrqdt8evhU9qmb9bnZJtgUqhbrdXGx8rFCGkiPPeRyOnkrUJeF2j0ix28d1MImqTVF1sgxlKEaFWjWlT7u8D22prvdTG1nI8PDxog7ST0lVNhM3n89lshiq8NxSJqsuMKYu6QYzlJc/zEEJZliGE0Wj0983dGnY1GBYNSa/X6/f7nU7He+88vfdbW1srhhQwhMAsyyB1MVELIdzejbJsMptNY/Oc53n08QYNKLFaRCGc862W9953ttvb29u7u7vdbreJwizLxLt47+3t7fn5+TSbN5UAYGqse28Yvn3zrKRAmlQvAbLVavX7/dN3J06EhhCCT7Hz5f7r+98/xOxMjZ+pLV4rsVteYlcs/tXgr+T4EIITp6ZlWV5fX6vq6elpywsQrUyWZXl5eanxiVAFpsUcjUhLHUiy+pLqJGla8cqiFazrCcnRaHR7dxOv8kVROOeyLBvfDw2BBq2Sm2aaOnVVBRuB2vS4SYzw2BDCzGCmJgvVTUNJstTyy/h+/9ffQgj/AOHcJSaBTLipAAAAAElFTkSuQmCC';
		
		return $this->defaultUserImage;
	}

	public function getPageLink()
	{
		return $this->pageLink;
	}	
	
	public function getId()
	{
		return $this->data["id"];	
		
	}
	
	public function getComment()
	{
		return $this->data["comment"];	
		
	}
	
	public function getCommentKey()
	{
		return $this->data["ckey"];	
		
	}

	public function getWWW()
	{
		$www = htmlspecialchars(trim($this->data["www"]));
		
		if($www == "")
			return '';
		
		if(substr($www,0,7) != "http://" && substr($www,0,7) != "https://")
		{
			$www = 'http://'.$www;
		}
		return $www;
	}
	
	public function getCreateDatetime($format = 'Y-m-d H:i')
	{
		global $I18N;
		// readable
		// datetime

		// TODO
		// return $this->data["create_datetime"];
		// date();

		$time = strtotime($this->data["create_datetime"]);

		if($format == 'readable')
			return strftime($I18N->msg('com_comment_date'),$time);
		elseif($format == 'datetime')
			return date('c',$time); // 2012-04-19T16:10:43+00:00';
		else
			return date($format,$time);
		
	}
	
	public function getDepth()
	{
		// TODO: reply depths.
		return 1;	
	}
	
	
	// ---------------------------------------- User
	
	public function getUserImage()
	{
		// return '';
		// TODO:
		// gravatar and/or local and/or facebook and/or twitter
		// return '<img id="" class="avatar avatar-40 grav-hashed grav-hijack" width="40" height="40" src="" alt="">';
		
		return '<img src="'.$this->getDefaultUserImage().'" class="avatar avatar-40" width="40" height="40" alt="'.htmlspecialchars($this->getUserName()).'"  title="'.htmlspecialchars($this->getUserName()).'" />';
		
	}
	
	public function getUserName()
	{
		return $this->data["name"];
		
	}
	
	
	
	// ---------------------------------------- Views
	
	public function getCommentView()
	{
		global $I18N,$REX;
		
		$pageLink = $this->getPageLink();
		$pos = strpos($pageLink,'?');
		if($pos === FALSE)
			$pageLink .= '?';
		
		$www = $this->getWWW();
		$www_a = '';
		$www_e = '';
		if($www != "")
		{
			$www_a = '<a class="url" rel="external nofollow" href="'.$www.'">';
			$www_e = '</a>';
			
		}
		
		return '
<article class="comment" id="comment-'.$this->getId().'">
	<footer>
		<div class="comment-author vcard">
			'.$this->getUserImage().'
			<cite class="fn">'.$www_a.$this->getUserName().$www_e.'</cite> <span class="says">'.$I18N->msg('com_comment_writes').':</span>
		</div>
		
		<div class="comment-meta commentmetadata">
			<a href="'.$pageLink.'#comment-'.$this->getId().'">
			<time datetime="'.$this->getCreateDatetime('datetime').'" pubdate="'.$this->getCreateDatetime('datetime').'">'.$this->getCreateDatetime('readable').'</time>
			</a>
		</div>
	</footer>

	<div class="comment-content"><p>'.nl2br(htmlspecialchars($this->getComment())).'</p></div>

	<!--
	<div class="reply">
		<a href="'.$pageLink.'&rex_com_comment_replyto='.$this->getId().'#comment-form-'.$this->getCommentKey().'" class="comment-reply-link">'.$I18N->msg('com_comment_name').'</a>
	</div>
	-->
</article>
				';

	}
	
	
}







