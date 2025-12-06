<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CurriculumController extends Controller
{
    public function index(Request $request)
    {
        $curriculum = Curriculum::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $curriculum_data = Curriculum::all();

        $curriculum->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.curriculum.index', [
            'activePage' => 'curriculum' // Set the active page to 'home'
        ], compact('curriculum', 'curriculum_data'));
    }

    public function create()
    {
        return view('backend.curriculum.create', [
            'activePage' => 'curriculum' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'curriculum_name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'age_min' => 'required',
            'age_max' => 'nullable',
            'description' => 'required',
            'details' => 'required',
            'image_path' => 'required|mimes:jpg,png|max:1024',
            'image_description' => 'required'
        ];

        $data = [
            'curriculum_name' => $request->curriculum_name,
            'price' => $request->price,
            'duration' => $request->duration,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'description' => $request->description,
            'details' => $request->details,
            'image_path' => $request->file('image_path'),
            'image_description' => $request->image_description
        ];

        $message = [
            'curriculum_name.required' => 'Nama kelas wajib diisi!',
            'price.required' => 'Harga wajib diisi!',
            'duration.required' => 'Durasi pembelajaran wajib diisi!',
            'age_min.required' => 'Umur (min.) wajib diisi!',
            'description.required' => 'Deskripsi kurikulum wajib diisi!',
            'details.required' => 'Detail kurikulum wajib diisi!',
            'image_path.required' => 'Gambar kurikulum wajib diisi!',
            'image_path.mimes' => 'Gambar harus dalam format JPG/PNG',
            'image_path.max' => 'Ukuran gambar max. 1Mb',
            'image_description.required' => 'Deskripsi gambar kurikulum wajib diisi!',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $originalName = str_replace([' ', '\t', '\n', '\r'], '', $request->file('image_path')->getClientOriginalName());
        $img_name = time() . '_curriculumImg_' . $originalName;
        $path = public_path('images/database/curriculum');
        $request->file('image_path')->move($path, $img_name);

        Curriculum::create([
            'curriculum_name' => $data['curriculum_name'],
            'price' => $data['price'],
            'duration' => $data['duration'],
            'description' => $data['description'],
            'age_min' => $data['age_min'],
            'age_max' => $data['age_max'],
            'details' => $data['details'],
            'image_path' => $img_name,
            'image_description' => $data['image_description']
        ]);

        return redirect()->route('curriculum.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {
        $curriculum = Curriculum::find($id);

        return view('backend.curriculum.edit', [
            'activePage' => 'curriculum' // Set the active page to 'home'
        ], compact('curriculum'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'curriculum_name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'age_min' => 'required',
            'age_max' => 'nullable',
            'description' => 'required',
            'details' => 'required',
            'image_path' => 'nullable|mimes:jpg,png|max:1024',
            'image_description' => 'required'
        ];

        $data = [
            'curriculum_name' => $request->curriculum_name,
            'price' => $request->price,
            'duration' => $request->duration,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'description' => $request->description,
            'details' => $request->details,
            'image_path' => $request->file('image_path'),
            'image_description' => $request->image_description
        ];

        $message = [
            'curriculum_name.required' => 'Nama kelas wajib diisi!',
            'price.required' => 'Harga wajib diisi!',
            'duration.required' => 'Durasi pembelajaran wajib diisi!',
            'age_min.required' => 'Umur (min.) wajib diisi!',
            'description.required' => 'Deskripsi kurikulum wajib diisi!',
            'details.required' => 'Detail kurikulum wajib diisi!',
            'image_path.required' => 'Gambar kurikulum wajib diisi!',
            'image_path.mimes' => 'Gambar harus dalam format JPG/PNG',
            'image_path.max' => 'Ukuran gambar max. 1Mb',
            'image_description.required' => 'Deskripsi gambar kurikulum wajib diisi!',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $curriculum = Curriculum::find($id);

        if ($request->file('image_path') != null) {
            $old_path = public_path('images/database/curriculum/' . $curriculum->image_path);

            if (File::exists($old_path)) {
                File::delete($old_path);

                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $request->file('image_path')->getClientOriginalName());
                $new_img_name = time() . '_curriculumImg_' . $originalName;
                $path = public_path('images/database/curriculum');
                $request->file('image_path')->move($path, $new_img_name);

                $curriculum->update([
                    'curriculum_name' => $data['curriculum_name'],
                    'price' => $data['price'],
                    'duration' => $data['duration'],
                    'age_min' => $data['age_min'],
                    'age_max' => $data['age_max'],
                    'description' => $data['description'],
                    'details' => $data['details'],
                    'image_path' => $new_img_name,
                    'image_description' => $data['image_description']
                ]);
            } else {
                dump('Image not found');
            }
        } else {
            $curriculum->update([
                'curriculum_name' => $data['curriculum_name'],
                'price' => $data['price'],
                'duration' => $data['duration'],
                'age_min' => $data['age_min'],
                'age_max' => $data['age_max'],
                'description' => $data['description'],
                'details' => $data['details'],
                'image_description' => $data['image_description']
            ]);
        }

        return redirect()->route('curriculum.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $curriculum = Curriculum::find($id);

        $old_path = public_path('images/database/curriculum/');

        if (File::exists($old_path . $curriculum->image_path)) {
            File::delete($old_path . $curriculum->image_path);
            $curriculum->delete();
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $curriculum->gambar_testimoni
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);
    }

    public function search($value)
    {
        $result = Curriculum::where('curriculum_name', 'like', '%' . $value . '%')
            ->orWhere('price', 'like', '%' . $value . '%')
            ->orWhere('duration', 'like', '%' . $value . '%')
            ->orWhere('description', 'like', '%' . $value . '%')
            ->orWhere('age_min', 'like', '%' . $value . '%')
            ->orWhere('age_max', 'like', '%' . $value . '%')
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
