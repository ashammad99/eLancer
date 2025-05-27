<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\FilterRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'min:2', 'filter'],
        'description' => 'nullable|string',
        'parent_id' => ['nullable', 'int', 'exists:categories,id'], //to check if the value exist in categories table, id col
        'art_file' => 'nullable|file'
    ];

    public function index()
    {
        $categories = Category::query()->leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->paginate();
//            ->dd();

        return View::make('categories.index')->with([
            'categories' => $categories,
            'title' => 'Categories',
            'flashMessage' => session('success')
        ]);
    }

    public function show($id)
    {
        $category = Category::query()->findOrFail($id);
        return View::make('categories.show')->with([
            'category' => $category,
            'title' => 'Category',
        ]);
    }

    public function create()
    {
        $parents = Category::all();
        $category = new Category();//this object will returned to _form to stop error
        return view('categories.create', compact('parents', 'category'));
    }

    public function store(Request $request)
    {

        $request->validate($this->rules());


//        $category = new Category();
//        $category->name = $request->input('name');
//        $category->description = $request->input('description');
//        $category->slug = Str::slug($request->input('name'));
//        $category->parent_id = $request->input('parent_id');
//        $category->save();
//        $category = Category::query()->create([
//            'name' =>  $request->input('name'),
//            'description' => $request->input('description'),
//            'slug' => Str::slug($request->input('name')),
//            'parent_id' => $request->input('parent_id')
//        ]);
        //        $category = Category::query()->create($request->only('name','parent_id','description','slug'));
//        $category = Category::query()->create($request->except('except_field'));
        //if the names of fields in front as the fields name in db:

        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->input('name'));
        }
        $category = Category::query()->create($data);

        session()->flash('success', 'Category Created !');
        return redirect(route('categories.index'));

    }

    public function edit(Category $category)
    {
        //with Route Resource you dont need to pass id, just pass $category and the model will return the model
//        $category = Category::query()->findOrFail($id);
        $parents = Category::all();
        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate($this->rules);
//        $category = Category::query()->findOrFail($id);
//        $category->name = $request->input('name');
//        $category->description = $request->input('description');
//        $category->slug = Str::slug($request->input('name'));
//        $category->parent_id = $request->input('parent_id');
//        $category->save();
        $category->update($request->all());

        session()->flash('success', 'Category Updated');
        return redirect(route('categories.index'));
    }

    public function destroy($id)
    {
        Category::destroy($id);
        session()->flash('success', 'Category Deleted');
        return redirect(route('categories.index'));
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('categories.trash', [
            'categories' => $categories,
        ]);
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()
            ->route('categories.trash')
            ->with('success', 'Category restored!');

    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()
            ->route('categories.trash')
            ->with('success', 'Category deleted for ever!');
    }

    protected function rules()
    {
        //Appending new rules to existing rules
        $rules = $this->rules;
//            $rules['name'][] = function ($attribute, $value, $fail) {
//                if ($value == 'god') {
//                    $fail('this word is not allowed');
//                }
//            };


        //using FilterRules class
        $rules['name'][] = new FilterRule();
        //using Validator Facades class and code exist in app service provider
        //$rules['name'][] ='filter';//we can add it as this line or directly to array rules as 'required' rule
        return $rules;
    }

}
