<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\Apis\UpdateProfile;
use App\Http\Requests\Apis\ChangePasswordRequest;
use Hash;

class UserController extends Controller
{
	public function viewProfile(Request $request)
	{
		$id = $request->input('user_id');

		if($id){
			$userId = $id;
		}else{
			$userId = $request->user()->id;
		}

		$user = User::where('id',$userId)->first();

		return response()->json([
			'data'=>fractal()
			->item($user)
			->transformWith(new UserTransformer)
			->serializeWith(new \Spatie\Fractal\ArraySerializer())
			->toArray(),
		],200);
	}

	public function editProfile(Request $request)
	{
		$data = $request->all();
		$authUser = $request->user();
		$user = User::findOrFail($authUser->id);

		if(!empty($request->hasFile('profile_pic'))){
			$data['profile_pic'] = $this->uploadImage($request->file('profile_pic'));
		}

		$user->update($data);

		return response()->json([
			'message'=>'You have updated your profile data.',
		],200 );
	}

	public function changePassword(ChangePasswordRequest $request)
	{
		$newPassword=$request->input('new_password');
		$oldPassword=$request->input('old_password');
		$authUser=$request->user();
		if($authUser->social_id){
			return response()->json([
				'error'=>'You are logged in with Social media account',
			]);
		}else{
			if( Hash::check( $oldPassword,$authUser->password)){
				$update=User::where('id','=',$authUser->id)->update([
					'password'=>bcrypt($newPassword),
				]);

				if($update){

					return response()->json([
						'success'=>'Your Password has been Updated',
					]);
				}
				else{
					return response()->json([
						'error'=>'an error occurred while you Updating your password',
					]);
				}
			}
			else{
				return response()->json([
					'error'=>'the old Password in incorrect',
				]);

			}

		}
	}

	public function search(Request $request)
	{
		$search = $request->get('name');
		$users = User::where('full_name' , 'LIKE' , '%'.$search.'%')
		->where('confirmed',1)->get();
		return response()->json([
			'data'=>fractal()
			->collection($users)
			->transformWith(new UserTransformer)
			->serializeWith(new \Spatie\Fractal\ArraySerializer())
			->toArray(),
		]
		,200);
	}
}
