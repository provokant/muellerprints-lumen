<?php
namespace App;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'api_token',
        'browser',
        'ip',   
        'activated',
        'activation_code',
        'newsletter',
        'salutation',
        'name',
        'street',
        'zip',
        'town',
        'country',
        'phone',
        'company',
        'delivery_name',
        'delivery_street',
        'delivery_zip',
        'delivery_town',
        'delivery_country',
        'password',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Get all corresponding Orders for the selected User.
     * 
     * @return App\Order
     */

    public function orders() {
        return $this->hasMany('App\Order');
    }
}