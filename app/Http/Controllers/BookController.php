<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Book as BookModel;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    private $authorController;
    private $categoryController;
    private $bookModel;

    public function __construct(AuthorController $authorController, CategoryController $categoryController, BookModel $bookModel)
    {
        $this->authorController = $authorController;
        $this->categoryController = $categoryController;
        $this->bookModel = $bookModel;
    }

    public function index()
    {
        $data = [
            'books' => $this->bookModel::with(['category', 'author'])->paginate(2)
        ];
        return view('book.index', $data);
    }

    public function create()
    {
        $data = [
            'category' => $this->categoryController->listCategory(),
            'author' => $this->authorController->listAuthor(),
        ];

        return view('book.create', $data);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'unique:App\Models\Book,name|required',
            'isbn' => 'required',
            'category_id' => 'required',
            'author_id' => 'required'
        ]);

        $data = $request->only(Schema::getColumnListing('books'));

        return DB::transaction(function () use ($data) {
            $queryResultID = $this->bookModel->create($data)->id;

            if (!$queryResultID) {
                return redirect()->route('book')->with('error', 'Database error!');
            }

            return redirect()->route('book')->with('success', 'Book saved successfully');
        });
    }

    public function delete($id)
    {
        $deleteStatus = $this->bookModel::where('id', $id)->delete();

        if (!$deleteStatus) {
            return redirect()->route('book')->with('error', 'Database error!');
        }

        return redirect()->route('book')->with('success', 'Book deleted successfully');
    }

    public function read($id)
    {
        $book = $this->bookModel::with(['author', 'category'])->find($id);
        $authors = $this->authorController->listAuthor();
        $categories = $this->categoryController->listCategory();

        $data = [
            'book' => $book,
            'authors' => $authors,
            'categories' => $categories
        ];

        return view('book.update', $data);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'unique:App\Models\Book,name,' . $id . '|required',
            'isbn' => 'required',
            'category_id' => 'required',
            'author_id' => 'required'
        ]);

        $data = $request->only(Schema::getColumnListing('books'));

        return DB::transaction(function () use ($data, $id) {
            $queryResult = $this->bookModel::where('id', $id)->update($data);

            if (!$queryResult) {
                return redirect()->route('book')->with('error', 'Database Error!');
            }

            return redirect()->route('book')->with('success', 'Book ' . $data['name'] . ' updated successfully');
        });
    }
}
