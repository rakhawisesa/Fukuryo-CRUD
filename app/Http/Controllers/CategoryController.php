<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $categoryModel;

    public function __construct(CategoryModel $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $data = [
            'categories' => $this->categoryModel->paginate(2),
        ];
        return view('category.index', $data);
    }

    public function create()
    {
        return view('category.create');
    }

    public function listCategory()
    {
        return $this->categoryModel->all();
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:App\Models\Category,name',
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = $request->only(Schema::getColumnListing('categories'));

        return DB::transaction(function () use ($data) {
            $queryResultID = $this->categoryModel::create($data)->id;

            if (!$queryResultID) {
                return redirect()->route('category')->with('error', 'Database error!');
            }

            return redirect()->route('category')->with('success', 'Category saved successfully');
        });
    }

    public function delete($id)
    {
        $categories = collect($this->categoryModel::with(['books'])->find($id)->toArray());

        if (count($categories['books'])) {
            return redirect()->route('category')->with('error', 'Cannot delete selected category, due to there are books connected to selected category!');
        }

        $deleteStatus = $this->categoryModel::where('id', $id)->delete();

        if (!$deleteStatus) {
            return redirect()->route('category')->with('error', 'Database Error!');
        }

        return redirect()->route('category')->with('success', 'Category deleted successfully');
    }

    public function read($id)
    {
        $category = $this->categoryModel::find($id);

        $data = [
            'category' => $category
        ];

        return view('category.update', $data);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:App\Models\Category,name,' . $id,
            'description' => 'required',
            'status' => 'required'
        ]);

        $data = $request->only(Schema::getColumnListing('categories'));

        return DB::transaction(function () use ($data, $id) {
            $queryResult = $this->categoryModel::where('id', $id)->update($data);

            if (!$queryResult) {
                return redirect()->route('category')->with('error', 'Database Error!');
            }

            return redirect()->route('category')->with('success', 'Category ' . $data['name'] . ' updated successfully');
        });
    }
}
