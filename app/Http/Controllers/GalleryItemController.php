<?php

namespace App\Http\Controllers;

use App\CategoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index($id)
    {

        $categoryitems = CategoryItem::where('category_id',$id)->orderBy('created_at', 'desc')->paginate(6);

        return view('gallery.view.images')->with([
                'categoryitems'=>$categoryitems,
                'id'=>$id
                ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'id'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        $category_id = $request->id;

        $image = new CategoryItem;

        //saving a file
        if($request->hasFile('cover_image'))
        {

            //get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get file name only

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extension of file
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //upload image
            $path = $request->cover_image->storeAs('public/cover_image/original', $fileNameToStore);

            $image->cover_image= $fileNameToStore;

            $image->category_id = $category_id;

            $image->save();
        }
        return back();
    }

    public function update(Request $request)
    {

        $this->validate($request,[
            'id'=>'required',
            'cover_image'=>'image|nullable|max:1999'
            ]);

        $id = $request->id;
        $image = CategoryItem::find($id);

        //saving a file
            if($request->hasFile('cover_image'))
            {

                //get filename with extension
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                //get file name only

                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get extension of file
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //file name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;

                //upload image
                $path = $request->cover_image->storeAs('public/cover_image/original', $fileNameToStore);

                Storage::delete('public/cover_image/original/'.$image->cover_image);
                $image->cover_image= $fileNameToStore;
                $image->update();
            }

        return back();
    }

    //delete category item images
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $categoryitem =CategoryItem::findorFail($id);
        Storage::delete('public/cover_image/original/'.$categoryitem->cover_image);
        $categoryitem->delete();
        return back();
    }
}
