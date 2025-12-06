<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $user_data = User::all();

        $user->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.user.index', [
            'activePage' => 'user' // Set the active page to 'home'
        ], compact('user', 'user_data'));
    }


    public function getAll()
    {
        $user = User::all();

        return response()->json($user);
    }

    public function create()
    {
        return view('backend.user.create', [
            'activePage' => 'user' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users,username',
            'password' => 'required'
        ];

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $message = [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'username.unique' => 'Username sudah digunakan!'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $hashedPassword = Hash::make($request->password);

        User::create([
            'username' => $request->username,
            'password' => $hashedPassword
        ]);

        return redirect()->route('user.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('backend.user.edit', [
            'activePage' => 'user' // Set the active page to 'home'
        ], compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make([
            'username' => $request->username
        ], [
            'username' => 'required|unique:users,username'
        ], [
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username sudah digunakan!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $user = User::find($id);
        $user->update([
            'username' => $request->username
        ]);

        return redirect()->route('user.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user == null) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'FAQ not found!'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);
    }

    public function search($value)
    {

        $result = User::where('username', 'like', '%' . $value . '%')->get();

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
}
