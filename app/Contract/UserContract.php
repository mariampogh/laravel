<?php

namespace Laravel\Contract;

interface UserContract 
{	
	public function getById($id);
	public function getAll();
	public function create($data);
	public function editInfo($id, $data);
	public function delete($id);
	public function checkCv($id);
}