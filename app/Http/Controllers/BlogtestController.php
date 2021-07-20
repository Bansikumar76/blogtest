<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogposts = BlogPost::all();
        $user_id = User::find(Auth::id());

        return view('blogpost', compact('blogposts', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);    

        $input = $request->all();

        if ($image = $request->file('image')) 
        {
            $destinationpath = "image/";
            $pimage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationpath, $pimage);
            $input['image'] = "$pimage";
        }

        $input['user_id'] = Auth::id();
        $input['title'] = $request->title;
        $input['description'] = $request->description;
        $input['tags'] = $request->tags;
        $input['image'] = $input['image'];

        BlogPost::create($input);

        return redirect()->route('blogpost')->with('success', 'Post Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = BlogPost::find($id);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        if (isset($user_id) == $id) {
            $post = BlogPost::find($id);
            return view('edit', compact('post'));
        }
        else{
            return view('blogpost');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) 
        {
            $destinationpath = "image/";
            $pimage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationpath, $pimage);
            $input['image'] = "$pimage";
        }
        else{
            unset($input['image']);
        }

        $post = BlogPost::find($id);
        $post->update($input);

        return redirect()->route('blogpost')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::find($id);
        $post->delete();

        return response()->json([
            'success' => 'Post Deleted Successfully'
        ]);
    }
}
