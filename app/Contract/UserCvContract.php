<?php

namespace Laravel\Contract;

interface UserCvContract 
{
	public function getById($id);
	public function createCvReturnCountAnswears($id, array $input);
	public function editCvAndReturnDeletedItemsCount($id, $data, $count);
	public function delete($id);
}