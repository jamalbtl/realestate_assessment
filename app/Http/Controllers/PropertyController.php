<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PropertyController extends BaseController
{
    public function __construct(){
        $this->middleware('permission:view property',['only'=>['index']]);
        $this->middleware('permission:create property',['only'=>['create','store']]);
        $this->middleware('permission:update property',['only'=>['update','edit']]);
        $this->middleware('permission:delete property',['only'=>['destroy']]);
    }


    public function index(){
        $properties=Property::get();
        return view('property.index',compact('properties'));
    }

    public function create(){
        return view('property.create');
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'title' => 'required|string|unique:properties,title',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  
        ]);

        $property=Property::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'location'=>$request->location,
            'price'=>$request->price,
        ]);
        $imagePaths = [];

        // Check if images are uploaded
        if ($request->hasFile('images')) {
            $files = $request->file('images'); // Get all uploaded files

            foreach ($files as $image) {
                // Create a unique file name and store each image
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/images/property'), $imageName);

                // Save the file path
                $imagePath = 'assets/images/property/' . $imageName;
                $imagePaths[] = $imagePath;

                // Store the image path in the database
                PropertyImage::create(['img_path' => $imagePath,'property_id'=>$property->id]);
            }
        }

        return redirect('/property')->with('success','Property Created Successfully');
    }

    public function edit(Property $property){
        $images=PropertyImage::where('property_id',$property->id)->get();
        return view('property.edit',compact('property','images'));
    }
    public function update(Request $request, Property $property){

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  
        ]);

        $property->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'location'=>$request->location,
            'price'=>$request->price,
        ]);
        $imagePaths = [];

        // Check if images are uploaded
        if ($request->hasFile('images')) {
            $files = $request->file('images'); // Get all uploaded files

            foreach ($files as $image) {
                // Create a unique file name and store each image
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/images/property'), $imageName);

                // Save the file path
                $imagePath = 'assets/images/property/' . $imageName;
                $imagePaths[] = $imagePath;

                // Store the image path in the database
                PropertyImage::create(['img_path' => $imagePath,'property_id'=>$property->id]);
            }
        }

        return redirect('/property')->with('success','Property Updated Successfully');
    }

    public function destroy($propertyId){
        $property=Property::findOrFail($propertyId);
        $property->delete();
        $image=PropertyImage::where('property_id',$propertyId)->delete();
        return redirect('property')->with('status','Property Deleted');
    }


    public function destroyPropertyImage($imageId){
        $image=PropertyImage::findOrFail($imageId);
        $image->delete();
        return response()->json('Image Deleted');
    }

    
    // API Methods

    public function getPropertyList(Request $request){
        $token = PersonalAccessToken::findToken($request->bearerToken());

        try{
            if($token){
                $properties=Property::with('images')->get();
                return response()->json([
                    'message'=>'Property Has Been Created',
                    'status'=>'success',
                    'data'=>array('properties'=>$properties)
                    
                ]);
            }else{
                return response()->json([
                    "error"=>'Token Missing'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }



    public function createProperty(Request $request){
        $token = PersonalAccessToken::findToken($request->bearerToken());

        try{
            if($token){
                $request->validate([
                    'title' => 'required|string|unique:properties,title',
                    'description' => 'required|string',
                    'location' => 'nullable|string',
                    'price' => 'required|numeric',
                    'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  
                ]);
        
                $property=Property::create([
                    'title'=>$request['title'],
                    'description'=>$request['description'],
                    'location'=>$request['location'],
                    'price'=>$request['price'],
                ]);
                $imagePaths = [];
        
                // Check if images are uploaded
                if ($request->hasFile('images')) {
                    $files = $request->file('images'); // Get all uploaded files
        
                    foreach ($files as $image) {
                        // Create a unique file name and store each image
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('assets/images/property'), $imageName);
        
                        // Save the file path
                        $imagePath = 'assets/images/property/' . $imageName;
                        $imagePaths[] = $imagePath;
        
                        // Store the image path in the database
                        PropertyImage::create(['img_path' => $imagePath,'property_id'=>$property->id]);
                    }
                }

                return response()->json([
                    'message'=>'Property Has Been Created',
                    'status'=>'success',
                ]);
            }else{
                return response()->json([
                    "error"=>'Token Missing'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    public function getPropertyDetail($propertyId){
        $token = PersonalAccessToken::findToken($request->bearerToken());

        try{
            if($token){
                $property=Property::findOrFail($propertyId);
                $images=PropertyImage::where('property_id',$propertyId)->get();
                return response()->json([
                    'message'=>'Property Has Been Created',
                    'status'=>'success',
                    'data'=>array('property'=>$properties,'images'=>$images)
                ]);
            }else{
                return response()->json([
                    "error"=>'Token Missing'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }


    public function updateProperty(Request $request, Property $property){
        $token = PersonalAccessToken::findToken($request->bearerToken());

        try{
            if($token){
                $request->validate([
                    'title' => 'required|string|unique:properties,title',
                    'description' => 'required|string',
                    'location' => 'nullable|string',
                    'price' => 'required|numeric',
                    'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  
                ]);
                
                $property->update([
                    'title'=>$request['title'],
                    'description'=>$request['description'],
                    'location'=>$request['location'],
                    'price'=>$request['price'],
                ]);
                $imagePaths = [];
        
                // Check if images are uploaded
                if ($request->hasFile('images')) {
                    $files = $request->file('images'); // Get all uploaded files
        
                    foreach ($files as $image) {
                        // Create a unique file name and store each image
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('assets/images/property'), $imageName);
        
                        // Save the file path
                        $imagePath = 'assets/images/property/' . $imageName;
                        $imagePaths[] = $imagePath;
        
                        // Store the image path in the database
                        PropertyImage::create(['img_path' => $imagePath,'property_id'=>$property->id]);
                    }
                }

                return response()->json([
                    'message'=>'Property Has Been Updated',
                    'status'=>'success',
                ]);
            }else{
                return response()->json([
                    "error"=>'Token Missing'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
    public function deleteProperty($propertyId){
        $token = PersonalAccessToken::findToken($request->bearerToken());

        try{
            if($token){
                $property=Property::findOrFail($propertyId);
                $property->delete();
                $image=PropertyImage::where('property_id',$propertyId)->delete();
                return redirect('property')->with('status','Property Deleted');

                return response()->json([
                    'message'=>'Property Has Been deleted',
                    'status'=>'success',
                ]);
            }else{
                return response()->json([
                    "error"=>'Token Missing'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

}
