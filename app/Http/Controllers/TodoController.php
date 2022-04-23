<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Faker\Provider\Lorem;
use Nette\Utils\Validators;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TodoCreateRequest;

class TodoController extends Controller
{
    function index()
    {
        $mytodo = Todo::all();
        return view ('todos.index', ['mytodos' => $mytodo]);
    }

    function create()
    {
        return view('todos.create');
    }


    //serving validation from Form Request which we made though [php artisan make:request TodoCreateRequest]=============================
    function store(TodoCreateRequest $req)
    {
        // // $req->validate(['title' => 'required|max:255']);                                 //Default error message

        // // $rules = ['title' => 'required|max:255'];                                        //Custom error message  
        // $messages = ['title.max' => 'Todo title should not exceeds 255 character !!!!!'] ;
        // $validator = Validator::make($req->all(), $rules, $messages);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        Todo::create($req->all());
        return redirect()->back()->with('message', "You created something");
    }



    function edit(Todo $id)                         //type hinting model
    {
        return view('todos/edit', compact('id'));   //compact same as creating array and passing it to view
    }


    function update(Todo $id)                         
    {
        return view('todos/edit', compact('id'));   
    }
}
