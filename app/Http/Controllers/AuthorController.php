<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author as AuthorModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    private $authorModel;

    public function __construct(AuthorModel $authorModel)
    {
        $this->authorModel = $authorModel;
    }

    public function index()
    {
        $data = [
            'authors' => $this->authorModel->paginate(2),
        ];

        return view('author.index', $data);
    }

    public function create()
    {
        return view('author.create');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'unique:App\Models\Author,name|required',
            'dob' => 'required|date',
            'age' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only(Schema::getColumnListing('authors'));

        return DB::transaction(function () use ($data) {
            $queryResultID = $this->authorModel::create($data)->id;

            if (!$queryResultID) {
                return redirect()->route('author')->with('error', 'Database error!');
            }

            return redirect()->route('author')->with('success', 'Author saved successfully');
        });
    }

    public function listAuthor()
    {
        return $this->authorModel->all();
    }

    public function delete($id)
    {
        $authors = $this->authorModel::with(['books'])->find($id)->toArray();

        if (count($authors['books'])) {
            return redirect()->route('author')->with('error', 'Cannot delete selected author, due to there are books connected to selected author!');
        }

        $deleteStatus = $this->authorModel::where('id', $id)->delete();

        if (!$deleteStatus) {
            return redirect()->route('author')->with('error', 'Database Error!');
        }

        return redirect()->route('author')->with('success', 'Author deleted successfully');
    }

    public function read($id)
    {
        $author = $this->authorModel::find($id);

        $data = [
            'author' => $author
        ];

        return view('author.update', $data);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'unique:App\Models\Author,name,' . $id . '|required',
            'dob' => 'required|date',
            'age' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only(Schema::getColumnListing('authors'));

        return DB::transaction(function () use ($data, $id) {
            $queryResult = $this->authorModel::where('id', $id)->update($data);

            if (!$queryResult) {
                return redirect()->route('author')->with('error', 'Database Error!');
            }

            return redirect()->route('author')->with('success', 'Author ' . $data['name'] . ' updated successfully');
        });
    }
}
