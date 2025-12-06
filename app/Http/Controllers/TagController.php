<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{

    public function index(Request $request)
    {
        $tag = Tag::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $tag_data = Tag::all();

        $tag->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.tag.index', [
            'activePage' => 'tag' // Set the active page to 'home'
        ], compact('tag', 'tag_data'));
    }


    public function create()
    {
        return view('backend.tag.create', [
            'activePage' => 'tag' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {

        $rules = [
            'tag_name' => 'required'
        ];

        $data = [
            'tag_name' => $request->tag_name
        ];

        $message = [
            'tag_name.required' => 'Tag Name wajib diisi!'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Tag::create([
            'tag_name' => $data['tag_name']
        ]);

        return redirect()->route('tag.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('backend.tag.edit', [
            'activePage' => 'tag' // Set the active page to 'home'
        ], compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'tag_name' => 'required'
        ];

        $data = [
            'tag_name' => $request->tag_name
        ];

        $message = [
            'tag_name.required' => 'Tag Name wajib diisi!'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tag = Tag::find($id);
        $tag->update([
            'tag_name' => $data['tag_name']
        ]);

        return redirect()->route('tag.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        if($tag == null){
            return response()->json([
                'status' => 'Failed',
                'message' => 'FAQ not found!'
            ], 404);  
        }

        $tag->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);

    }

    public function getAll(){
        $tag = Tag::all();

        return response()->json([
            'status' => 'Success',
            'data' => $tag
        ]);
    }

    public function search($value)
    {

        $result = Tag::where('tag_name', 'like', '%' . $value . '%')->get();

        if(count($result) == 0){
            return response()->json([
                'status' => 'Not Found',
                'value' => $value,
                'search' => $result
            ]);    
        }
        return response()->json([
            'status' => 'Found',
            'value' => $value,
            'search' => $result
        ]);
    }

}
