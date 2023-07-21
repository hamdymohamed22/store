<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'store'])->paginate(6);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stores = Store::all();
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        return view('admin.products.edit', compact(
            'product',
            'categories',
            'stores',
            'tags'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data =  $request->validate([
            'name' => "string|max:255",
            'description' => "string",
            'price' => 'numeric',
            'compare_price' => 'numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'status' => 'in:active,archived,draft',
            'store_id' => 'exists:stores,id',
            'category_id' => 'exists:categories,id',
            'tags' => 'string'
        ]);

        if ($request->has('image')) {
            Storage::delete($product->image);
            $data['image'] = Storage::putFile('products', $data['image']);
        }
        $product->update($data);

        if ($request->has('tags')) {
            $tags = explode(',', $data['tags']);
            $tag_ids = [];
            $saved_tags = Tag::all();
            foreach ($tags as $tag_name) {
                $slug = Str::slug($tag_name);
                $tag = $saved_tags->where('slug', $slug)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $tag_name,
                        'slug' => $slug
                    ]);
                }
                $tag_ids[] = $tag->id;
            }
            $product->tags()->sync($tag_ids);
        }



        return redirect()->back()->with('success', 'data updated success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
