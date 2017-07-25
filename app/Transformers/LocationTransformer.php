<?php

namespace App\Transformers;

use App\Models\Location;

use League\Fractal\TransformerAbstract;


class LocationTransformer extends TransformerAbstract
{
	


	public function transform(Location $location)
	{
		
		$data = [
			'id'=>$location->id,
			'latitude'=>$location->latitude,
			'longitude'=>$location->longitude,
			'bearing'=>$location->bearing,
			'speed'=>$location->speed,
		];
		
		return $data;
	}



}
