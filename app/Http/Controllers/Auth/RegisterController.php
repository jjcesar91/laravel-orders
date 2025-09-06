<?php

namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
  
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
    protected $redirectTo = RouteServiceProvider::HOME;
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    } 
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showRegistrationForm()
    {
        return view('register');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $usersFile = storage_path('demo-data/users.json');
        $users = json_decode(file_get_contents($usersFile), true);
        $exists = collect($users)->firstWhere('email', $data['email']);
        if ($exists) {
            session()->flash('error', 'Email già registrata');
            return redirect('register');
        }
        $data['id'] = collect($users)->max('id') + 1;
        $users[] = $data;
        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        return redirect('login');
    }
  
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Demo: validazione semplificata
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);
    }
  
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

