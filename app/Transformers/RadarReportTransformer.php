<?php

namespace App\Transformers;

use App\Models\RadarReport;

use League\Fractal\TransformerAbstract;


class RadarReportTransformer extends TransformerAbstract
{
	


	public function transform(RadarReport $radarReport)
	{
		
		$data = [
			'id'=>$radarReport->id,
			'note'=>$radarReport->note,
			'speed_limit'=>$radarReport->speed_limit,
		];
		
		return $data;
	}



}
