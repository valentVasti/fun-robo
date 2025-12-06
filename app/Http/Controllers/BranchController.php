<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    // public function index()
    // {
    //     $branch = Branch::all();

    //     return view('backend.branch.index', [
    //         'activePage' => 'branch' // Set the active page to 'home'
    //     ], compact('branch'));
    // }

    public function index(Request $request)
    {
        $branch = Branch::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $branch_data = Branch::all();

        $branch->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.branch.index', [
            'activePage' => 'branch' // Set the active page to 'home'
        ], compact('branch', 'branch_data'));
    }


    public function create()
    {
        return view('backend.branch.create', [
            'activePage' => 'branch' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_branch' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'gambar_branch' => 'required|mimes:jpg,png|max:1024',
            'gambar_branch_desc' => 'required',
            'phone_num' => 'required',
            'instagram' => 'required',
            'link_instagram' => 'required',
            'facebook' => 'required',
            'link_facebook' => 'required',
            'link_gmaps' => 'required',
            'email' => 'required'
        ];

        $data = [
            'nama_branch' => $request->nama_branch,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'gambar_branch' => $request->file('gambar_branch'),
            'gambar_branch_desc' => $request->gambar_branch_desc,
            'phone_num' => $request->phone_num,
            'instagram' => $request->instagram,
            'link_instagram' => $request->link_instagram,
            'facebook' => $request->facebook,
            'link_facebook' => $request->link_facebook,
            'link_gmaps' => $request->link_gmaps,
            'email' => $request->email
        ];

        $message = [
            'nama_branch.required' => 'Nama branch wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'kota.required' => 'Kota wajib diisi!',
            'provinsi.required' => 'Provinsi wajib diisi!',
            'gambar_branch.required' => 'Gambar branch wajib diisi!',
            'gambar_branch.mimes' => 'Gambar harus dalam format JPG/PNG!',
            'gambar_branch_desc.required' => 'Deskripsi gambar branch wajib diisi!',
            'phone_num.required' => 'Nomor telepon wajib diisi!',
            'instagram.required' => 'Akun Instagram wajib diisi!',
            'link_instagram.required' => 'Link Instagram wajib diisi!',
            'facebook.required' => 'Akun Facebook wajib diisi!',
            'link_facebook.required' => 'Link Facebook wajib diisi!',
            'link_gmaps.required' => 'Link Google Maps wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            '*.max' => 'Ukuran gambar max. 1Mb'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $branch_img = $request->file('gambar_branch');

        if ($branch_img->isValid()) {
            $originalName = str_replace([' ', '\t', '\n', '\r'], '', $branch_img->getClientOriginalName());
            $img_name = time() . '_gambarBranch_' . $originalName;
            $path = public_path('images/database/branch');
            $branch_img->move($path, $img_name);

            Branch::create([
                'nama_branch' => $data['nama_branch'],
                'alamat' => $data['alamat'],
                'kota' => $data['kota'],
                'provinsi' => $data['provinsi'],
                'gambar_branch' => $img_name,
                'gambar_branch_desc' => $data['gambar_branch_desc'],
                'phone_num' => $data['phone_num'],
                'instagram' => $data['instagram'],
                'link_instagram' => $data['link_instagram'],
                'facebook' => $data['facebook'],
                'link_facebook' => $data['link_facebook'],
                'link_gmaps' => $data['link_gmaps'],
                'email' => $data['email']
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Image invalid!',
            ], 400);
        }

        $status = "Success";

        return redirect()->route('branch.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {
        $branch = Branch::find($id);

        return view('backend.branch.edit', [
            'activePage' => 'branch' // Set the active page to 'home'
        ], compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_branch' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'gambar_branch' => 'nullable|mimes:jpg,png|max:1024',
            'gambar_branch_desc' => 'required',
            'phone_num' => 'required',
            'instagram' => 'required',
            'link_instagram' => 'required',
            'facebook' => 'required',
            'link_facebook' => 'required',
            'link_gmaps' => 'required',
            'email' => 'required'
        ];

        $data = [
            'nama_branch' => $request->nama_branch,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'gambar_branch' => $request->file('gambar_branch'),
            'gambar_branch_desc' => $request->gambar_branch_desc,
            'phone_num' => $request->phone_num,
            'instagram' => $request->instagram,
            'link_instagram' => $request->link_instagram,
            'facebook' => $request->facebook,
            'link_facebook' => $request->link_facebook,
            'link_gmaps' => $request->link_gmaps,
            'email' => $request->email
        ];

        $message = [
            'nama_branch.required' => 'Nama branch wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'kota.required' => 'Kota wajib diisi!',
            'provinsi.required' => 'Provinsi wajib diisi!',
            'gambar_branch.mimes' => 'Gambar harus dalam format JPG/PNG!',
            'gambar_branch_desc.required' => 'Deskripsi gambar branch wajib diisi!',
            'phone_num.required' => 'Nomor telepon wajib diisi!',
            'instagram.required' => 'Akun Instagram wajib diisi!',
            'link_instagram.required' => 'Link Instagram wajib diisi!',
            'facebook.required' => 'Akun Facebook wajib diisi!',
            'link_facebook.required' => 'Link Facebook wajib diisi!',
            'link_gmaps.required' => 'Link Google Maps wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            '*.max' => 'Ukuran gambar max. 1Mb'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $branch = Branch::find($id);

        $branch_img = $request->file('gambar_branch');

        if ($branch_img != null) {
            $old_path = public_path('images/database/branch/' . $branch->gambar_branch);

            if (File::exists($old_path)) {
                File::delete($old_path);

                if ($branch_img->isValid()) {
                    $originalName = str_replace([' ', '\t', '\n', '\r'], '', $branch_img->getClientOriginalName());
                    $img_name = time() . '_gambarBranch_' . $originalName;
                    $path = public_path('images/database/branch');
                    $branch_img->move($path, $img_name);

                    $branch->update([
                        'gambar_branch' => $img_name
                    ]);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Image invalid!',
                    ], 400);
                }
            }
        }

        $branch->update([
            'nama_branch' => $data['nama_branch'],
            'alamat' => $data['alamat'],
            'kota' => $data['kota'],
            'provinsi' => $data['provinsi'],
            'gambar_branch_desc' => $data['gambar_branch_desc'],
            'phone_num' => $data['phone_num'],
            'instagram' => $data['instagram'],
            'link_instagram' => $data['link_instagram'],
            'facebook' => $data['facebook'],
            'link_facebook' => $data['link_facebook'],
            'link_gmaps' => $data['link_gmaps'],
            'email' => $data['email']
        ]);

        $status = "Success";

        return redirect()->route('branch.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);

        $img_path = public_path('/images/database/branch/' . $branch->gambar_branch);

        if (File::exists($img_path)) {
            File::delete($img_path);
            $branch->delete();
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $branch->gambar_branch
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);
    }

    public function search($value)
    {

        $result = Branch::where('nama_branch', 'like', '%' . $value . '%')
            ->orWhere('alamat', 'like', '%' . $value . '%')
            ->orWhere('kota', 'like', '%' . $value . '%')
            ->orWhere('provinsi', 'like', '%' . $value . '%')
            ->orWhere('phone_num', 'like', '%' . $value . '%')
            ->orWhere('instagram', 'like', '%' . $value . '%')
            ->orWhere('facebook', 'like', '%' . $value . '%')
            ->orWhere('email', 'like', '%' . $value . '%')
            ->get();

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
