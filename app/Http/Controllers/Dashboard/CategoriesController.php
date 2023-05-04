<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request= request();
        //select a.*,parent.name as parent_name
        //from categories as a
        //leftjoin categories as parent on parent.name=a.parent_id

        // $categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
        // ->select([
        //     'categories.*',
        //     'parents.name as parent_name'
        // ])
        // ->filter($request->all())->paginate(2);
       // dd($categories);
     $categories= Category::withCount('products')->paginate();
    //$categories= Category::status('active')->paginate();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $parents = Category::all();
        $categories = new Category();
        return view('dashboard.categories.create',compact('categories','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules());
        $request->merge([
            'slug'=> Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');

        $path=$this->uploadImage($request);
        if($path){
            $data['image']=$path;
        }

        $categories = Category::create($data);
        return redirect()->route('dashboard.categories.index')
                ->with('success','category is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        $parents =Category::where('id',',<>',$id)
        ->where(function($query) use($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id','<>',$id);
        })
        ->get();
        return view('dashboard.categories.edit',compact('categories','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $old_image = $category->image;

        $data = $request->except('image');

        $path=$this->uploadImage($request);
        if($path){
            $data['image']=$path;
        }


        $category->update($data);
        if($old_image && $data['image']){
            Storage::disk('public')->delete($old_image);

        };

        return redirect()->route('dashboard.categories.index')->with('success','category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Category::destroy($id);
       $category = Category::findOrFail($id);
       $category->delete();
    //    if($category->image){
    //     Storage::disk('public')->delete($category->image);
    //    }
        return redirect()->route('dashboard.categories.index')->with('success','category deleted');
    }

    public function trash(){
        $categories= Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore($id){
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category is restored');
    }

    public function forceDelete($id){
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->forceDelete();
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category is deleted forever');

    }

    protected function uploadImage(Request $request){
        if(! $request->hasFile('image')){
            return ;
        }
            $file = $request->file('image'); //upload image
            $path =$file->store('/categories',['disc'=>'public']);  //public=>disk name
            return $path;



    }
}
