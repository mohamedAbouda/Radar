<?php

namespace App\Transformers;

use App\Models\LagnaReport;

use League\Fractal\TransformerAbstract;


class LagnaReportTransformer extends TransformerAbstract
{
	


	public function transform(LagnaReport $lagnaReport)
	{
		
		$data = [
			'id'=>$lagnaReport->id,
			'note'=>$lagnaReport->note,
			'fine'=>$lagnaReport->fine,
			'fine_cause'=>$lagnaReport->fine_cause,
		];
		
		return $data;
	}



}
