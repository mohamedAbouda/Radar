<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;
use App\Models\CarDriver;
use App\Models\Location;

class UserTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['location'];
	protected $location = null;

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
		// if (isset($user->groupAdmin) && $user->groupAdmin) {
		// 	$data['admin'] = 1;
		// }

		$driver = CarDriver::where('driver_id',$user->id)->orderBy('id','DESC')->first();
		if ($driver) {
			$location = Location::where('car_id',$driver->car_id)->orderBy('id','DESC')->first();
			if ($location) {
				$this->location = $location;
			}
		}

		if (!$this->location) {
			$data['location'] = new \stdClass();
		}

		return $data;
	}

	public function includeLocation(User $user)
	{
		$driver = CarDriver::where('driver_id',$user->id)->orderBy('id','DESC')->first();
		if ($driver) {
			$location = Location::where('car_id',$driver->car_id)->orderBy('id','DESC')->first();
			if ($location) {
				$this->location = $location;
			}
		}
		if ($this->location) {
			return $this->item($this->location,new LocationTransformer);
		}
	}
}
