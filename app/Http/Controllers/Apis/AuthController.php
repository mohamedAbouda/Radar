<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Apis\SignUpUser;
use App\Http\Requests\Apis\SignInRequest;
use App\Http\Requests\Apis\socialRequest;
use App\Http\Requests\Apis\SocialSignInRequest;
use App\Http\Requests\Apis\DeviceIdRequest;
use Carbon\Carbon;
use App\Http\Requests;
use App\Transformers\UserTransformer;
use Auth;
use Mail;
use Hash;
use App\Models\DeviceId;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
  public function signUp(SignUpUser $request)
  {

  	$data = $request->all();

    $confirmation_code = str_random(30);
    $data['confirmation_code'] = $confirmation_code;

    $saveUser = User::create($data);
// dd($data,$saveUser);
    $authUser=User::where('email','=',$request->input('email'))->first();
    $token=JWTauth::fromUser($authUser,[
      'exp' => Carbon::now()->addMonth()->timestamp,
      ]);
    $email=$request->input('email');
    $mess=[
    'email'=>$email,
    'confirmation_code'=>$confirmation_code,
    ];

    Mail::send('email.verfiy', $mess, function ($message) use ($email,$confirmation_code)
    {
      $message->subject('Verfication E-mail Radar Application');
      $message->to($email, $name=null);
    });

    return response()->json([
      'message'=>'Thanks for signing up! Please check your email',
      ],200 );
  }

  public function confirm($confirmation_code)
  {
    if( ! $confirmation_code)
    {
      throw new InvalidConfirmationCodeException;
    }

    $user = User::whereConfirmationCode($confirmation_code)->first();

    if ( ! $user)
    {
      throw new InvalidConfirmationCodeException;
    }

    $user->confirmed = 1;
    $user->confirmation_code = null;
    $user->save();

    echo "You have successfully verified your account.";


  }

  public function SignIn(SignInRequest $request)
  {

    try{
      $token=JWTauth::attempt($request->only('email','password'),[
        'exp' => Carbon::now()->addweek()->timestamp,
        ]);

    }
    catch(JWTException $e){

      return response()->json([
        'error'=>'wrong name or password',
        ],500);

    }

    if(!$token){
      return response()->json([
        'error'=>'wrong name or password',
        ],401);
    }
    if($request->user()->confirmed == 1){

      return response()->json([
        'data'=>fractal()
        ->item($request->user())
        ->includeAddress()
        ->addMeta(['token'=>$token])
        ->transformWith(new UserTransformer)
        ->serializeWith(new \Spatie\Fractal\ArraySerializer())
        ->toArray(),
        ],200);

    }else{
      return response()->json([
        'error'=>'Please confirm your email.check your email please',
        ],401);
    }
  }

  public function socialSignUp(socialRequest $request)
  {
    $data = $request->all();
    $data['confirmed'] = 1;
    $email = $request->input('email');
    $createUser = User::create($data);

    $authUser=User::where('social_id','=',$request->input('social_id'))->first();
    $token=JWTauth::fromUser($authUser,[
      'exp' => Carbon::now()->addweek()->timestamp,
      ]);

    $mess=[
    'email'=>$email,

    ];

    Mail::send('email.welcome', $mess, function ($message) use ($email)
    {
      $message->subject('Welcome E-mail Radar Application');

      $message->to($email, $name=null);
    });

    return response()->json([
      'data'=>fractal()
      ->item($authUser)
      ->includeCheckUps()
      ->addMeta(['token'=>$token])
      ->transformWith(new UserTransformer)
      ->serializeWith(new \Spatie\Fractal\ArraySerializer())
      ->toArray(),
      ],200);

  }


  public function socialSignIn(SocialSignInRequest $request)
  {
    $id=$request->input('social_id');
    $social_type=$request->input('social_type');

    $user=User::where('social_id','=',$id)->where('social_type','=',$social_type)->first();
    if($user){
      $token=JWTauth::fromUser($user,[
        'exp' => Carbon::now()->addweek()->timestamp,
        ]);

      return response()->json([
        'data'=>fractal()
        ->item($user)
        ->includeCheckUps()
        ->addMeta(['token'=>$token])
        ->transformWith(new UserTransformer)
        ->serializeWith(new \Spatie\Fractal\ArraySerializer())
        ->toArray(),
        ],200);
    }
    else{
      return response()->json([
        'error'=>'This user is not registered user',
        ],404 );
    }
  }


  public function registrationId(DeviceIdRequest $request)
  {
    $authUser=$request->user();

    $token= new DeviceId;
    $token->device_id=$request->input('registration_id');
    $token->user_id=$authUser->id;
    $token->save();

    return response()->json([
      'success'=>'Registeration Id has been submited!',
      ]);
  }



  public function forgetPassword(Request $request)
  {
    $email=$request->input('email');
    $Password = str_random(8);
    $newPassword=Hash::make($Password);
    $checkifUserExist=User::where('email','=',$email)->first();
    if($checkifUserExist){
      $update=User::where('email','=',$email)->update([

        'password'=>$newPassword,
        ]);

      $mess=[
      'email'=>$email,
      'Password'=>$Password,
      ];

      Mail::send('email.send', $mess, function ($message) use ($email,$Password)
      {

        $message->to($email, $name=null);
        $message->subject('Reset Password Radar Application');
      });

      return response()->json([
        'success'=>'a new password has been sent to your email',
        ]);
    }
    else{
      return response()->json([
        'error'=>'This email is not registered',
        ]);
    }
  }


}
