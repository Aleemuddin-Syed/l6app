<?php

namespace App\Gates;
use Illuminate\Auth\Access\Response;

class GatePost {
	public function allowed($user, $id)
	{
		// only return to edit related record
		//return $user->id===$id;

		// facility to admin only to edit all records
	}

	/*public function allowedAction($user, $id)
	{
		$roles = $user->roles->pluck('name')->toArray();
		return $user->id === $id || in_array('Admin', $roles) ? Response::allow() : Response::deny('You are not authorized user here');
	}*/


	public function editAction($user, $id)
	{
		$roles = $user->roles->pluck('name')->toArray();
		return $user->id === $id || in_array('Admin', $roles) ? Response::allow() : Response::deny('You are not authorized user to Edit post');
	}

	public function deleteAction($user, $id)
	{
		$roles = $user->roles->pluck('name')->toArray();
		return $user->id === $id || in_array('Admin', $roles) ? Response::allow() : Response::deny('You are not authorized user to Delete post');
	}
}