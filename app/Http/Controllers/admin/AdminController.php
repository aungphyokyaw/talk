<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        //
    }

    public function edit(Request $request)
    {
        $counsellor = User::find($request->id);
        $questions = $counsellor->questions()->get();
        return view('edit')->with('counsellor', $counsellor)->with('questions', $questions);
    }

    public function update(Request $request)
    {
        $counsellor = User::findOrFail($request->id);
        $counsellor->name = $request->name;
        $counsellor->email = $request->email;
        $counsellor->image = $request->image;
        $counsellor->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            $counsellor->image = $filename;
        } else {
            $counsellor->image = $request->old_image;
        }
        $counsellor->save();

        $questions = array_map(fn ($q) => ['name' => $q], $request->question);
        Question::where('user_id', '=', $request->id)->delete();
        $counsellor->questions()->createMany($questions);

        return redirect()->route('home')->with('success', 'updated successfully');
        //     $counsellor = User::find($request->id);

        //     if ($request->hasFile('image')) {
        //         $filename = $request->image->getClientOriginalName();
        //         $request->image->storeAs('images', $filename, 'public');

        //         $counsellor = User::find($request->id);
        //         $counsellor->name = $request->name;
        //         $counsellor->email = $request->email;
        //         $counsellor->image = $request->image;
        //         $counsellor->password = Hash::make($request->password);

        //         // $questions = new Question();
        //         // $questions = array_map(fn ($q) => ['name' => $q], $request->question);
        //         $questions = array_map(fn ($q) => ['name' => $q], $request->question);
        //         $counsellor->questions()->createMany($questions);
        //         //$questions = collect($request->input('question'))->mapInto(Question::class);
        //         $counsellor->questions()->saveMany($questions);
        //     } else {
        //         $counsellor->image = $request->old_image;
        //         $counsellor->name = $request->name;
        //         $counsellor->email = $request->email;
        //         $counsellor->password = Hash::make($request->password);

        //         // $questions = new Question();
        //         // $questions = array_map(fn ($q) => ['name' => $q], $request->question);
        //         $questions = collect($request->input('question'))->mapInto(Question::class);
        //         $counsellor->questions()->saveMany($questions);
        //     }
        //     $counsellor->save();

        //     return redirect()->route('home')->with('success', 'updated successfully');
    }
}
