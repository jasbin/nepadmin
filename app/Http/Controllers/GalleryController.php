<?php

namespace App\Http\Controllers;


use App\Category;
use App\CategoryItem;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request){

        if (!empty($request->search)){
            $search = $request->search;
            $categories = Category::where('title','LIKE','%'.$search.'%')->orWhere('description','LIKE','%'.$search.'%')->orderBy('created_at','desc')->paginate(7);
            return view('gallery.index')->with('categories', $categories);
        }

        $categories = Category::orderBy('created_at', 'desc')->paginate(7);
        
        return view('gallery.index')->with('categories', $categories);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'required'
        ]);

        $category = new Category;
        $category->title = $request->input('title');
        $category->description = $request->input('body');
        $category->save();

        //stores data in public/cover_image/original
        foreach ($request->cover_image as $photo){
            $fileNameWithExt = $photo->getClientOriginalName();
            //get file name only
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extension of file
            $extension = $photo->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //upload image
            $path = $photo->storeAs('public/cover_image/original', $fileNameToStore);

            CategoryItem::create([
                'category_id' => $category->id,
                'cover_image' => $fileNameToStore
            ]);
        }

        //below code stores images inside storage/app/cover_image/image which is not accessable publicly
        /*foreach ($request->cover_image as $photo) {
            $filename = $photo->store('cover_image/original');
            $newfilename=str_replace('/','',$filename);

            CategoryItem::create([
                'category_id' => $category->id,
                'cover_image' => $newfilename
            ]);
        }*/


        return back();
    }

    public function getByID($id)
    {
        $status=false;
        if(!empty($id)){
            $gallery = Category::select('id','title','description')->find($id);
            $status = !empty($gallery) ? true : false;
            return response()->json(['status'=>$status, 'result'=>$gallery]);
        }
        return $status;
    }

    public function update(Request $request)
    {
        $this->validate($request,[
           'title' => 'required',
           'body' => 'required'
        ]);

        $category = Category::find($request->input('id'));
        $category->title = $request->input('title');
        $category->description = $request->input('body');
        $category->save();
        return back();
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $category =Category::findorFail($id);
        $category_item = CategoryItem::where('category_id',$id)->get();
//        dd($category_item->cover_image);
        foreach ($category_item as $item){

            Storage::delete('public/cover_image/original/'.$item->cover_image);
            $item->delete();
        }

        $category->delete();

        return back();
    }
}
