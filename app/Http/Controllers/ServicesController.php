<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Http\Requests\ServiceRequest;
class ServicesController extends Controller
{
    //serves as main index page of service (gives all service details as response)
    public function index(Request $request){
        if (!empty($request->search)){
            $search = $request->search;
            $services = Service::where('title','LIKE','%'.$search.'%')->orWhere('body','LIKE','%'.$search)->orderBy('created_at','desc')->paginate(7);
            return view('services.index')->with('services', $services);
        }

        $services = Service::orderBy('created_at', 'desc')->paginate(7);
        return view('services.index')->with('services', $services);
    }

    public function store(ServiceRequest $request){

        $service = new Service;
        $service->title = $request->input('title');
        $service->body = $request->input('body');
        $service->save();
        return back();
    }

    public function update(Request $request){
        $service = Service::find($request->input('id'));
        $service->title = $request->input('title');
        $service->body = $request->input('body');
        $service->save();
        return back();
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $post =Service::findorFail($id);
        $post->delete();
        return back();
    }

    /** Get the service by id
     * @int $id
     */
    public function getByID($id){
        $status = false;
        // Check if id is empty or not
        if(!empty($id)){
            $service = Service::select('id','title','body')->find($id);
            $status = !empty($service) ? true : false;
            return response()->json(['status' => true, 'result' => $service]);
        }
        return response()->json(['status' => $status]);
    }
}
