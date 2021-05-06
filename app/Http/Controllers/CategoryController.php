<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $listcategories['listcategories'] = Category::Paginate(10)->onEachSide(2);
        return view('pages.category.index')->with($listcategories);
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $fileName = '';
        // meyimpan di server
        if($request->image->getClientOriginalName()){
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName = date('mYdhs').rand(1,999).'_'.$file;
            $request->image->storeAs('public/category-image', $fileName);
        }
        //menyimpan di db
        Category::create(array_merge($request->all(),[
            'slug' => Str::slug($request->name),
            'image' => $fileName
        ]));
        return redirect('category');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        $deletecategory = Category::findOrFail($id);
        $deletecategory->delete();
        return redirect('category');

//        DB::table('products')->where('id', $id)->delete();
//        return redirect('products')->with('status', 'Iklan berhasi dihapus.');
    }

    public function deleteSelectedItem(Request $request): JsonResponse
    {
        $ids = $request->ids;
        Category::whereIn('id', $ids)->delete();
        return response()->json(['success'=>"Category Yang anda pilih berhasil dihapus!"]);
    }

}
