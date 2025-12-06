<?php

namespace App\Http\Controllers;

use App\Models\AboutUsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('backend.about_us.index', [
            'activePage' => 'about_us'
        ]);
    }

    public function getAllData()
    {
        $mascot1 = AboutUsData::where('type', 'mascot1')->first();
        $mascot2 = AboutUsData::where('type', 'mascot2')->first();
        $longText = AboutUsData::where('type', 'longText')->first();
        $homeText = AboutUsData::where('type', 'homeText')->first();
        $shortText = AboutUsData::where('type', 'shortText')->first();
        $image1 = AboutUsData::where('type', 'image1')->first();
        $image2 = AboutUsData::where('type', 'image2')->first();
        $landingImage = AboutUsData::where('type', 'landingImage')->first();

        return response()->json([
            'status' => 'Success',
            'data' => [
                'mascot1' => $mascot1,
                'mascot2' => $mascot2,
                'longText' => $longText,
                'homeText' => $homeText,
                'shortText' => $shortText,
                'image1' => $image1,
                'image2' => $image2,
                'landingImage' => $landingImage,
            ]
        ], 200);
    }

    public function update(Request $request)
    {
        $type = $request->type;

        if ($type == 'image1' || $type == 'image2' || $type == 'landingImage') {

            $aboutUsData = AboutUsData::where('type', $type)->first();

            $old_path = public_path('images/database/aboutUs/' . $aboutUsData->content);

            if (File::exists($old_path)) {
                File::delete($old_path);

                $originalName = str_replace([' ', '\t', '\n', '\r'], '', $request->file('content')->getClientOriginalName());
                $new_img_name = time() . '_aboutUs_' . $type . '_' . $originalName;
                $path = public_path('images/database/aboutUs');
                $request->file('content')->move($path, $new_img_name);

                $updated = $aboutUsData->update([
                    'content' => $new_img_name
                ]);

                return response()->json([
                    'status' => 'Success',
                    'data' => $updated
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Failed',
                    'message' => 'Image not Found: ' . $old_path
                ], 404);
            }
        } else {
            $aboutUsData = AboutUsData::where('type', $type)->first();

            $updated = $aboutUsData->update([
                'content' => $request->content
            ]);

            return response()->json([
                'status' => 'Success',
                'data' => $updated
            ], 200);
        }
    }
}
