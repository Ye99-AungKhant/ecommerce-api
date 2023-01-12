<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

#Comment

class PostController extends Controller
{
    public function create(Request $request)
    {
        $images=new Post();
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'image'=>'required|max:1024'
        ]);

        $filename="";
        if($request->hasFile('image')){
            $filename=$request->file('image')->store('uploads','public');
        }else{
            $filename=Null;
        }

        $images->name=$request->name;
        $images->price=$request->price;
        $images->description=$request->description;
        $images->image=$filename;
        $result=$images->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
        
    }

    public function get()
    {
        $images=Post::orderBy('id','DESC')->get();
        return response()->json($images);
    }
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post, 200);
     }

    public function edit($id)
    {
        $images=Post::findOrFail($id);
        return response()->json($images);
    }

    public function update(Request $request,$id)
    {
        $images=Post::findOrFail($id);
        
        $destination='public/uploads/'.$images->image;
        $filename="";
        if($request->hasFile('image')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('image')->store('uploads','public');
        }else{
            $filename=$request->image;
        }

        $images->name=$request->name;
        $images->price=$request->price;
        $images->description=$request->description;
        $images->image=$filename;
        $result=$images->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }


    public function delete($id)
    {
        $images=Post::findOrFail($id);
        $destination='public/uploads/'.$images->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $result=$images->delete();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
}
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $posts=Post::all();
//         return response()->json(['posts' => $posts], 200);
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//        $post = Post::create([
//             'name' => $request->name,
//             'price' => $request->price,
//             'description' => $request->description,
//             'image' => $request->image->hashName(),
//         ]);
//         return response()->json($post, 200);
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         $post = Post::find($id);
//         return response()->json($post, 200);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
        
//         $post = Post::findOrFail($id);
//         // $post->name = $request->input('name');
//         // $post->price = $request->input('price');
//         // $post->description = $request->input('description');

//         // if ($request->hasfile('image')) {
//         //     $destination = 'public/uploads/'.$post->image;
//         //     if (File::exists($destination)) {
//         //         File::delete($destination);
//         //     }

//         //     $file = $request->file('image');
//         //     $extention = $file->getClientOriginalExtension();
//         //     $filename = time().'.'.$extention;
//         //     $file->move('public/uploads/',$filename);
//         //     $post->image = $filename;
//         // }
//         // $post->save();
//         // return response()->json($post, 200);

//         if ($request->hasFile('image')){
//             $destination = 'public/uploads/'.$post->image;
//              if (File::exists($destination)) {
//                 File::delete($destination);
//             }

//             $uploaded_files = $request->image->store('public/uploads/');//move image public/uploads
//         $post->update([
//             'name' => $request->name,
//             'price' => $request->price,
//             'description' => $request->description,
//             'image' => $request->image->hashName(),
//         ]);

//         }
//         $post->save();
//         return response()->json($post, 200);
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         $post = Post::findOrFail($id);
//         $post->delete();
//         return response()->json($post, 200);
//     }
// }
