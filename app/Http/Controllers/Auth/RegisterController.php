<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'usuarios';
    private $configPage;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->configPage = 'users';
    }
    
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $configPage = $this->configPage;
        return view('auth.register', compact('configPage'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['phone'] = preg_replace('/[^0-9]/', '', $data['phone']);
        
        if ( isset($data['whatsapp']) ) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required',  'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'department' => ['required'],
                'message_whatsapp' => ['required'],
                'active' => ['required']
            ]);
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'department' => ['required'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'active' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ( isset($data['whatsapp']) ) {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'department' => $data['department'],
                'phone' => $data['phone'],
                'whatsapp' => 1,
                'password' => $data['password'],
                'active' => $data['active'],
                'message_whatsapp' => $data['message_whatsapp']
            ]);
            
        } else {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'department' => $data['department'],
                'phone' => $data['phone'],
                'whatsapp' => 0,
                'password' => $data['password'],
                'active' => $data['active'],
            ]);
        }
    }
}
