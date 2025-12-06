<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use App\Models\AwardsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AwardsController extends Controller
{
    public function index(Request $request)
    {
        $awards = Awards::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $awards_data = Awards::all();

        $awards->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.awards.index', [
            'activePage' => 'awards' // Set the active page to 'home'
        ], compact('awards', 'awards_data'));
    }


    public function create()
    {
        return view('backend.awards.create', [
            'activePage' => 'awards' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'achievement' => 'required',
            'event' => 'required',
            'year' => 'required|numeric|digits:4',
            'place' => 'required',
            'type' => 'required',
            'image_1' => 'required|mimes:jpg,png|max:1024',
            'image_2' => 'required|mimes:jpg,png|max:1024',
            'image_desc_1' => 'required',
            'image_desc_2' => 'required',
        ];

        $data = [
            'achievement' => $request->achievement,
            'event' => $request->event,
            'year' => $request->year,
            'place' => $request->place,
            'type' => $request->type,
            'image_1' => $request->file('image_1'),
            'image_2' => $request->file('image_2'),
            'image_desc_1' => $request->image_desc_1,
            'image_desc_2' => $request->image_desc_2,
        ];

        $message = [
            'achievement.required' => 'Achievement wajib diisi!',
            'event.required' => 'Event wajib diisi!',
            'year.required' => 'Year wajib diisi!',
            'year.numeric' => 'Harus format tahun yang benar! (e.g: 2020)',
            'year.digits' => 'Harus format tahun yang benar! (e.g: 2020)',
            'place.required' => 'Place wajib diisi!',
            'type.required' => 'Pilih salah satu type awards!',
            'image_1.required' => 'Gambar 1 wajib diisi!',
            'image_1.mimes' => 'Gambar harus dalam format JPG/PNG!',
            'image_2.required' => 'Gambar 2 wajib diisi!',
            'image_2.mimes' => 'Gambar harus dalam format JPG/PNG!',
            'image_desc_1.required' => 'Deskripsi Gambar 1 wajib diisi',
            'image_desc_2.required' => 'Deskripsi Gambar 2 wajib diisi!',
            '*.max' => 'Ukuran gambar max. 1Mb'
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $newData = Awards::create([
            'achievement' => $data['achievement'],
            'event' => $data['event'],
            'year' => $data['year'],
            'place' => $data['place'],
            'type' => $data['type']
        ]);

        $image_1 = $request->file('image_1');
        $image_2 = $request->file('image_2');

        if ($image_1->isValid()) {
            $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image_1->getClientOriginalName());
            $img_name = time() . $request->image_desc_1 . '_image1_' . $originalName;
            $path = public_path('images/database/awards');
            $image_1->move($path, $img_name);

            AwardsImage::create([
                'id_awards' => $newData->id,
                'path' => $img_name,
                'image_desc' => $request->image_desc_1
            ]);
        }

        if ($image_2->isValid()) {
            $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image_2->getClientOriginalName());
            $img_name = time() . $request->image_desc_1 . '_image2_' . $originalName;
            $path = public_path('images/database/awards');
            $image_2->move($path, $img_name);

            AwardsImage::create([
                'id_awards' => $newData->id,
                'path' => $img_name,
                'image_desc' => $request->image_desc_2
            ]);
        }

        return redirect()->route('awards.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function edit($id)
    {
        $awards = Awards::find($id);
        $allImage = AwardsImage::where('id_awards', $awards->id)->get();

        $image_1 = $allImage[0];
        $image_2 = $allImage[1];

        return view('backend.awards.edit', [
            'activePage' => 'awards' // Set the active page to 'home'
        ], compact('awards', 'image_1', 'image_2'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make([
            'achievement' => $request->achievement,
            'event' => $request->event,
            'year' => $request->year,
            'place' => $request->place,
            'type' => $request->type,
            'image_1' => $request->image_1,
            'image_2' => $request->image_2,
            'image_desc_1' => $request->image_desc_1,
            'image_desc_2' => $request->image_desc_2,
        ], [
            'achievement' => 'required',
            'event' => 'required',
            'year' => 'required',
            'place' => 'required',
            'type' => 'required',
            'image_1' => 'nullable|image|mimes:jpg,png|max:1024',
            'image_2' => 'nullable|image|mimes:jpg,png|max:1024',
            'image_desc_1' => 'required',
            'image_desc_2' => 'required'
        ], [
            'achievement.required' => 'Achievement wajib diisi!',
            'event.required' => 'Event wajib diisi!',
            'year.required' => 'Year wajib diisi!',
            'place.required' => 'Place wajib diisi!',
            'type.required' => 'Pilih salah satu type awards!',
            'image_1.mimes' => 'Gambar harus dalam format JPG/PNG!',
            'image_2.mimes' => 'Gambar harus dalam format JPG/PNG!',
            'image_desc_1.required' => 'Deskripsi Gambar 1 wajib diisi',
            'image_desc_2.required' => 'Deskripsi Gambar 2 wajib diisi!',
            '*max' => 'Ukuran gambar max. 1Mb'
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $new_image_1 = $request->file('image_1');
        $new_image_2 = $request->file('image_2');

        $awards = Awards::find($id);

        $allImage = AwardsImage::where('id_awards', $awards->id)->get();

        $image_1_path = $allImage[0]->path;
        $image_2_path = $allImage[1]->path;

        if ($new_image_1 != null) {
            $old_path = public_path('images/database/awards/' . $image_1_path);

            if (File::exists($old_path)) {
                File::delete($old_path);

                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $new_image_1->getClientOriginalName());
                $new_img_name = time() . '_image1_' . $originalName;
                $path = public_path('images/database/awards');
                $new_image_1->move($path, $new_img_name);

                $allImage[0]->update([
                    'path' => $new_img_name,
                    'image_desc' => $request->image_desc_1
                ]);
            } else {
                dump('Image not found');
            }
        }

        if ($new_image_2 != null) {
            // update image_2
            $old_path = public_path('images/database/awards/' . $image_2_path);

            if (File::exists($old_path)) {
                File::delete($old_path);

                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $new_image_2->getClientOriginalName());
                $new_img_name = time() . '_image2_' . $originalName;
                $path = public_path('images/database/awards');
                $new_image_2->move($path, $new_img_name);

                $allImage[1]->update([
                    'path' => $new_img_name,
                    'image_desc' => $request->image_desc_2
                ]);
            } else {
                dump('Image not found');
            }
        }

        $awards->update([
            'achievement' => $request->achievement,
            'event' => $request->event,
            'year' => $request->year,
            'place' => $request->place,
            'type' => $request->type
        ]);

        return redirect()->route('awards.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $awards = Awards::find($id);

        $allImage = AwardsImage::where('id_awards', $awards->id)->get();

        $image_1_path = $allImage[0]->path;
        $image_2_path = $allImage[1]->path;

        $old_path = public_path('images/database/awards/');

        if (File::exists($old_path . $image_1_path)) {
            File::delete($old_path . $image_1_path);
            $allImage[0]->delete();
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $image_1_path
            ], 404);
        }

        if (File::exists($old_path . $image_2_path)) {
            File::delete($old_path . $image_2_path);
            $allImage[1]->delete();
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $image_2_path
            ], 404);
        }

        $awards->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted successfully'
        ], 200);
    }

    public function search($value)
    {

        $result = Awards::where('achievement', 'like', '%' . $value . '%')
            ->orWhere('event', 'like', '%' . $value . '%')
            ->orWhere('year', 'like', '%' . $value . '%')
            ->orWhere('place', 'like', '%' . $value . '%')
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
