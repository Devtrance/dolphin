<?php
/**
 *  dolphin. Collection of usefull PHP skeletons.
 *  Copyright (C) 2009  Johannes 'Banana' Keßler
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


class simpleClass { # rename the class

	/**
	 * the fields to save
	 *
	 * @var array
	 */
	private $_saveFields = array();

	/**
	 * the id of the current loaded element
	 * @var int
	 */
	private $_currentElementId = false;


	/**
	 * load the required stuff
	 */
	function __construct() {
	}

	/**
	 * check the given fields (array) for required elements
	 * those have a req_ in the key
	 * this will be replaced in the return
	 *
	 * $_POST['input']['req_name'] = 'test'; <= this is a required field
	 * $_POST['input']['address'] = 'test'; <= this can be empty
	 * $_POST['input']['req_email'] = 'test'; <= this is also required
	 *
	 * return is either true or an array with missing values which can be used to
	 * produce an error text
	 *
	 * @param array $params The array with the fields eg. the $_POST['input'] from above
	 * @param boolean $update True if the name check should be avoided
	 * @return mixed
	 */
	public function checkFields($params,$update=false) {
		$ret = false;
		$missing = array();
		$this->_saveFields = array();
		if(!empty($params)) {
			foreach ($params as $k=>$v) {
				if(is_string($v)) {
					$v = trim($v);
				}
				// check if we have a req_key
				if(strstr($k,'req_')) {
					$newKey = str_replace('req_','',$k);
					if($newKey === "name" && $update === false) {
						
						// check if we have this name already
						$check = $this->_checkName($v);
						
						if($check === false) {
							$this->_saveFields[$newKey] = $v;
						}
						else {
							$missing[] = $newKey.' is missing '; // is missing
						}
					}
					else {
						if($v !== '') {
							$this->_saveFields[$newKey] = $v;
						}
						else {
							$missing[] = $newKey; // is missing
						}
					}
				}
				else {
					$this->_saveFields[$k] = $v;
				}
			}
		}

		if(!empty($missing)) {
			$ret = $missing;
		}
		else {
			$ret = true;
		}
		return $ret;
	}

	/**
	 * create a new element into a database
	 *
	 * this function uses the $this->_savefields array as the input data
	 *
	 * @return boolean $ret Either true or false
	 */
	public function newElement() {
		$ret = false;
		if(!empty($this->_saveFields)) {
			$query = mysql_query("INSERT INTO `elementTable`
										SET `name` = '".mysql_escape_string($this->_saveFields['name'])."',
											`desc` = '".mysql_escape_string($this->_saveFields['desc'])."',
											`status` = '".mysql_escape_string($this->_saveFields['status'])."'");
			if($query === true) {
				$ret = true;
			}
		}

		return $ret;
	}

	/**
	 * get the complete mandant list from the database
	 * the elements have a status which indecates the following:
	 * 0= inactive
	 * 1= active and ready to use
	 * 2= hidden
	 *
	 * @return array $ret The entries
	 */
	public function getElementList() {
		$ret = array();
		$manArr = array();

		$query = mysql_query("SELECT id,name,`desc`,status FROM `elementTable`
								WHERE `status` <> '2'");
		if(mysql_num_rows($query) > 0) {
			while ($result = mysql_fetch_assoc($query)) {
				$manArr[$result['id']] = $result;
			}

			$ret = $manArr;
		}
		return $ret;
	}

	/**
	 * update the current element
	 * with the data from savefields
	 *
	 * @return boolean $ret Either true or false
	 */
	public function update() {
		$ret = false;
		if(!empty($this->_saveFields)) {
			$query = mysql_query("UPDATE `elementTable`
								 SET `name` = '".mysql_escape_string($this->_saveFields['name'])."',
									`desc` = '".mysql_escape_string($this->_saveFields['desc'])."',
									`status` = '".mysql_escape_string($this->_saveFields['status'])."'
								WHERE `id` = '".mysql_escape_string($this->_currentElementId)."'");
			if($query !== false) {
				$ret = true;
			}
		}

		return $ret;
	}

	/**
	 * load an element with the given id
	 *  and save the element id in $this->_currentElemntId
	 * @param int $id The id of the mandant
	 */
	public function loadElement($id) {
		$ret = false;

		if(!empty($id)) {
			$query = mysql_query("SELECT `id`,`name`,`desc`,`group`,`status`
									FROM `".TABLE_PREFIX."mandant`
									WHERE `id` = '".mysql_escape_string($id)."'
										AND `status` <> '2'");
			if(mysql_numrows($query) > 0) {
				$this->_currentElementId = $id;
				$ret = mysql_fetch_assoc($query);
			}
		}

		return $ret;
	}

	/**
	 * delete the element
	 * which means we set it to hidden 'status=2'
	 * @param int $id The element ID
	 * @return boolean Either true or false
	 */
	public function deleteElement($id) {
		$ret = false;
		if(!empty($id)) {
			$query = mysql_query("UPDATE `elementTable` 
								 SET `status` = '2'
							   WHERE `id` = '".mysql_escape_string($id)."'");
			if($query !== false) {
				$ret = true;
			}
		}

		return $ret;
	}

	/**
	 * check if the given element name already exists
	 * @param string $name The name of the mandant
	 */
	private function _checkName($name) {
		$ret = false;
		if(!empty($name)) {
			$query = mysql_query("SELECT `id` FROM `elementTable`
									WHERE `name` = BINARY '".mysql_escape_string($name)."'");
			if(mysql_num_rows($query) > 0) {
				$ret = true;
			}
		}

		return $ret;
	}
}
?>
