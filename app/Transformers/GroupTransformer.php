<?php

namespace App\Transformers;

use App\Models\Group;

use League\Fractal\TransformerAbstract;


class GroupTransformer extends TransformerAbstract
{

	//protected $defaultIncludes = ['group'];


	public function transform(Group $group)
	{

		$data = [
			'id'=>$group->id,
			'name'=>$group->name,
			'image'=>$group->image,
			'admin' => $group->admin ? fractal()
			->item($group->admin)
			->transformWith(new UserTransformer)
			->serializeWith(new \Spatie\Fractal\ArraySerializer())
			->toArray() : ''
		];

		return $data;
	}



}
