<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// declare we're using Blog model here
use App\Blog;

// declare we're using DB namespace here
use DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // we will create index function
        // this function will show data from "blog" table
        //$blogs = Blog::all();

        // first, pgination using query builder
        // $blogs = DB::table('blog_post')->paginate(2);

        //pagination using Eloquent
        $blogs = Blog::paginate(2);

        //show data to our view
        return view('blog.index', ['blogs' => $blogs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // we will return to our new views
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // we will create validation function here
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        return redirect('blog')->with('message', 'data has been updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        // return to 404
        if(!$blog){
            abort(404);
        }
        // display the article to single page
        return view('blog.detail')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // edit function here
        $blog = Blog::find($id);
        // return to 404
        if(!$blog){
            abort(404);
        }
        // display the article to single page
        return view('blog.edit')->with('blog', $blog);
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
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        return redirect('blog')->with('message', 'data has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('blog')->with('message', 'data has been deleted!');
    }
}
