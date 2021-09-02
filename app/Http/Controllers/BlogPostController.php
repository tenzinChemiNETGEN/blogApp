<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class BlogPostController extends Controller
{

    /**
     * list all the blogs in site
     * 
     */
    public function index(Request $request){
       // $post=DB::table('blog_posts')->paginate(4);
        $post=BlogPost::paginate(3);
        return view('blog',[
            'posts'=>$post,
        ]);
    }

    /**
     * get blog create view
     */

    public function create(){
        return view('blogCreate');
    }

    /**
     * store the blog created 
     * 
     */

    public function store(Request $request){

        $request['slug'] = Str::slug($request['slug']);

        $this->validate($request, [
            'title' => 'required|min:2',
            'slug' => 'required|unique:blog_posts,slug',
            'body'  => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);

        //get file name with extension
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        //get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just extension
        $fileExt = $request->file('image')->getClientOriginalExtension();

        //create file name to store
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

        $fileNameToStore = str_replace(' ', '_', $fileNameToStore);
        
        $image = $request->file('image');

        $request->image->move(public_path('/storage/images'), $fileNameToStore);
        // $image->save(storage_path('/public/images/'. $fileNameToStore));  

        $user=Auth::user();
        $newPost=BlogPost::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'body'=> $request->body,
            'name' => $fileNameToStore,
            'path' => $fileNameToStore,
            'user_id'=>$user->id,
        ]);



        return redirect('blog/'. $newPost->slug)->with([
            'success' => 'Post Created !'
        ]);
    }

    /**
     * 
     * show blogs based on slug 
     * 
     */
    public function show($slug){
        $blogPost = (new BlogPost)->getPost($slug);
        // dd($blogPost);
        return view('blogShow',[
            'post'=>$blogPost,
        ]);
    }


    /**
     *  edit blog based on specific slug 
     * 
     */
    public function edit($slug){
        $user = Auth::user();
        $post = (new BlogPost)->getEditPost($user->id, $slug);
        
        return view('blogEdit')->with([
            'post'=> $post,
            'id'=>$slug
        ]);
    }

    /**
     * edited blog being updated 
     * 
     */
    public function update(Request $request,$slug){
        
        $user = Auth::user();
        $post = (new BlogPost)->getEditPost($user->id, $slug);
        // dd($post->name);
        // dd('public/storage/images/'.$post->name);
        
        if($post->name!=null){
            File::delete('storage/images/'.$post->name); 
        }

        $this->validate($request, [
            'title' => 'required|min:2',
            'body'  => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);

        
        //get file name with extension
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        //get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //get just extension
        $fileExt = $request->file('image')->getClientOriginalExtension();

        //create file name to store
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

        $fileNameToStore = str_replace(' ', '_', $fileNameToStore);
        
        $image = $request->file('image');

        $request->image->move(public_path('/storage/images'), $fileNameToStore);
        
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'name' => $fileNameToStore,
            'path' => $fileNameToStore,
            'body'  => $request->body,
        ]);
        return redirect('blog/'.$post->slug);
    }

    /**
     * delete the specific post
     * 
     */
    
    public function destroy(BlogPost $blogPost,$slug){
        $user = Auth::user();
        $post = (new BlogPost)->getEditPost($user->id, $slug);
        $post->delete();
        return redirect('/blog');
    }


}
