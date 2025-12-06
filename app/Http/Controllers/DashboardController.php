<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Awards;
use App\Models\Branch;
use App\Models\ChangeLogs;
use App\Models\Faq;
use App\Models\Tag;
use App\Models\Testimoni;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function index()
    {
        $article = Article::all();
        $tag = Tag::all();
        $faq = Faq::all();
        $awards = Awards::all();
        $testimoni = Testimoni::all();
        $branch = Branch::all();

        $countData = [
            'article' => count($article),
            'tag' => count($tag),
            'faq' => count($faq),
            'awards' => count($awards),
            'testimoni' => count($testimoni),
            'branch' => count($branch)
        ];

        $article_last_changes = Article::orderBy('updated_at', 'desc')->first();
        $tag_last_changes = Tag::orderBy('updated_at', 'desc')->first();
        $faq_last_changes = Faq::orderBy('updated_at', 'desc')->first();
        $awards_last_changes = Awards::orderBy('updated_at', 'desc')->first();
        $testimoni_last_changes = Testimoni::orderBy('updated_at', 'desc')->first();
        $branch_last_changes = Branch::orderBy('updated_at', 'desc')->first();

        $lastChanges = [
            'article' => $article_last_changes->updated_at,
            'tag' => $tag_last_changes->updated_at,
            'faq' => $faq_last_changes->updated_at,
            'awards' => $awards_last_changes->updated_at,
            'testimoni' => $testimoni_last_changes->updated_at,
            'branch' => $branch_last_changes->updated_at,
        ];

        return view('backend.dashboard', [
            'activePage' => 'dashboard' // Set the active page to 'home'
        ], compact('countData', 'lastChanges'));
    }

    public function analytics()
    {
        $top_countries = Analytics::fetchTopCountries(Period::days(7));
        $visitors_page_views = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $total_visitors_page_views = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $most_visited_pages = Analytics::fetchMostVisitedPages(Period::days(7));
        $top_refferers = Analytics::fetchTopReferrers(Period::days(7));
        $user_types = Analytics::fetchUserTypes(Period::days(7));
        $top_browsers = Analytics::fetchTopBrowsers(Period::days(7));
        $operating_system = Analytics::fetchTopOperatingSystems(Period::days(7));

        // return response()->json([
        //     'top_countries' => $top_countries,
        //     'visitors_page_views' => $visitors_page_views,
        //     'total_visitors_page_views' => $total_visitors_page_views,
        //     'most_visited_pages' => $most_visited_pages,
        //     'top_refferers' => $top_refferers,
        //     'user_types' => $user_types,
        //     'top_browsers' => $top_browsers,
        //     'operating_systems' => $operating_system
        // ], 200, [], JSON_PRETTY_PRINT);

        return response()->json($top_countries, 200);
    }

    public function getChangeLog(){
        $change_log = ChangeLogs::orderBy('created_at', 'desc')->get();

        return response()->json($change_log, 200);
    }
}
