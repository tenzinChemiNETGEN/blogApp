<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'body',
        'name',
        'path',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getall(){
        return $this->all();
    }

    public function delete(){
        // return $request->delete();
    }

    /**
     * 
     *  Get Post
     * 
     */
    public function getPost($slug){
        return $this->where('slug',$slug)->first();
    }
    




    /**
     * 
     *  Get Specific Post
     * 
     */
    public function getEditPost($user_id, $post_slug){
        $post = $this->where('user_id', $user_id)->where('slug', $post_slug)->first();
        return $post;
        // try{
        //     $post = $this->where('user_id', $user_id)->where('id', $post_id)->first();

        //     if($post != null){
        //         return [
        //             'success' => true,
        //             'message' => 'Post Found',
        //             'post' => $post
        //         ];
        //     }
        //     else{
        //         return [
        //             'success' => false,
        //             'message' => 'Post Not Found',
        //             'post' => $post
        //         ];
        //     }
            
        // }
        // catch(Exception $e){
        //     return [
        //         'success' => false,
        //         'message' => 'Something Went Wrong, Try Again !'
        //     ];
        // }
    }

    /***
     * 
     * 
     * method for slug
     */
    /**
     * Boot the model.
     */
     /**
     * 
     * slug
     */

   
   


  
}
