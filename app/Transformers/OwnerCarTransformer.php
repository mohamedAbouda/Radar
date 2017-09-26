<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Car;

class OwnerCarTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['driver'];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Car $car)
    {
        $data = [
			'id'=>$car->id,
			'model'=>$car->model,
			'plate_number'=>$car->plate_number,
			'maintenance_date'=>$car->maintenance_date,
			'mile_age'=>$car->mile_age,
			'registration_code'=>$car->registration_code,
			'owner_name' => $car->owner?$car->owner->full_name:'',
			'oil_change_date' => $car->oil_change_date,
			'tyre_replacement_date' => $car->tyre_replacement_date,
		];
        if(!$car->driver){
			$data['driver'] = "";
		}
		return $data;
    }

    public function includeDriver(Car $car)
	{
        if($car->driver){
            return $this->item($car->driver,new UserTransformer);
        }
	}
}
