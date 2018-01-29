<?php

namespace App\Http\Controllers;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;
use Log;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $input = $request->all();

        $user = User::where('email', $input['email'])
            ->where('activated', true)
            ->first();
      
        if ((new BcryptHasher)->check($input['password'], $user->password)) {
            $token = str_random(60);
            $user->api_token = $token;
            $user->save();

            return $user->api_token;
        } else {
            return response('Passwort oder E-Mail-Adresse sind nicht korrekt.', 401);
        }
    }

    public function register(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $input = $request->all();

        if (User::where('email', '=', $input['email'])->first()) {
            return response('E-Mail-Adresse bereits vergeben.', 400);
        }

        $activation = str_random(60);

        $user = User::create([
            'email' => $input['email'],
            'password' => (new BcryptHasher)->make($input['password']),
            'activated' => false,
            'activation_code' => $activation
        ]);

        $mail = [
            'activation' => $activation, 
            'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
        ];

        Mail::send('mails.user.register', $mail, function ($m) use ($user)  {
            $m->to($user['email']);
            $m->subject('Ihre Registrierung auf notizbücher-shop.com');
        });

        return response('Konto wurde erfolgreich registriert.', 200);

    }

    public function activate(Request $request, $code) {
        $user = User::where('activated', '!=', true)
            ->where('activation_code', '=', $code)->first();

        if ($user) {
            $user->activated = true;
            $user->activation_code = null;
            $user->save();
            return response('Konto erfolgreich aktiviert.', 200);
        } else {
          return response('Konto wurde bereits aktiviert.', 500);
        }
    }

    public function info() {
        return Auth::user()->load('orders');
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'confirmation' => 'required',
        ]);

        return Auth::user()->load('orders');
    }

    public function updateEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'confirmation' => 'required',
            'password' => 'required',
        ]);

        return Auth::user()->load('orders');
    }

    public function updateInfo(Request $request) {
        
        return Auth::user()->load('orders');
    }

}