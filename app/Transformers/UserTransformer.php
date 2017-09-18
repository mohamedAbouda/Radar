<?php

namespace App\Transformers;

use App\Models\User;

use League\Fractal\TransformerAbstract;


class UserTransformer extends TransformerAbstract
{



	public function transform(User $user)
	{
		// if ($user->account_type == 0) {
		// 	$account_type = 'Driver';
		// }elseif ($user->account_type == 1) {
		// 	$account_type = 'Car Owner';
		// }elseif ($user->account_type == 2) {
		// 	$account_type = 'Partner';
		// }else{
		// 	$account_type = 'Undefiend';
		// }

		$data = [
			'id'=>$user->id,
			'full_name'=>$user->full_name,
			'email'=>$user->email,
			'phone_number'=>$user->phone_number,
			'account_type'=>$user->account_type,
			'profile_pic'=>$user->profile_pic,
			'is_on_duty'=>$user->is_on_duty,
		];
		if (isset($user->groupAdmin) && $user->groupAdmin) {
			$data['admin'] = 1;
		}

		return $data;
	}



}
