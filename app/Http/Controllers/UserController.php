<?php

namespace App\Http\Controllers;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Order;
use Auth;
use Log;

class UserController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Register new User
     */
    public function register(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'salutation' => 'required',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'town' => 'required',
            'country' => 'required',
            'phone' => '',
            'company' => '',
            'delivery_salutation' => '',
            'delivery_name' => '',
            'delivery_street' => '',
            'delivery_zip' => '',
            'delivery_town' => '',
            'delivery_country' => ''
        ]);

        $input = $request->all();

        if (User::where('email', '=', $input['email'])->first()) {
            return response('E-Mail-Adresse bereits vergeben.', 400);
        }

        $activation = str_random(60);

        $input['activation_code'] = $activation;
        $input['activated'] = false;
        $input['password'] = (new BcryptHasher)->make($input['password']);

        $user = User::create($input);

        $mail = [
            'app_url' => env('APP_URL'),
            'endpoint' => '#!/activate/',
            'activation' => $activation, 
            'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
        ];

        Mail::send('mails.user.register', $mail, function ($m) use ($user)  {
            $m->to($user['email']);
            $m->subject('Ihre Registrierung auf notizbücher-shop.com');
        });

        return response('Konto wurde erfolgreich registriert.', 200);

    }

    /**
     * Activate registered new User
     */

    public function activate(Request $request, $code) {
        $user = User::where('activated', '!=', true)
            ->where('activation_code', '=', $code)->first();

        if ($user) {
            $user->activated = true;
            $user->activation_code = null;
            $user->save();
            // return redirect(env('APP_URL'));
            return response('Konto erfolgreich aktiviert.', 200);
        } else {
          return response('Konto wurde bereits aktiviert.', 500);
        }
    }

    /**
     * Login User
     */

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

    /**
     * Recieve full User Information including Orders 
     * @todo Update Token and send to Frontend
     */
    public function info() {
        return Auth::user()->load('orders');
    }

    /**
     * Validate User Authentication and update Token
     */
    public function auth() {
        return null;
    }

    /**
     * Get all User Orders
     */
    public function orders() {
        return response()->json(Auth::user()->load('orders')->orders);
    }

    /**
     * Update User Password
     */
    public function updatePassword(Request $request) {
        $this->validate($request, [
            'data' => [
                'password_old' => 'required',
                'password_new' => 'required',
                'password_new_confirmation' => 'required'
            ]
        ]);

        $user = Auth::user();
        $input = json_decode((string) $request->all()['data']);

        if (!(new BcryptHasher)->check($input->password_old, $user->password)) {
            return response('Das aktuelle Passwort ist nicht korrekt.', 500);
        }

        if ($input->password_new != $input->password_new_confirmation) {
            return response('Die neuen Passwörter stimmen nicht überein.', 401);
        }

        if ((new BcryptHasher)->check($input->password_new, $user->password)) {
            return response('Das neue Passwort unterscheidet sich nicht von dem alten Passwort.', 401);
        }

        try {
            $user->password = (new BcryptHasher)->make($input->password_new);
            $user->save();

            return response('Passwort wurde erfolgreich geändert.', 200);
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }

    public function sendResetToken(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        
        $input = $request->all();

        $user = User::where('email', $input['email'])
            ->where('activated', true)
            ->first();

        if (empty($user)) {
            return response('Bitte Überprüfen Sie die eingegebene E-Mail-Adresse.', 401);
        }

        $resetToken = str_random(60);

        try {
            $user->password_reset = $resetToken;
            $user->save();

            $mail = [
                'app_url' => env('APP_URL'),
                'endpoint' => '#!/reset-password/',
                'token' => $resetToken, 
                'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
            ];
    
            Mail::send('mails.user.reset', $mail, function ($m) use ($user)  {
                $m->to($user['email']);
                $m->subject('Passwort zurücksetzen auf notizbücher-shop.com');
            });

            return response('Bitte prüfen Sie Ihre E-Mails. Wir haben Ihnen einen Link zum Zurücksetzen des Passworts gesendet.', 200);
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }

    public function resetPassword(Request $request){
        $this->validate($request, [
            'token' => 'required',
            'password_new' => 'required',
            'password_new_confirmation' => 'required',
        ]);
        
        $input = $request->all();

        $user = User::where('password_reset', $input['token'])
            ->first();

        if (empty($user)) {
            return response('Der Link ist abgelaufen. Bitte setzen Sie Ihr Passwort erneut zurück.', 401);
        }

        if ($input['password_new'] != $input['password_new_confirmation']) {
            return response('Die neuen Passwörter stimmen nicht überein.', 401);
        }

        try {
            $user->password = (new BcryptHasher)->make($input['password_new']);
            $user->password_reset = '';
            $user->save();

            return response('Passwort wurde erfolgreich geändert.', 200);
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }

    /**
     * Update User Email
     */
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
            return response('Die neuen E-Mails stimmen nicht überein.', 401);
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

    /**
     * Update User Information
     */
    public function updateInfo(Request $request) {

        $this->validate($request, [
            'data' => [
                'salutation' => 'required',
                'name' => 'required',
                'street' => 'required',
                'zip' => 'required',
                'town' => 'required',
                'country' => 'required',
                'phone' => '',
                'company' => '',
                'delivery_salutation' => '',
                'delivery_name' => '',
                'delivery_street' => '',
                'delivery_zip' => '',
                'delivery_town' => '',
                'delivery_country' => ''
            ]
        ]);

        $user = Auth::user();
        $input = json_decode((string) $request->all()['data']);

        try {
            $user->salutation = $input->salutation;
            $user->name = $input->name;
            $user->street = $input->street;
            $user->zip = $input->zip;
            $user->town = $input->town;
            $user->country = $input->country;
            $user->phone = $input->phone;
            $user->company = $input->company;
            $user->delivery_salutation = $input->delivery_salutation;
            $user->delivery_name = $input->delivery_name;
            $user->delivery_street = $input->delivery_street;
            $user->delivery_zip = $input->delivery_zip;
            $user->delivery_town = $input->delivery_town;
            $user->delivery_country = $input->delivery_country;
            $user->save();

            return response('Adressdaten wurden erfolgreich geändert.', 200);
        } catch (Exception $e) {
            return response('Daten konnten nicht gespeichert werden. Bitte erneut versuchen.', 500);
        }
    }

    public function deleteOrder(Request $request, $id) {

        if (Auth::user()->orders->where('id', $id)->first()) {
            $order = Order::findOrFail($id)->first();
        } else {
            return response('Die ausgewählte Bestellung konnte nicht gefunden werden.', 404);
        }

        try {
            $order->forceDelete();
            return response('Bestellung wurde erfolgreich gelöscht.', 200);
        } catch (Exception $e) {
            return response('Die ausgewählte Bestellung konnte nicht gelöscht werden.', 500);
        }
    }
}
