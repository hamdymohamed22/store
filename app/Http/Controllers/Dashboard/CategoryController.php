<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware(['auth','admin'])->except(['index','show']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->hasAny(['status', 'title'])) {
            $data = $request->validate([
                'name' => 'nullable|string',
                'status' => 'nullable|string|exists:categories,status'
            ]);
            $categories = Category::Filter($data)->paginate(3);
            return view('admin.categories.index', compact('categories'));
        } else {
            $categories = Category::
            with(['parent','children'])
            // Rel()
            // ->withTrashed()
            // ->onlyTrashed()
            ->withCount('products as have_products')
            ->paginate(6);
            // ->dd();
            return view('admin.categories.index', compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Category::all();
        return view('admin.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate(Category::rules());
        if ($request->has('logo')) {
            $data['logo'] = Storage::putFile('categories', $data['logo']);
        }
        Category::create($data);

        return redirect()->back()->with('success', 'category created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate(Category::rules($id), [
            'name.unique' => 'this :attribute alredy exists'
        ]);

        $category = Category::findOrFail($id);

        if ($request->has('logo')) {
            Storage::delete($category->logo);
            $data['logo'] = Storage::putFile('products', $data['logo']);
        }
        // update 
        $category->update($data);
        return redirect()->back()->with('success', "data updated succssfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        Category::destroy($id);
        // $category->delete($id);
        return redirect()->back()->with('success', 'Category Deleted Successfuly');
    }



    public function trash(){
        $categories = Category::Rel()
            ->onlyTrashed()
            ->paginate(6);
            // dd($categories);
        return view('admin.categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('success' , 'category restored success');
    }
    public function forceDelete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        // dd($category);
        if ($category->logo != null) {
            Storage::delete($category->logo);
        }
        $category->forceDelete();
        return redirect()->back()->with('success' , 'category deleted successfuly');
    }
}
