<?php

namespace App\Transformers;

use App\Models\Radar;

use League\Fractal\TransformerAbstract;


class RadarTransformer extends TransformerAbstract
{
	
	protected $defaultIncludes = ['location','reports'];


	public function transform(Radar $radar)
	{
		
		$data = [
			'id'=>$radar->id,
			'radius'=>$radar->radius,
		];
		
		return $data;
	}

	public function includeLocation(Radar $radar)
	{
		if($radar->location){
			return $this->item($radar->location,new LocationTransformer);
		}
	}

	public function includeReports(Radar $radar)
	{
		if($radar->reports){
			return $this->collection($radar->reports,new RadarReportTransformer);
		}
	}

}
