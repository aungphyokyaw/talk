<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Question;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $approved_code = 'PASS';
        if ($data['approval'] === $approved_code) {
            $counsellor = new User();
            $counsellor->name = $data['name'];
            $counsellor->role = 'counsellor';
            $counsellor->image = $data['image']->getClientOriginalName();
            $counsellor->email = $data['email'];
            $counsellor->password = Hash::make($data['password']);
            $counsellor->save();

            $questions = new Question();
            $questions = array_map(fn ($q) => ['name' => $q], $data['question']);
            $counsellor->questions()->createMany($questions);
            return $counsellor;
        } else {
            return User::create([
                'name' => $data['name'],
                'image' => $data['image']->getClientOriginalName(),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
