<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EndUserStatisticController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductStatisticConTroller;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserStatisticController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('/create', [AdminAuthController::class, 'store'])->name('store');

    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::middleware('cookie.sancAuth')->prefix('dashboard')->name('dashboard.')->group(function () {

        Route::get('/currentAdmin', [AdminAuthController::class, 'getCurrentAuthUser'])->name('admin');

        Route::controller(DashboardController::class)->prefix('coreStat')->name('coreStat.')->group(function () {

            Route::get('/revenue', 'getRevenue')->name('revenue');
            Route::get('/dailyRevenue', 'getDailyRevenue')->name('dailyRevenue');
            Route::get('/monthlyRevenue', 'getMonthlyRevenue')->name('monthlyRevenue');
            Route::get('/annualRevenue', 'getAnnualRevenue')->name('annualRevenue');
            Route::get('/monthGrowthRate', 'getMonthGrowthRate')->name('monthGrowthRate');
            Route::get('/quarterRevenue', 'getQuarterRevenue')->name('quarterRevenue');
            Route::get('/newUserCreatedEachMonth', "getNewUserInEachMonth")->name('newUserCreated');
            Route::get('/paidCustomerRatio', 'getPaidCustomerRatio')->name('paidCustomerRatio');
            Route::get('/trackVisitThisYear', 'getVisitThisYear')->name('visitThisYear');
            Route::get('/visitorsDeviceCount', 'getVisitorsDeviceCount')->name('visitorsDeviceCount');
            Route::get('/monthOverMonthGrowthRate', 'getMonthOverMonthGrowthRate')->name('monthOverMonthGrowthRate');
            Route::get('/topVisitMonths', 'getTopVisitMonths')->name('topVisitMonth');

            Route::prefix('userBehavior')->name('userBehavior')->group(function () {
                Route::get('/mostVisitedDay', 'getMostVisitedDay')->name('mostVisitedDay');
                Route::get('/mostViewedHour', 'getMostHourViewed');
                Route::get('/browserCount', 'getUserBrowserCount');
                Route::get('/bounceRate', 'getBounceRate');
                Route::get('/returnRate', 'getReturnRate');
            });
        });
        Route::controller(ProfileController::class)->prefix('profiles')->name('profiles.')->group(function () {
            Route::get('/detail', 'detail');
            Route::get('/profilesOwner', 'getProfilesOwner');
            Route::post('/create', 'create');
            Route::get('/avatarImg', 'getAvatarImg');
            Route::get('/profileImages', 'getProfileImages');
            Route::post('/update', 'update');
        });
        Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/new', 'getNew')->name('new');
            Route::get('/haveMostProducts', 'getHaveMostProducts')->name('categoriesHaveMostProducts');
            Route::get('/mostProfit', 'getMostProfit')->name('mostProfit');
            Route::get('/haveNoProducts', 'getHaveNoProducts')->name('haveNoProduct');
            Route::post('/', [CategoryController::class, 'create'])->name('create');
            Route::post('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::post('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
        });

        Route::controller(EndUserStatisticController::class)->prefix('users/statistic')->name('users.statistic')->group(function () {
            
            Route::get('/overview', [EndUserStatisticController::class, 'overview'])
            ->name('overview');

            Route::get('/roles', [EndUserStatisticController::class, 'roles'])
                ->name('roles');

            Route::get('/growth', [EndUserStatisticController::class, 'growth'])
                ->name('growth');

            Route::get('/recent', [EndUserStatisticController::class, 'recent'])
                ->name('recent');
        });

        Route::prefix('products')->name('products.')->group(function () {

            Route::controller(ProductStatisticController::class)
                ->prefix('statistics')
                ->name('statistics.')
                ->group(function () {

                    // Route::get('/top-selling', 'topSelling')->name('topSelling');
                    // Route::get('/most-profit', 'mostProfit')->name('mostProfit');
                    // Route::get('/trend', 'trend')->name('trend');
                    Route::get('/soldThisMonth/{id}', 'getSoldThisMonth');
                    Route::get('/conversionRate/{id}','getConversionRate');
                    Route::get('/productVisit/{id}', 'countProductVisit');
                    Route::get('/noRepeatedPurchasingUsers/{id}', 'countRepeatedPurchasingUsers');
                });

          
            Route::controller(ProductController::class)->group(function () {

                Route::post('/', 'store')->name('store');
                Route::get('/newProducts', 'getNewProducts')->name('newProducts');
                Route::get('/topSelling/{limit}', 'getTopSelling')->name('topSellingProducts');
                Route::get('/mostProfit', 'getMostProfit')->name('mostProfit');
                Route::get('/outOfStock', 'getOutOfStock')->name('outOfStock');
                Route::get('/topSellingTrend', 'getTopSellingTrend')->name('topSellingTrend'); //ok
                Route::get('/lowProfit/{limit}', 'getLowProfit')->name('lowProfit'); //ok

                Route::get('/{id}', 'detail')->name('detail');
                Route::post('/{id}', 'update')->name('update');
                Route::post('/{id}/delete', 'delete')->name('delete');
            });
        });

        // Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {

        //     Route::post('/', 'store')->name('store');
        //     Route::get('/newProducts', 'getNewProducts')->name('newProducts');
        //     Route::get('/topSelling/{limit}', 'getTopSelling')->name('topSellingProducts');
        //     Route::get('/mostProfit', 'getMostProfit')->name('mostProfit');
        //     Route::get('/outOfStock', 'getOutOfStock')->name("outOfStock");
        //     Route::get('/topSellingTrend', 'getTopSellingTrend')->name('topSellingTrend');
        //     Route::get('/lowProfit/{limit}', 'getLowProfit')->name('lowProfit');


        //     Route::get('/{id}', 'detail')->name('detail');
        //     Route::post('/{id}', 'update')->name('update');
        //     Route::post('/{id}/delete', 'delete')->name('delete');
        // });


        Route::controller(ProductImageController::class)->prefix('productImages')->name('productImages.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'detail')->name('detail');
            Route::post('/{id}', 'update')->name('update');
            Route::post('/{id}/delete', 'delete')->name('delete');
        });
    });
});
