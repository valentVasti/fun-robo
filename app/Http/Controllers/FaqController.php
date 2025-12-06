<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faq = Faq::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $faq_data = Faq::all();

        $faq->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.faq.index', [
            'activePage' => 'faq' // Set the active page to 'home'
        ], compact('faq', 'faq_data'));
    }

    public function create()
    {
        return view('backend.faq.create', [
            'activePage' => 'faq' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'question' => 'required',
            'answer' => 'required'
        ];

        $data = [
            'question' => $request->question,
            'answer' => $request->answer
        ];

        $message = [
            'question.required' => 'Question wajib diisi!',
            'answer.required' => 'Answer wajib diisi!'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }


        Faq::create([
            'question' => $data['question'],
            'answer' => $data['answer']
        ]);

        return redirect()->route('faq.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {
        $faq = Faq::find($id);

        return view('backend.faq.edit', [
            'activePage' => 'faq' // Set the active page to 'home'
        ], compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make([
            'question' => $request->question,
            'answer' => $request->answer
        ], [
            'question' => 'required',
            'answer' => 'required'
        ], [
            'question.required' => 'Question wajib diisi!',
            'answer.required' => 'Answer wajib diisi!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $faq = Faq::find($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return redirect()->route('faq.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if ($faq == null) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'FAQ not found!'
            ], 404);
        }

        $faq->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);
    }

    public function search($value)
    {

        $result = Faq::where('question', 'like', '%' . $value . '%')->orWhere('answer', 'like', '%' . $value . '%')->get();

        if (count($result) == 0) {
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

    public function translate()
    {
        $tr = new GoogleTranslate('id');
        $tr->setTarget('en');

        $article = Article::find(64);
        $translateString = $article->isi;
        $json = [
            'source' => $translateString,
            'result' => $tr->translate($translateString)
        ];

        return response()->json($json, 200);
    }
}
