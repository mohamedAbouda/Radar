<?php

namespace App\Transformers;

use App\Models\Lagna;

use League\Fractal\TransformerAbstract;


class LagnaTransformer extends TransformerAbstract
{
	
	protected $defaultIncludes = ['location','reports'];


	public function transform(Lagna $lagna)
	{
		
		$data = [
			'id'=>$lagna->id,
		];
		
		return $data;
	}

	public function includeLocation(Lagna $lagna)
	{
		if($lagna->location){
			return $this->item($lagna->location,new LocationTransformer);
		}
	}

	public function includeReports(Lagna $lagna)
	{
		if($lagna->reports){
			return $this->collection($lagna->reports,new LagnaReportTransformer);
		}
	}

}
