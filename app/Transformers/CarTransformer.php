<?php

namespace App\Transformers;

use App\Models\Car;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class CarTransformer extends TransformerAbstract
{



	public function transform(Car $car)
	{
		$data = [
			'id'=>$car->id,
			'model' => $car->model ? $car->model->name : '',
			'model_id' => $car->model ? $car->model->id : '',
			'model_pic_url' => $car->model ? $car->model->pic_url : '',
			'plate_number'=>$car->plate_number,
			'maintenance_date' => Carbon::parse($car->maintenance_date)->format('d M. Y'),
			'mile_age'=>$car->mile_age,
			'registration_code'=>$car->registration_code,
			'owner_name' => $car->owner?$car->owner->full_name:'',
			'oil_change_date' => $car->oil_change_date,
			'tyre_replacement_date' => $car->tyre_replacement_date,
		];

		return $data;
	}



}
