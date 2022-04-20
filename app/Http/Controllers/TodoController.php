<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Faker\Provider\Lorem;
use Nette\Utils\Validators;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    function index(){
return view('todos.index');
    }

    function create(){
        
    }

    function store(Request $req){
        
        // $req->validate(['title' => 'required|max:255']);                                 //Default error message
        $rules = ['title' => 'required|max:255'];                                           //Custom error message  
        $messages = ['title.max' => 'Todo title should not exceeds 255 character !!!!!'] ;
        $validator = Validator::make($req->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Todo::create($req->all());
        return redirect()->back()->with('message', "You created something");

    }

    function edit(){
        
    }
}

