<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\ElseIf_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'user') {
            $questions = Question::inRandomOrder()->limit(5)->get();
            return view('home')->with('questions', $questions);
        } elseif (Auth::user()->role == 'counsellor') {
            return view('home');
        } else {
            $counsellors = User::where('role', '=', 'counsellor')->get();
            return view('home')->with('counsellors', $counsellors);
        }
    }
    public function choose(Request $request)
    {

        // $b = array_count_values($check);
        // print_r($b);
        // foreach ($b as $key => $value) {
        //     echo $key;
        // }
        // if ($value > 1) {
        //     $final = $key;
        // }

        $check = $request->check;

        $unique = array_unique($check);

        $duplicate = array_diff_assoc($check, $unique);
        $choose_counsellors = [];
        foreach ($duplicate as $cc) {
            $choose_counsellors[] = User::find($cc);
        }
        return view('choose_counsellors')->with('choose_counsellors', $choose_counsellors);
        // print_r($check);
        // print_r(array_unique($check));
        // return array_diff_assoc($check, array_unique($check));
        // $count = array_count_values($request->all());
        // return $request->all();
    }

    public function detail(Request $request)
    {
        $data = User::find($request->id);
        return view('detail')->with('data', $data);
    }
}
