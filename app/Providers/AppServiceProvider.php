<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Setting;
use App\Models\SidebarAdvertisement;
use App\Models\SocialItem;
use App\Models\TopAdvertisement;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $top_ad_data = TopAdvertisement::where('id',1)->first();
        $sidebar_top_ad = SidebarAdvertisement::where('sidebar_ad_location','Top')->get();
        $sidebar_bottom_ad = SidebarAdvertisement::where('sidebar_ad_location','Bottom')->get();
        $categories = Category::with('rSubCategory')->where('show_on_menu','Show')->orderBy('category_order','asc')->get();
                
        $social_item_data = SocialItem::get();
        $setting_data = Setting::where('id',1)->first();
        $language_data = Language::get();
        $default_lang_data = Language::where('is_default','Yes')->first();

        view()->share('global_top_ad_data', $top_ad_data);
        view()->share('global_sidebar_top_ad', $sidebar_top_ad);
        view()->share('global_sidebar_bottom_ad', $sidebar_bottom_ad);
        view()->share('global_categories', $categories);
        view()->share('global_social_item_data', $social_item_data);
        view()->share('global_setting_data', $setting_data);
        view()->share('global_language_data', $language_data);
        view()->share('global_short_name', $default_lang_data->short_name);
    }
}
