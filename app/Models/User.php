<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private $platforms = [];
    private $permissions = [];
    private $access_token = null;

    public function __construct($return = false)
    {
        parent::__construct();

        $access_token = Request::ajax() ? Request::header('Authorization') : Session::get('access_token');

        $headers = [
            'Accept' => "application/json",
            'Authorization' => "Bearer " . $access_token,
        ];
        $response = Http::withHeaders($headers)->get(env('PASSPORT_SERVER_CHECK_USER'));

        $result = $response->object();

        if(@$response->object()->message == "Unauthenticated." || !isset($response->object()->user)) {
            if (!$return) {
                header('Content-Type: application/json');
                echo json_encode([ 'error' => 1, 'message' => "No autorizado." ]);
                exit;
            } else {
                return null;
            }
        }


        $this->id = $result->user->id;
        $this->name = $result->user->name;
        $this->email = $result->user->email;
        $this->created_at = $result->user->created_at;

        foreach($result->permissions as $permission) {
            $this->permissions[] = $permission->permission_code;
        }

        foreach($result->platforms as $platform) {
            $this->platforms[] = $platform;
        }
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getPermissionsJSON()
    {
        return json_encode($this->permissions);
    }

    public function getPlatformsJSON()
    {
        return json_encode($this->platforms);
    }

    public function can($permission, $options = [])
    {
        if(!in_array($permission, $this->permissions)) {
            if(@$options['json'] == true) {
                header('Content-Type: application/json');
                echo json_encode([ 'error' => 1, 'message' => "No autorizado." ]); exit;
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
