<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\CSSItem;
use App\EPASItem;
use App\User;
use App\BorrowItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        error_reporting(0);
        
        // Admin
        $css_count = count(CSSItem::get());
        $epas_count = count(EPASItem::get());
        $user_count = count(User::where('is_admin', 0)->get());
        $css_user_count = count(User::where('is_css', 1)->get());
        $epas_user_count = count(User::where('is_epas', 1)->get());
        $defective_css_count = CSSItem::where('item_status', 'Defective')->count();
        $defective_epas_count = EPASItem::where('item_status', 'Defective')->count();
        $borrowed_css_count = BorrowItem::where('category', 'CSS')->count();
        $borrowed_epas_count = BorrowItem::where('category', 'EPAS')->count();
        $admin_log_count = count(DB::table('audits')->get());
    
        view()->share('css_count', $css_count);
        view()->share('epas_count', $epas_count);
        view()->share('user_count', $user_count);
        view()->share('css_user_count', $css_user_count);
        view()->share('epas_user_count', $epas_user_count);
        view()->share('defective_css_count', $defective_css_count);
        view()->share('defective_epas_count', $defective_epas_count);
        view()->share('borrowed_css_count', $borrowed_css_count);
        view()->share('borrowed_epas_count', $borrowed_epas_count);
        view()->share('admin_log_count', $admin_log_count);

        view()->composer('*', function($view) {
            // EPAS User
            if (auth()->user() != null) {
                $borrowed_epas_user = BorrowItem::where('user_id', auth()->user()->id)
                    ->where('category', 'EPAS')
                    ->where('status','=', '2')
                    ->count();
                $returned_epas_user = BorrowItem::where('user_id', auth()->user()->id)
                    ->where('category', 'EPAS')
                    ->where('status', '4')
                    ->count();
            } else {
                $borrowed_epas_user = 0;
                $returned_epas_user = 0;
            }

            $epas_active_count = count(EPASItem::where('item_quantity','!=',0)->get());

            view()->share('borrowed_epas_user', $borrowed_epas_user);
            view()->share('returned_epas_user', $returned_epas_user);
            view()->share('epas_active_count', $epas_active_count);

            // CSS User
            if (auth()->user() != null) {
                $borrowed_css_user = BorrowItem::where('user_id', auth()->user()->id)
                    ->where('category', 'CSS')
                    ->where('status','=', '2')
                    ->count();
                $returned_css_user = BorrowItem::where('user_id', auth()->user()->id)
                    ->where('category', 'CSS')
                    ->where('status', '4')
                    ->count();
            } else {
                $borrowed_css_user = 0;
                $returned_css_user = 0;
            }

            $css_active_count = count(CSSItem::where('item_quantity','!=',0)->get());

            view()->share('borrowed_css_user', $borrowed_css_user);
            view()->share('returned_css_user', $returned_css_user);
            view()->share('css_active_count', $css_active_count);
        });

    }
}
