<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->paginate(config('app.paginate_num'));

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categoriesParent = Category::where('parent_id', '=', config('app.categoryParent'))->get();

        return view('admin.category.create', compact('categoriesParent'));
    }

    public function store(CategoryRequest $request)
    {
        $categories = new Category;
        $categories->name = $request->name;
        $categories->parent_id = $request->parent_id;
        $categories->save();

        return redirect()->route('categories.index')->with('success', trans('category.addSuccess'));
    }

    public function edit($category)
    {
        $category = Category::find($category);
        $categoriesParent = Category::where('parent_id', '=', config('app.categoryParent'))->get();

        return view('admin.category.update', compact('category', 'categoriesParent'));
    }

    public function update(CategoryRequest $request, $category)
    {
        $category = Category::find($category);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();
        
        return redirect()->route('categories.index')->with('success', trans('category.editSuccess'));
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            foreach ($category->songs as $song) {
                $song->lyrics()->delete();
                $song->comments()->delete();
                $song->albums()->delete();
            }

            $category->songs()->delete();

            $category->delete();
            DB::commit();

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }
}
