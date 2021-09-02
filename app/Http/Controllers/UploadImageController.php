<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
class UploadImageController extends Controller
{
    //

    /**
     * 
     * image store 
     * 
     */
    public function save($id,Request $request){
        $user = Auth::user();
        $post = (new BlogPost)->getEditPost($user->id, $id);

        $this->validate($request,[
            'image' => 'required | image | mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
       
        
        $name=$request->file('image')->getClientOriginalName();
        $path=$request->file('image')->store('public/images');


        $save= new Photo;
        $save->name=$name;
        $save->path=$path;

        $save->save();

        return redirect('update')->with('status','Image has been uploaded');

    }
}
