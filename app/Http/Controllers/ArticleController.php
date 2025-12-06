<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $article = Article::orderBy('created_at', 'desc')->paginate((int)$request->data_per_page);
        $article_data = Article::all();

        foreach ($article as $article_data) {
            $article_data->tag = ArticleTag::where('id_article', $article_data->id)->get();
            foreach ($article_data->tag as $tag_data) {
                $tag_data->detail = Tag::find($tag_data->id_tag);
            }
        }
        $article->appends(['data_per_page' => (int)$request->data_per_page]);

        return view('backend.article.index', [
            'activePage' => 'article'
        ], compact('article', 'article_data'));
    }

    public function create()
    {

        return view('backend.article.create', [
            'activePage' => 'article' // Set the active page to 'home'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'penulis' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'thumbnail' => 'required|mimes:jpg,png|max:1024',
            'thumbnail_desc' => 'required',
            'thumbnail_caption' => 'required',
            'article_tag' => 'required'
        ];

        $data = [
            'penulis' => $request->penulis,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'article_tag' => $request->article_tag,
            'thumbnail' => $request->thumbnail,
            'thumbnail_desc' => $request->thumbnail_desc,
            'thumbnail_caption' => $request->thumbnail_caption,
        ];

        $message = [
            'penulis.required' => 'Penulis artikel wajib diisi!',
            'judul.required' => 'Judul artikel wajib diisi!',
            'isi.required' => 'Isi artikel wajib diisi!',
            'article_tag.required' => 'Pilih minimal 1 tag!',
            'thumbnail.required' => 'Thumbnail artikel wajib diisi!',
            '*.max' => 'Ukuran gambar max. 1Mb',
            'thumbnail_desc.required' => 'Thumbail Description wajib diisi!',
            'thumbnail_desc.caption' => 'Thumbail Caption wajib diisi!',
            '*.mimes' => 'Gambar harus dalam format JPG/PNG!',
        ];

        $image_num = 0;

        switch ($request['radio-group']) {
            case '1_img':
                $rules['article_image_1'] = 'required|mimes:jpg,png|max:1024';
                $data['article_image_1'] = $request->article_image_1;
                $message['article_image_1.required'] = 'Gambar Artikel 1 Wajib diisi!';

                $rules['article_image_1_desc'] = 'required';
                $data['article_image_1_desc'] = $request->article_image_1_desc;
                $message['article_image_1_desc.required'] = 'Deskripsi Gambar Artikel 1 wajib diisi!';

                $rules['article_image_1_capt'] = 'required';
                $data['article_image_1_capt'] = $request->article_image_1_capt;
                $message['article_image_1_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';
                $image_num = 1;
                break;

            case '2_img':
                $rules['article_image_1'] = 'required|mimes:jpg,png|max:1024';
                $data['article_image_1'] = $request->article_image_1;
                $message['article_image_1.required'] = 'Gambar Artikel 1 Wajib diisi!';

                $rules['article_image_2'] = 'required|mimes:jpg,png|max:1024';
                $data['article_image_2'] = $request->article_image_2;
                $message['article_image_2.required'] = 'Gambar Artikel 2 Wajib diisi!';

                $rules['article_image_1_desc'] = 'required';
                $data['article_image_1_desc'] = $request->article_image_1_desc;
                $message['article_image_1_desc.required'] = 'Deskripsi Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_desc'] = 'required';
                $data['article_image_2_desc'] = $request->article_image_1_desc;
                $message['article_image_2_desc.required'] = 'Deskripsi Gambar Artikel 2 wajib diisi!';

                $rules['article_image_1_capt'] = 'required';
                $data['article_image_1_capt'] = $request->article_image_1_capt;
                $message['article_image_1_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_capt'] = 'required';
                $data['article_image_2_capt'] = $request->article_image_2_capt;
                $message['article_image_2_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';
                $image_num = 2;
                break;

            case '3_img':
                $rules['article_image_1'] = 'required|mimes:jpg,png|max:1024';
                $data['article_image_1'] = $request->article_image_1;
                $message['article_image_1.required'] = 'Gambar Artikel 1 Wajib diisi!';

                $rules['article_image_2'] = 'required|mimes:jpg,png|max:1024';
                $data['article_image_2'] = $request->article_image_2;
                $message['article_image_2.required'] = 'Gambar Artikel 2 Wajib diisi!';

                $rules['article_image_3'] = 'required|mimes:jpg,png|max:1024';
                $data['article_image_3'] = $request->article_image_3;
                $message['article_image_3.required'] = 'Gambar Artikel 3 Wajib diisi!';

                $rules['article_image_1_desc'] = 'required';
                $data['article_image_1_desc'] = $request->article_image_1_desc;
                $message['article_image_1_desc.required'] = 'Deskripsi Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_desc'] = 'required';
                $data['article_image_2_desc'] = $request->article_image_2_desc;
                $message['article_image_2_desc.required'] = 'Deskripsi Gambar Artikel 2 wajib diisi!';

                $rules['article_image_3_desc'] = 'required';
                $data['article_image_3_desc'] = $request->article_image_3_desc;
                $message['article_image_3_desc.required'] = 'Deskripsi Gambar Artikel 3 wajib diisi!';

                $rules['article_image_1_capt'] = 'required';
                $data['article_image_1_capt'] = $request->article_image_1_capt;
                $message['article_image_1_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_capt'] = 'required';
                $data['article_image_2_capt'] = $request->article_image_2_capt;
                $message['article_image_2_capt.required'] = 'Caption Gambar Artikel 2 wajib diisi!';

                $rules['article_image_3_capt'] = 'required';
                $data['article_image_3_capt'] = $request->article_image_3_capt;
                $message['article_image_3_capt.required'] = 'Caption Gambar Artikel 3 wajib diisi!';
                $image_num = 3;
                break;

            default:

                break;
        }

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $article_img_data = [];

        for ($i = 1; $i < $image_num + 1; $i++) {

            $image = $request->file('article_image_' . $i);

            $originalName = str_replace([' ', '\t', '\n', '\r'], '', $image->getClientOriginalName());
            $img_name = time() . '_image' . $i . 'article_' . $originalName;
            $path = public_path('images/database/article');
            $image->move($path, $img_name);

            $article_img_data[] = [
                'num' => $i,
                'path' => $img_name,
                'caption' => $data['article_image_' . $i . '_capt'],
                'image_desc' => $data['article_image_' . $i . '_desc']
            ];
        }

        $article_image = $article_img_data;

        $result = $this->setIsiArticle($data['isi'], $article_image);

        $thumbnail = $request->file('thumbnail');

        if ($thumbnail->isValid()) {
            $originalName = str_replace([' ', '\t', '\n', '\r'], '', $thumbnail->getClientOriginalName());
            $img_name = time() . '_thumbnailImg_' . $originalName;
            $path = public_path('images/database/article');
            $request->file('thumbnail')->move($path, $img_name);

            $new_data = Article::create([
                'penulis' => $data['penulis'],
                'judul' => $data['judul'],
                'isi' => $result,
                'thumbnail' => $img_name,
                'thumbnail_desc' => $data['thumbnail_desc'],
                'thumbnail_caption' => $data['thumbnail_caption'],
            ]);
        }

        $article_tag = json_decode($request->article_tag);

        foreach ($article_tag as $data) {
            ArticleTag::create([
                'id_article' => $new_data->id,
                'id_tag' => $data->id
            ]);
        }

        foreach ($article_img_data as $data) {
            ArticleImage::create([
                'id_artikel' => $new_data->id,
                'num' => $data['num'],
                'path' => $data['path'],
                'caption' => $data['caption'],
                'image_desc' => $data['image_desc']
            ]);
        }

        return redirect()->route('article.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function setIsiArticle($isi, $article_image)
    {
        $result = $isi;
        $baseUrl = url('/');
        $count_not_found = 0;
        $patternToFind = '[img]';
        $img_not_found = "<figure id=\"img_not_found\"><img src=\"#\" alt= \"Image Not Found\"><figcaption>[Delete this Tag and Image]</figcaption></figure>";

        foreach ($article_image as $data) {

            $img_section = "<figure><img src=\"" . $baseUrl . "/images/database/article/" . $data['path'] . "\" alt=\"" . $data['image_desc'] . "\"><figcaption>" . $data['caption'] . "</figcaption></figure>";

            if (strpos($result, $patternToFind) !== false) {
                // Pattern found, perform replacement
                // $result = str_replace($patternToFind, $img_section, $result);
                $result = preg_replace('/' . preg_quote($patternToFind, '/') . '/', $img_section, $result, 1);
            } else if (strpos($result, 'Img Tag Not Found - Add Tag Here]') == false) {
                // Pattern not found
                $count_not_found++;
            }
        }

        if ($count_not_found > 0) {
            $htmlString = '<figure id="tag_not_found"><p style="color: rgb(166, 166, 166); font-style: italic; font-size: small;">[' . $count_not_found . ' Img Tag Not Found - Add Tag Here]</p></figure>';
            $result = $result . $htmlString;
        }

        if (strpos($result, $patternToFind) !== false) {
            // img not found
            $result = str_replace($patternToFind, $img_not_found, $result);
        }

        return $result;
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $article->tag = ArticleTag::where('id_article', $article->id)->get();
        foreach ($article->tag as $tag_data) {
            $tag_data->detail = Tag::find($tag_data->id_tag);
        }

        $isi = $article->isi;
        $pattern = '/<figure>.*?<\/figure>/s';
        $replacement = '[img]';

        $result = preg_replace($pattern, $replacement, $isi);

        $article->isi = $result;

        $article_img = ArticleImage::where('id_artikel', $article->id)->get();

        return view('backend.article.edit', [
            'activePage' => 'article' // Set the active page to 'home'
        ], compact('article', 'article_img'));
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'penulis' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'thumbnail' => 'nullable|mimes:jpg,png|max:1024',
            'thumbnail_desc' => 'required',
            'thumbnail_caption' => 'required',
            'article_image_1' => 'nullable|mimes:jpg,png|max:1024',
            'article_image_2' => 'nullable|mimes:jpg,png|max:1024',
            'article_image_3' => 'nullable|mimes:jpg,png|max:1024',
            'article_tag' => 'required'
        ];

        $data = [
            'penulis' => $request->penulis,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'thumbnail' => $request->thumbnail,
            'thumbnail_desc' => $request->thumbnail_desc,
            'thumbnail_caption' => $request->thumbnail_caption,
            'article_image_1' => $request->article_image_1,
            'article_image_2' => $request->article_image_2,
            'article_image_3' => $request->article_image_3,
            'article_tag' => $request->article_tag
        ];

        $message = [
            'penulis.required' => 'Penulis artikel wajib diisi!',
            'judul.required' => 'Judul artikel wajib diisi!',
            'isi.required' => 'Isi artikel wajib diisi!',
            'thumbnail_desc.required' => 'Thumbail Description wajib diisi!',
            'thumbnail_desc.caption' => 'Thumbail Caption wajib diisi!',
            'article_tag.required' => 'Pilih minimal 1 tag!',
            '*.mimes' => 'Gambar harus dalam format JPG/PNG!',
            '*.max' => 'Ukuran gambar max. 1Mb'
        ];

        $image_num = 0;

        switch ($request['radio-group']) {
            case '1_img':
                $rules['article_image_1_desc'] = 'required';
                $data['article_image_1_desc'] = $request->article_image_1_desc;
                $message['article_image_1_desc.required'] = 'Deskripsi Gambar Artikel 1 wajib diisi!';

                $rules['article_image_1_capt'] = 'required';
                $data['article_image_1_capt'] = $request->article_image_1_capt;
                $message['article_image_1_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';
                $image_num = 1;
                break;

            case '2_img':
                $rules['article_image_1_desc'] = 'required';
                $data['article_image_1_desc'] = $request->article_image_1_desc;
                $message['article_image_1_desc.required'] = 'Deskripsi Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_desc'] = 'required';
                $data['article_image_2_desc'] = $request->article_image_1_desc;
                $message['article_image_2_desc.required'] = 'Deskripsi Gambar Artikel 2 wajib diisi!';

                $rules['article_image_1_capt'] = 'required';
                $data['article_image_1_capt'] = $request->article_image_1_capt;
                $message['article_image_1_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_capt'] = 'required';
                $data['article_image_2_capt'] = $request->article_image_2_capt;
                $message['article_image_2_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';
                $image_num = 2;
                break;

            case '3_img':
                $rules['article_image_1_desc'] = 'required';
                $data['article_image_1_desc'] = $request->article_image_1_desc;
                $message['article_image_1_desc.required'] = 'Deskripsi Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_desc'] = 'required';
                $data['article_image_2_desc'] = $request->article_image_2_desc;
                $message['article_image_2_desc.required'] = 'Deskripsi Gambar Artikel 2 wajib diisi!';

                $rules['article_image_3_desc'] = 'required';
                $data['article_image_3_desc'] = $request->article_image_3_desc;
                $message['article_image_3_desc.required'] = 'Deskripsi Gambar Artikel 3 wajib diisi!';

                $rules['article_image_1_capt'] = 'required';
                $data['article_image_1_capt'] = $request->article_image_1_capt;
                $message['article_image_1_capt.required'] = 'Caption Gambar Artikel 1 wajib diisi!';

                $rules['article_image_2_capt'] = 'required';
                $data['article_image_2_capt'] = $request->article_image_2_capt;
                $message['article_image_2_capt.required'] = 'Caption Gambar Artikel 2 wajib diisi!';

                $rules['article_image_3_capt'] = 'required';
                $data['article_image_3_capt'] = $request->article_image_3_capt;
                $message['article_image_3_capt.required'] = 'Caption Gambar Artikel 3 wajib diisi!';
                $image_num = 3;
                break;

            default:

                break;
        }

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); // To repopulate the form fields with the old input
        }

        $article_tag = json_decode($request->article_tag);
        $article_tag_db = ArticleTag::where('id_article', $id)->get();
        $delete_tag = true;

        foreach ($article_tag_db as $data) {
            $delete_tag = true;
            foreach ($article_tag as $data_input) {
                if ($data->id_tag == $data_input->id) {
                    $delete_tag = false;
                    break;
                }
            }
            if ($delete_tag) $data->delete();
        }

        foreach ($article_tag as $data) {

            $checkTag = ArticleTag::where('id_tag', $data->id)->where('id_article', $id)->get();

            if (count($checkTag) == 0) {
                ArticleTag::create([
                    'id_article' => $id,
                    'id_tag' => $data->id
                ]);
            }
        }

        // Update gambar
        for ($i = 1; $i < $image_num + 1; $i++) {
            $article_image = ArticleImage::where('id_artikel', $id)->where('num', $i)->first();

            if ($request['article_image_' . $i] != null) {
                $new_img = $request->file('article_image_' . $i);
                $old_path = public_path('images/database/article/' . $article_image->path);

                if (File::exists($old_path)) {
                    File::delete($old_path);

                    $new_img_name = time() . '_image' . $i . 'article_' . $new_img->getClientOriginalName();
                    $new_path = public_path('images/database/article/');
                    $new_img->move($new_path, $new_img_name);

                    $article_image->update([
                        'path' => $new_img_name,
                        'caption' => $request['article_image_' . $i . '_capt'],
                        'image_desc' => $request['article_image_' . $i . '_desc']
                    ]);
                } else {
                    dd('Image not found', $article_image->path);
                }
            } else {
                $article_image->update([
                    'caption' => $request['article_image_' . $i . '_capt'],
                    'image_desc' => $request['article_image_' . $i . '_desc']
                ]);
            }
        }

        $article = Article::find($id);

        if ($request->thumbnail != null) {
            $new_img = $request->file('thumbnail');
            $old_path = public_path('images/database/article/' . $article->thumbnail);

            if (File::exists($old_path)) {
                File::delete($old_path);

                $new_img_name = time() . '_thumbnailImg_' . $new_img->getClientOriginalName();
                $new_path = public_path('images/database/article/');
                $new_img->move($new_path, $new_img_name);

                $article->update([
                    'thumbnail' => $new_img_name,
                ]);
            } else {
                dd('Image not found', $article->path);
            }
        }

        $article_image = ArticleImage::where('id_artikel', $id)->get();

        $result = $this->setIsiArticle($request['isi'], $article_image);

        $article->update([
            'penulis' => $request['penulis'],
            'judul' => $request['judul'],
            'isi' => $result,
            'thumbnail_desc' => $request['thumbnail_desc'],
            'thumbnail_caption' => $request['thumbnail_caption'],
        ]);

        return redirect()->route('article.index', ['data_per_page' => '10', 'status' => 'Success']);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        $allImage = ArticleImage::where('id_artikel', $article->id)->get();

        $checkAllImage = $this->checkAllImage($allImage, $article);

        if ($checkAllImage['status']) {
            foreach ($allImage as $img_data) {
                $old_path = public_path('images/database/article/' . $img_data->path);

                File::delete($old_path);
                $img_data->delete();
            }
        } else {

            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $checkAllImage['image']
            ], 404);
        }

        ArticleTag::where('id_article', $id)->delete();

        $old_path = public_path('images/database/article/' . $article->thumbnail);

        if (File::exists($old_path)) {
            $article->delete();
            File::delete($old_path);

            return response()->json([
                'status' => 'Success',
                'message' => 'Data deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Image Not Found!: ' . $article->thumbnail
            ], 404);
        }
    }

    public function checkAllImage($allImage, $article)
    {
        $old_path = public_path('images/database/article/' . $article->thumbnail);

        if (!File::exists($old_path)) {
            return [
                'status' => false,
                'image' => $article->thumbnail,
            ];
        }

        foreach ($allImage as $img_data) {
            $old_path = public_path('images/database/article/' . $img_data->path);

            if (!File::exists($old_path)) {
                return [
                    'status' => false,
                    'image' => $img_data->path
                ];
            }
        }

        return [
            'status' => true,
            'image' => 'Found All'
        ];
    }

    public function search($value)
    {

        $result = Article::where('penulis', 'like', '%' . $value . '%')
            ->orWhere('judul', 'like', '%' . $value . '%')
            ->orWhere('isi', 'like', '%' . $value . '%')
            ->orWhere('thumbnail', 'like', '%' . $value . '%')
            ->get();

        foreach ($result as $article_data) {
            $article_data->tag = ArticleTag::where('id_article', $article_data->id)->get();
            foreach ($article_data->tag as $tag_data) {
                $tag_data->detail = Tag::find($tag_data->id_tag);
            }
        }

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

    public function updateHighlight($id, $value)
    {

        $highlightedArticle = Article::where('highlighted', 1)->get();

        if ($value == 1) {

            if (count($highlightedArticle) == 5) {
                return response()->json([
                    'status' => 'Failed',
                    'count_highlighted' => count($highlightedArticle),
                    'message' => 'Update highlight failed: Already maximum article highlighted',
                ]);
            }
        }

        $article = Article::find($id);
        
        $article->update([
            'highlighted' => $value,
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Update highlight success!',
            'value_update' => $value
        ], 200);
    }
}
