<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Attachment;
use App\Http\Requests\AlbumRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Albumcontroller extends Controller
{
    //display all albums
    public function index(){
        $albums=Album::all();
        return view('home',compact("albums"));
    }

    //view create album page
    public function create(){
        return view('albums.add-album');
    }

    //save album to database
    public function save(AlbumRequest $request){

       try {
       $album = Album::create([
            "name"=>$request->name,
        ]);

        if(isset($request->photos))
        {
            foreach($request->photos as $photo){
                $path=public_path("images\Albums\\".$album->id."\\");
                $filename=$photo->getClientOriginalName();
                $photo->move($path,$filename);
                Attachment::create(
                    [
                        'name'=>$filename,
                        'path'=>$path,
                        'album_id'=>$album->id,
                    ]
                    );
            }
        }

      toastr()->success("Album added successfully");

      return redirect()->route('index');
  }

  catch (\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
  }
    }

    public function edit($id){
        $album=Album::with("attachments")->findOrFail($id);
        return view("albums.edit-album",compact("album"));
    }

    public function update(AlbumRequest $request,$id){
        try{

            $album=Album::findOrFail($id);
            $album->name=$request->name;
            $album->save();
            if(isset($request->photos))
            {
                foreach($request->photos as $photo){
                    $path=public_path("images\Albums\\".$album->id."\\");
                    $filename=$photo->getClientOriginalName();
                    $photo->move($path,$filename);
                    Attachment::create(
                        [
                            'name'=>$filename,
                            'path'=>$path,
                            'album_id'=>$album->id,
                        ]
                        );
                }
            }
            toastr()->success("Album Updated successfully");
            return redirect()->route("index");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete_attach($id){
        $attach=Attachment::findOrFail($id);
        $file=$attach->path."/".$attach->name;
        File::delete($file);
        $attach->delete();
        toastr()->error("Photo Removed Successfully . . .");
        return  redirect()->back();
    }

    public function delete($id){
        $album=Album::findOrFail($id);
        if($album->Attachments->count()>0){

            File::deleteDirectory(public_path('images\Albums\\'.$album->id));

        }
        $album->delete();
        toastr()->error("Album Removed Successfully . . .");
        return  redirect()->back();


    }

    public function move_delete(Request $request,$id){
        $album=Album::findOrFail($id);
        if(Album::findOrFail($request->album_id)->Attachments->count=0){
            File::makeDirectory(public_path("images/Albums/".$request->album_id),777);
        }

        foreach($album->Attachments as $attach){
            $attach->album_id=$request->album_id;
            File::move($attach->path."\\".$attach->name,public_path("images\Albums\\".$request->album_id."\\".$attach->name) );
            $attach->path=public_path("images\Albums\\".$request->album_id);
            $attach->save();
        }
        File::deleteDirectory(public_path('images\Albums\\'.$album->id));
        $album->delete();
        toastr()->error("Album Removed Successfully . . .");
        return  redirect()->back();

    }
}
