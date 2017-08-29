<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\HelpRequest;
use App\Transformers\LocationTransformer;

class HelpRequestTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['location'];

	public function transform(HelpRequest $help_request)
	{
		$data = [
			'id' => $help_request->id,
		];

		return $data;
	}

	public function includeLocation(HelpRequest $help_request)
	{
		if($help_request->location){
			return $this->item($help_request->location,new LocationTransformer);
		}
	}
}
