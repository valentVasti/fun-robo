<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        $testimoni = Testimoni::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $testimoni_data = Testimoni::all();

        $testimoni->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.testimoni.index', [
            'activePage' => 'testimoni' // Set the active page to 'home'
        ], compact('testimoni', 'testimoni_data'));
    }


    public function create()
    {
        return view('backend.testimoni.create', [
            'activePage' => 'testimoni' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {

        $rules = [
            'nama_testimoni' => 'required',
            'keterangan_testimoni' => 'required',
            'umur_testimoni' => 'required|numeric|digits:2',
            'keterangan_testimoni' => 'required',
            'isi_testimoni' => 'required|max:255',
            'gambar_testimoni' => 'required|mimes:jpg,png|max:1024',
            'gambar_testimoni_desc' => 'required'
        ];

        $data = [
            'nama_testimoni' => $request->nama_testimoni,
            'keterangan_testimoni' => $request->keterangan_testimoni,
            'umur_testimoni' => $request->umur_testimoni,
            'keterangan_testimoni' => $request->keterangan_testimoni,
            'isi_testimoni' => $request->isi_testimoni,
            'gambar_testimoni' => $request->gambar_testimoni,
            'gambar_testimoni_desc' => $request->gambar_testimoni_desc
        ];

        $message = [
            'nama_testimoni.required' => 'Nama Testimonee wajib diisi!',
            'keterangan_testimoni.required' => 'Keterangan Testimonee wajib diisi!',
            'umur_testimoni.required' => 'Umur Testimonee wajib diisi!',
            'umur_testimoni.numeric' => 'Umur Testimonee harus dalam format 2 digit! (e.g: 17)',
            'umur_testimoni.digits' => 'Umur Testimonee harus dalam format 2 digit! (e.g: 17)',
            'isi_testimoni.required' => 'Isi testimoni wajib diisi!',
            'isi_testimoni.max' => 'Maksimal 255 karakter!',
            'gambar_testimoni.required' => 'Gambar testimoni wajib diisi!',
            'gambar_testimoni.mimes' => 'Gambar harus dalam format JPG/PNG',
            'gambar_testimoni_desc.required' => 'Deskripsi gambar wajib diisi!',
            '*.max' => 'Ukuran gambar max. 1Mb'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $originalName = str_replace([' ', '\t', '\n', '\r'], '', $request->file('gambar_testimoni')->getClientOriginalName());
        $img_name = time() . '_testiImg_' . $originalName;
        $path = public_path('images/database/testimoni');
        $request->file('gambar_testimoni')->move($path, $img_name);

        Testimoni::create([
            'gambar_testimoni' => $img_name,
            'gambar_testimoni_desc' => $data['gambar_testimoni_desc'],
            'nama_testimoni' => $data['nama_testimoni'],
            'keterangan_testimoni' => $data['keterangan_testimoni'],
            'umur_testimoni' => $data['umur_testimoni'],
            'isi_testimoni' => $data['isi_testimoni']
        ]);

        return redirect()->route('testimoni.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {       
        $testimoni = Testimoni::find($id);

        return view('backend.testimoni.edit', [
            'activePage' => 'testimoni' // Set the active page to 'home'
        ], compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make([
            'nama_testimoni' => $request->nama_testimoni,
            'keterangan_testimoni' => $request->keterangan_testimoni,
            'umur_testimoni' => $request->umur_testimoni,
            'keterangan_testimoni' => $request->keterangan_testimoni,
            'isi_testimoni' => $request->isi_testimoni,
            'gambar_testimoni' => $request->gambar_testimoni,
            'gambar_testimoni_desc' => $request->gambar_testimoni_desc
        ], [
            'nama_testimoni' => 'required',
            'keterangan_testimoni' => 'required',
            'umur_testimoni' => 'required|numeric|digits:2',
            'keterangan_testimoni' => 'required',
            'isi_testimoni' => 'required|max:255',
            'gambar_testimoni' => 'nullable|image|mimes:jpg,png|max:1024',
            'gambar_testimoni_desc' => 'required'
        ], [
            'nama_testimoni.required' => 'Nama Testimonee wajib diisi!',
            'keterangan_testimoni.required' => 'Keterangan Testimonee wajib diisi!',
            'umur_testimoni.required' => 'Umur Testimonee wajib diisi!',
            'umur_testimoni.numeric' => 'Umur Testimonee harus dalam format 2 digit! (e.g: 17)',
            'umur_testimoni.digits' => 'Umur Testimonee harus dalam format 2 digit! (e.g: 17)',
            'isi_testimoni.required' => 'Isi testimoni wajib diisi!',
            'isi_testimoni.max' => 'Maksimal 255 karakter!',
            'gambar_testimoni.mimes' => 'Gambar harus dalam format JPG/PNG',
            'gambar_testimoni_desc.required' => 'Deskripsi gambar wajib diisi!',
            '*.max' => 'Ukuran gambar max. 1Mb'
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $testimoni = Testimoni::find($id);

        if ($request->file('gambar_testimoni') != null) {
            $old_path = public_path('images/database/testimoni/' . $testimoni->gambar_testimoni);

            if (File::exists($old_path)) {
                File::delete($old_path);

                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $request->file('gambar_testimoni')->getClientOriginalName());
                $new_img_name = time() . '_testiImg_' . $originalName;
                $path = public_path('images/database/testimoni');
                $request->file('gambar_testimoni')->move($path, $new_img_name);

                $testimoni->update([
                    'nama_testimoni' => $request->nama_testimoni,
                    'keterangan_testimoni' => $request->keterangan_testimoni,
                    'umur_testimoni' => $request->umur_testimoni,
                    'keterangan_testimoni' => $request->keterangan_testimoni,
                    'isi_testimoni' => $request->isi_testimoni,
                    'gambar_testimoni' => $new_img_name,
                    'gambar_testimoni_desc' => $request->gambar_testimoni_desc
                ]);
            } else {
                dump('Image not found');
            }
        } else {
            $testimoni->update([
                'nama_testimoni' => $request->nama_testimoni,
                'keterangan_testimoni' => $request->keterangan_testimoni,
                'umur_testimoni' => $request->umur_testimoni,
                'keterangan_testimoni' => $request->keterangan_testimoni,
                'isi_testimoni' => $request->isi_testimoni,
                'gambar_testimoni_desc' => $request->gambar_testimoni_desc
            ]);
        }

        return redirect()->route('testimoni.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::find($id);

        $old_path = public_path('images/database/testimoni/');

        if (File::exists($old_path . $testimoni->gambar_testimoni)) {
            File::delete($old_path . $testimoni->gambar_testimoni);
            $testimoni->delete();
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $testimoni->gambar_testimoni
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);
    }

    public function search($value)
    {

        $result = Testimoni::where('nama_testimoni', 'like', '%' . $value . '%')
            ->orWhere('keterangan_testimoni', 'like', '%' . $value . '%')
            ->orWhere('umur_testimoni', 'like', '%' . $value . '%')
            ->orWhere('isi_testimoni', 'like', '%' . $value . '%')
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
