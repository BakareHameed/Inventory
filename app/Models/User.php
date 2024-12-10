<?php

namespace App\Models;

use App\Models\Sales\Target;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable implements MustVerifyEmail
{ 
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'role',
        'password',
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function appointment() {
        $this->hasMany('\App\Models\Appoitment');
    }

    public function target()
    {
        return $this->belongsTo(Target::class,'id','user_id');
    }

    //Begin functions for calculations of monthly sales performance

        // Define the relationship between User and Sale
        public function sales()
        {
            return $this->hasMany(Sales::class);
        }
    
            // Method to get monthly sales for a specific year including user details
        public function monthlySalesWithUserDetails($year)
        {
            return $this->sales()
                        ->whereYear('date', $year)
                        ->where('sales','Yes')
                        ->selectRaw('users.*, MONTH(date) as month, SUM(sales_amount) as total')
                        ->groupBy('users.id', 'month')
                        ->orderBy('users.id')
                        ->orderBy('month')
                        ->get();
        }
    //End functions for calculations of monthly sales performance

}
