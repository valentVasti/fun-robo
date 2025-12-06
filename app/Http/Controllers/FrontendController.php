<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;

use App\Models\Awards;
use App\Models\AwardsImage;
use App\Models\Testimoni;
use App\Models\Faq;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\ArticleTag;
use App\Models\Tag;
use App\Models\Branch;
use App\Models\AboutUsData;
use App\Models\Curriculum;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Stichoza\GoogleTranslate\GoogleTranslate;
use DOMDocument;

class FrontendController extends Controller
{
    public function home()
    {
        $awards = Awards::with('img')->get();
        $awardsimage = AwardsImage::all();
        $testimoni = Testimoni::all();
        $curriculum = Curriculum::all();
        $benefit = Benefit::all();
        $about = AboutUsData::where('type', 'homeText')->first();
        $popularArticle = Article::with('tags')->where('highlighted', 1)->get();
        $tag = Tag::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        foreach ($popularArticle as $data) {
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($data->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $paragraphs = $dom->getElementsByTagName('p');
            if ($paragraphs->length > 0) {
                $data->isi = $paragraphs->item(0)->nodeValue;
            } else {
                $data->isi = '';
            }

            $data->tag = ArticleTag::where('id_article', $data->id)->get();
            foreach ($data->tag as $tag_data) {
                $tag_data->detail = Tag::find($tag_data->id_tag);
            }
        }

        foreach ($awards as $data) {
            $data->img = AwardsImage::where('id_awards', $data->id)->get();
        }

        $locale = app()->getLocale();

        if ($locale == 'en') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget('en');

            foreach ($awards as $data) {
                $data->achievement = $tr->translate($data->achievement);
            }

            foreach ($testimoni as $data) {
                $data->isi_testimoni = $tr->translate($data->isi_testimoni);
                $data->keterangan_testimoni = $tr->translate($data->keterangan_testimoni);
            }

            foreach ($popularArticle as $data) {
                $data->judul = $tr->translate($data->judul);
                $data->isi = $tr->translate($data->isi);
            }

            foreach ($tag as $data) {
                $data->tag_name = $tr->translate($data->tag_name);
            }

            foreach ($benefit as $data) {
                $data->benefit = $tr->translate($data->benefit);
            }

            $about->content = $tr->translate($about->content);

            $title = "Home";
        } else {
            $title = "Beranda";
        }


        return view('frontend.home', compact('awards', 'testimoni', 'title', 'popularArticle', 'curriculum', 'benefit', 'about', 'main_kontak'));
    }

    public function curriculum()
    {
        $curriculum = Curriculum::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $locale = app()->getLocale();
        $title = "a";

        $tr = new GoogleTranslate('id');
        $tr->setTarget('en');

        foreach ($curriculum as $data) {

            if ($locale == "en") {
                $data->description = $tr->translate($data->description);
                $data->details = $tr->translate($data->details);
            }

            $content = [];
            $contentText = strip_tags($data->details, '<p><ul><li>');
            $lines = explode("\n", $data->details);

            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    if (strpos($line, '<ul>') === 0) {
                        $listItems = [];
                        while (($line = trim(array_shift($lines))) !== '</ul>') {
                            if (strpos($line, '<li>') === 0) {
                                $listItems[] = $line;
                            }
                        }
                        $content[] = ['type' => 'list', 'items' => $listItems];
                    } else {
                        $content[] = ['type' => 'paragraph', 'text' => $line];
                    }
                }
            }

