<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\LiveChannel;
use App\Models\OnlinePoll;
use App\Models\Photo;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Subscriber;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $total_category = Category::count();
        $total_subcategory = SubCategory::count();
        $total_news = Post::count();
        $total_photo = Photo::count();
        $total_video = Video::count();
        $total_faq = Faq::count();
        $total_poll = OnlinePoll::count();
        $total_channel = LiveChannel::count();
        $total_subscriber = Subscriber::where('status','Active')->count();

        return view('admin.home', compact('total_category','total_subcategory','total_news','total_photo','total_video','total_faq','total_poll','total_channel','total_subscriber'));
    }
}
