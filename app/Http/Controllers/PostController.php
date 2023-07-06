<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\post;
use Illuminate\View\View;
use Illuminate\Support\Facades\storage;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]); //restrict access to certain pages exception of show and index pages.
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$blog= Post::all();
        //return view('posts.index')->with('posts', $posts);
        //return view('posts.index', ['post'=>$posts]);
        //return view('posts.index', compact('blog'));
        //-----------------------------
        $data=[];
        //$data['posts']=post::orderBy('id','desc')->take(4)->get(); this one limit the number of post displayed to just 4
        $data['posts']=post::orderBy('id','desc')->paginate(4);
        return view('posts.index')->with($data);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, ['title'=> 'required', 'body'=> 'required', 'cover_image'=>'image|nullable|max:1999']);
        
        //where file upload is handled

        if($request->hasFile('cover_image')){
            // obtaining file name withe the extension
            $filenameWitExt= $request->file('cover_image')->getClientOriginalName();
            // Here gets just the file name
            $filename = pathinfo($filenameWitExt, PATHINFO_FILENAME);
            // GET JUST EXTENSION
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore= $filename. '_'.time().'.'.$extension;
            //upload image
            $path= $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore); 
            
         } else {
                $fileNameToStore= 'noimage.jpg';

            }
        
        //$body = $request->input('body');
        $post= new post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id= auth()->user()->id;
        $post->cover_image =$fileNameToStore;
        $post->save();

        return redirect('/post')->with('success', 'Post created');


        
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts= post::find($id);
        return view('posts.show')->with('posts', $posts); 
        //return view('posts.show', compact('posts')); can also be used.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts= post::find($id);


        //the  next line prevent guest from editing the post using the url
        if(auth()->user()->id !==$posts->user_id){
            return redirect('/posts')->with('error', 'You are not Unauthorize to edit that post !');
        } 


        return view('posts.edit')->with('posts', $posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //copy everything from store method and edit
        $this->validate($request, ['title'=> 'required', 'body'=> 'required']);
        
        //where file upload is handled

        if($request->hasFile('cover_image')){
            // obtaining file name withe the extension
            $filenameWitExt= $request->file('cover_image')->getClientOriginalName();
            // Here gets just the file name
            $filename = pathinfo($filenameWitExt, PATHINFO_FILENAME);
            // GET JUST EXTENSION
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore= $filename. '_'.time().'.'.$extension;
            //upload image
            $path= $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore); 
            
         } 
        


        //$title = $request->input('title');
        //$body = $request->input('body');
        $post= post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }

        $post->save();

        return redirect('/post')->with('success', 'Post Updated successfully !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post= post::find($id);

        //the  next line prevent guest from deleting the post using the url
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', ' You are not Unauthorize to delete that post !');
        } 

        if($post->cover_image != 'noimage.jpg'){
            //dele the image
            Storage::delete('public/cover_images/' ,$post->cover_image);

        }

        $post->delete();
        return redirect('/post')->with('success', 'Post Deleted successfully !');

        
    }
}