            $data->content = $content;
        }


        if ($locale == "en" ? $title = "Curriculum" : $title = "Kurikulum");

        return view('frontend.curriculum', compact('title', 'curriculum', 'main_kontak'));
    }

    public function about()
    {
        $about = AboutUsData::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $pluckContent = [
            'mascot1Content' => AboutUsData::where('type', 'mascot1')->pluck('content')->first(),
            'mascot2Content' => AboutUsData::where('type', 'mascot2')->pluck('content')->first(),
            'longTextContent' => AboutUsData::where('type', 'longText')->pluck('content')->first(),
            'shortTextContent' => AboutUsData::where('type', 'shortText')->pluck('content')->first(),
            'image1Content' => AboutUsData::where('type', 'image1')->pluck('content')->first(),
            'image2Content' => AboutUsData::where('type', 'image2')->pluck('content')->first(),
            'landingImageContent' => AboutUsData::where('type', 'landingImage')->pluck('content')->first(),
        ];

        $locale = app()->getLocale();
        $title = "";

        if ($locale == "en" ? $title = "About Us" : $title = "Tentang Kami");

        return view('frontend.about', compact('title', 'about', 'main_kontak') + $pluckContent);
    }

    public function article()
    {
        $tag = Tag::all();
        $article = Article::all();
        $articleTag = ArticleTag::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $popularArticle = Article::with('ArticleTags.tag')->where('highlighted', 1)->get();

        $newestArticle = collect($article)->sortByDesc(function ($article) {
            return $article->created_at;
        })->first();
        $newestArticle->tag = ArticleTag::where('id_article', $newestArticle->id)->get();
        foreach ($newestArticle->tag as $tag_data) {
            $tag_data->detail = Tag::find($tag_data->id_tag);
        }

        $locale = app()->getLocale();

        if ($locale == 'en') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget('en');

            foreach ($tag as $data) {
                $data->tag_name = $tr->translate($data->tag_name);
            }

            foreach ($article as $data) {
                $data->judul = $tr->translate($data->judul);
                $data->isi = $tr->translate($data->isi);
                $data->thumbnail_caption = $tr->translate($data->thumbnail_caption);
            }
        }

        foreach ($article as $data) {

            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($data->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $paragraphs = $dom->getElementsByTagName('p');
            if ($paragraphs->length > 0) {
                $data->isi = $paragraphs->item(0)->nodeValue;
            } else {
                $data->isi = '';
            }

            $data->tag = ArticleTag::where('id_article', $data->id)->get();
            foreach ($data->tag as $tag_data) {
                $tag_data->detail = Tag::find($tag_data->id_tag);
            }
        }

        $title = "";

        if ($locale == "en" ? $title = "Article" : $title = "Artikel");

        return view('frontend.article', compact('article', 'articleTag', 'tag', 'title', 'popularArticle', 'newestArticle', 'main_kontak'));
    }

    public function getArticles($locale, $id)
    {
        $articleArr = ArticleTag::where('id_tag', $id)->get();
        $result = [];

        $locale = app()->getLocale();

        $tr = new GoogleTranslate('id');
        $tr->setTarget('en');

        foreach ($articleArr as $data) {
            $articleData = Article::find($data->id_article);

            if ($locale == 'en') {
                $articleData->judul = $tr->translate($articleData->judul);
                $articleData->isi = $tr->translate($articleData->isi);
                $articleData->thumbnail_caption = $tr->translate($articleData->thumbnail_caption);
            }

            array_push($result, $articleData);
        }

        return response()->json([
            'article_data' => $result
        ]);
    }

    public function articleDetail($locale, $id)
    {
        $article = Article::find($id);
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $popularArticle = Article::where('highlighted', 1)->get();
        foreach ($popularArticle as $data) {
            $data->tag = ArticleTag::where('id_article', $data->id)->get();
            foreach ($data->tag as $tag_data) {
                $tag_data->detail = Tag::find($tag_data->id_tag);
            }
        }

        if ($locale == 'en') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget('en');

            $article->judul = $tr->translate($article->judul);
            $article->isi = $tr->translate($article->isi);
            $article->thumbnail_caption = $tr->translate($article->thumbnail_caption);
        }

        // dd($article->isi);

        $title = $article->judul;

        return view('frontend.article-detail', compact('article', 'title', 'popularArticle', 'main_kontak'));
    }

    public function awards()
    {
        $awards = Awards::with('img')->get();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $locale = app()->getLocale();
        if ($locale == 'en') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget('en');

            foreach ($awards as $data) {
                $data['achievement'] = $tr->translate($data->achievement);
            }
        }

        $awards = $awards->sortByDesc('year');

        $locale = app()->getLocale();
        $title = "";

        if ($locale == "en" ? $title = "Awards" : $title = "Penghargaan");

        return view('frontend.awards', compact('awards', 'title', 'main_kontak'));
    }

    public function branch()
    {
        $branch = Branch::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $locale = app()->getLocale();
        $title = "";

        if ($locale == "en" ? $title = "Contact" : $title = "Kontak");

        // dd($branch);
        return view('frontend.branch', compact('branch', 'title', 'main_kontak'));
    }

    public function gallery()
    {
        $foldersPath = File::directories(public_path('images/database'));
        $main_kontak = Branch::where('nama_branch', 'kantor Pusat')->first();
        $filesArr = [];

        foreach ($foldersPath as $folder) {
            if ($folder != public_path('images/database\aboutUs')) {
                $files = File::files($folder);
                foreach ($files as $file) {
                    array_push($filesArr, basename(File::dirname($file->getPathname())) . "/" . $file->getFilename());
                }
            }
        }

        $locale = app()->getLocale();
        $title = "";

        if ($locale == "en" ? $title = "Gallery" : $title = "Galeri");

        return view('frontend.gallery', compact('filesArr', 'title', 'main_kontak'));
    }

    public function faq()
    {
        $faq = Faq::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $locale = app()->getLocale();

        if ($locale == 'en') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget('en');

            foreach ($faq as $data) {
                $data->question = $tr->translate($data->question);
                $data->answer = $tr->translate($data->answer);
            }
        }

        $title = "FAQ";

        return view('frontend.faq', compact('faq', 'title', 'main_kontak'));
    }

    public function testimoni()
    {
        $testimoni = Testimoni::all();
        $main_kontak = Branch::where('nama_branch', 'Kantor Pusat')->first();

        $locale = app()->getLocale();

        if ($locale == 'en') {
            $tr = new GoogleTranslate('id');
            $tr->setTarget('en');

            foreach ($testimoni as $data) {
                $data->isi_testimoni = $tr->translate($data->isi_testimoni);
                $data->keterangan_testimoni = $tr->translate($data->keterangan_testimoni);
            }
        }

        $locale = app()->getLocale();
        $title = "";

        if ($locale == "en" ? $title = "Testimonial" : $title = "Testimoni");

        return view('frontend.testimoni', compact('testimoni', 'title', 'main_kontak'));
    }

    public function changeLanguage($selectedLanguage)
    {
        App::setLocale($selectedLanguage);

        // if ($selectedLanguage == 'en') {
        //     $url = str_replace('id', $selectedLanguage, URL::previous());
        // } else {
        //     $url = str_replace('en', $selectedLanguage, URL::previous());
        // }

        $url = preg_replace('/\/[a-z]{2}\//', '/' . $selectedLanguage . '/', URL::previous(), 1);

        return response()->json([
            'status' => 'success',
            'locale_set' => app()->getLocale(),
            'url' => $url,
        ], 200);
    }

    public function getSessionLanguage()
    {
        return response()->json(
            app()->getLocale(),
            200
        );
    }
}
