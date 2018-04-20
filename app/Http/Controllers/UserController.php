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

        if (empty($user)) {
            return response('Passwort oder E-Mail-Adresse sind nicht korrekt.', 401);
        }
      
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
        // @todo Update Token and send to Frontend

        return Auth::user()->load('orders');
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'old' => 'required',
            'new' => 'confirmed'
        ]);

        $input = $request->all();
        $user = Auth::user();

        if (!(new BcryptHasher)->check($input['old'], $user->password)) {
            return response('Das aktuelle Passwort war nicht korrekt.', 500);
        }

        try {
            $user->password = (new BcryptHasher)->make($input['new']);
            $user->save();

            return response('Passwort wurde erfolgreich geändert.', 200);
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }

    public function updateEmail(Request $request) {
        $this->validate($request, [
            'data' => [
                'email_old' => 'required',
                'email_new' => 'required',
                'email_new_confirmation' => 'required',
                'password' => 'required'
            ]
        ]);

        $user = Auth::user();
        $input = json_decode((string) $request->all()['data']);

        if ($input->email_old != $user->email) {
            return response('Die aktuelle E-Mail ist nicht korrekt.', 401);
        }

        if ($input->email_new != $input->email_new_confirmation) {
            return response('Die neuen E-Mails stimmen nicht übrerein.', 401);
        }

        if ($input->email_new == $user->email) {
            return response('Die neue E-Mail unterscheidet sich nicht von der alten.', 401);
        }

        if (!(new BcryptHasher)->check($input->password, $user->password)) {
            return response('Das aktuelle Passwort war nicht korrekt.', 401);
        }

        try {
            $user->email = $input->email_new;
            $user->save();

            return response('E-Mail wurde erfolgreich geändert.', 200);
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }

    public function updateInfo(Request $request) {

        $this->validate($request, [
            'salutation' => 'required',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'town' => 'required',
            'country' => 'required',
            'phone',
            'company',
            'delivery_name',
            'delivery_street',
            'delivery_zip',
            'delivery_town',
            'delivery_country'
        ]);

        try {
            Auth::user()->update($request->all());
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }
}