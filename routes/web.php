<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\AstrologerCategoryController;
use App\Http\Controllers\Admin\HomeServiceController;
use App\Http\Controllers\Admin\AstrologerPageController;
use App\Http\Controllers\Admin\AstrologerPageItemController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\LoveCalculatorContentController;
use App\Http\Controllers\Admin\LoveCalculatorFaqController;
use App\Http\Controllers\Admin\NumerologyCalculatorContentController;
use App\Http\Controllers\Admin\NumerologyCalculatorFaqController;
use App\Http\Controllers\Admin\RisingAscendantCalculatorContentController;
use App\Http\Controllers\Admin\DashaCalculatorContentController;
use App\Models\AstrologerPage;
use App\Models\AstrologerPageItem;
use App\Helpers\CompatibilityHelper;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\CompatibilityController;
use App\Http\Controllers\ChatWithAstrologerController;
use App\Http\Controllers\TalkToAstrologerController;
use App\Http\Controllers\LoveCalculaterController;
use App\Http\Controllers\NumberologyCalculatorController;
use App\Http\Controllers\RisingAscendantSignController;
use App\Http\Controllers\DashaCalculatorController;
use App\Http\Controllers\MangalDoshaCalculatorController;
use App\Http\Controllers\MoonPhaseCalculatorController;
use App\Http\Controllers\TransitChartCalculatorController;
use App\Http\Controllers\MulankCalculatorController;
use App\Http\Controllers\AgeCalculatorController;
use App\Http\Controllers\KundliCalculatorController;
use App\Http\Controllers\NumerologyToolsController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/clear', function () {

    // Clear application cache
    Artisan::call('cache:clear');

    // Clear configuration cache
    Artisan::call('config:clear');

    // Clear route cache
    Artisan::call('route:clear');

    // Clear compiled Blade/view cache
    Artisan::call('view:clear');

    // Clear event cache
    Artisan::call('event:clear');

    // Clear all Laravel optimization caches
    Artisan::call('optimize:clear');

    return response()->json([
        'success' => true,
        'message' => 'All Laravel cache and optimization files cleared successfully.',
    ]);
});



Route::post('/save-subscriber', [SubscriberController::class, 'store'])->name('subscriber.save');
Route::get('/firebase-messaging-sw.js', [SubscriberController::class, 'serviceWorker'])->name('firebase.sw');




// Frontend Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/horoscope/{period}-horoscope', [HoroscopeController::class, 'landing'])
    ->where('period', 'daily|tomorrow|weekly|monthly|yearly')->name('horoscope.landing');
Route::get('/horoscope/{period}-horoscope/{sign}', [HoroscopeController::class, 'detail'])
    ->where('period', 'daily|tomorrow|weekly|monthly|yearly')->name('horoscope.detail');
Route::get('/horoscope/{sign?}', [HoroscopeController::class, 'legacy'])->name('horoscope');
Route::get('/chat-with-astrologers', [ChatWithAStrologerController::class, 'index'])->name('chat-with-astrologers');
Route::get('/talk-to-astrologers', [TalkToAStrologerController::class, 'index'])->name('talk-to-astrologers');
Route::get('/love-calculator', [LoveCalculaterController::class, 'index'])->name('love-calculator');
Route::get('/love-report', [LoveCalculaterController::class, 'report'])->name('love-report');
Route::get('/numerology-calculator', [NumberologyCalculatorController::class, 'index'])->name('numerology-calculator');
Route::get('/numerology-report', [NumberologyCalculatorController::class, 'report'])->name('numerology-report');
Route::get('/rising-ascendant-sign-calculator', [RisingAscendantSignController::class, 'index'])->name('rising-ascendant-sign-calculator');
Route::get('/rising-ascendant-sign-report', [RisingAscendantSignController::class, 'report'])->name('rising-ascendant-sign-report');
Route::get('/place-search', [RisingAscendantSignController::class, 'places'])->name('place-search');
Route::get('/dasha-calculator', [DashaCalculatorController::class, 'index'])->name('dasha-calculator');
Route::get('/dasha-calculator-report', [DashaCalculatorController::class, 'report'])->name('dasha-calculator-report');
Route::get('/mangal-dosha-calculator', [MangalDoshaCalculatorController::class, 'index'])->name('mangal-dosha-calculator');
Route::get('/mangal-dosha-report', [MangalDoshaCalculatorController::class, 'report'])->name('mangal-dosha-report');
Route::get('/moon-phase-calculator', [MoonPhaseCalculatorController::class, 'index'])->name('moon-phase-calculator');
Route::get('/moon-phase-calculator-report', [MoonPhaseCalculatorController::class, 'report'])->name('moon-phase-calculator-report');
Route::get('/transit-chart-calculator', [TransitChartCalculatorController::class, 'index'])->name('transit-chart-calculator');
Route::get('/transit-chart-report', [TransitChartCalculatorController::class, 'report'])->name('transit-chart-report');
Route::get('/mulank-calculator', [MulankCalculatorController::class, 'index'])->name('mulank-calculator');
Route::get('/mulank-report', [MulankCalculatorController::class, 'report'])->name('mulank-report');
Route::get('/age-calculator', [AgeCalculatorController::class, 'index'])->name('age-calculator');
Route::get('/age-report', [AgeCalculatorController::class, 'report'])->name('age-report');

// Free Services ke static pages (abhi sirf HTML hai)
Route::view('/free-kundli', 'free-kundli')->name('free-kundli');
Route::view('/kundli-matching', 'kundli-matching')->name('kundli-matching');
Route::view('/compatibility', 'compatibility')->name('compatibility');
Route::get('/compatibility/{sign}', [CompatibilityController::class, 'sign'])
    ->where('sign', CompatibilityHelper::slugs())->name('compatibility.sign');
Route::get('/compatibility/{sign}/{partner}', [CompatibilityController::class, 'pair'])
    ->where(['sign' => CompatibilityHelper::slugs(), 'partner' => CompatibilityHelper::slugs()])->name('compatibility.pair');
Route::view('/tarot', 'tarot')->name('tarot');

// Birth-detail calculators: form page + report page
Route::view('/atmakaraka-darakaraka-calculator', 'atmakaraka-darakaraka-calculator')->name('atmakaraka-darakaraka-calculator');
Route::get('/atmakaraka-darakaraka-report', [KundliCalculatorController::class, 'atmakarakaDarakaraka'])->name('atmakaraka-darakaraka-report');
Route::view('/sun-sign-calculator', 'sun-sign-calculator')->name('sun-sign-calculator');
Route::get('/sun-sign-report', [KundliCalculatorController::class, 'sunSign'])->name('sun-sign-report');
Route::view('/rashi-calculator', 'rashi-calculator')->name('rashi-calculator');
Route::get('/rashi-report', [KundliCalculatorController::class, 'rashi'])->name('rashi-report');
Route::view('/nakshatra-calculator', 'nakshatra-calculator')->name('nakshatra-calculator');
Route::get('/nakshatra-report', [KundliCalculatorController::class, 'nakshatra'])->name('nakshatra-report');
Route::view('/shani-sade-sati-calculator', 'shani-sade-sati-calculator')->name('shani-sade-sati-calculator');
Route::get('/shani-sade-sati-report', [KundliCalculatorController::class, 'sadeSati'])->name('shani-sade-sati-report');
Route::view('/birth-chart-calculator', 'birth-chart-calculator')->name('birth-chart-calculator');
Route::get('/birth-chart-report', [KundliCalculatorController::class, 'birthChart'])->name('birth-chart-report');
Route::view('/kaal-sarp-dosh-calculator', 'kaal-sarp-dosh-calculator')->name('kaal-sarp-dosh-calculator');
Route::get('/kaal-sarp-dosh-report', [KundliCalculatorController::class, 'kaalSarpDosh'])->name('kaal-sarp-dosh-report');
Route::view('/ishta-devata-calculator', 'ishta-devata-calculator')->name('ishta-devata-calculator');
Route::get('/ishta-devata-report', [KundliCalculatorController::class, 'ishtaDevata'])->name('ishta-devata-report');

// Name and number calculators: form page + report page
Route::view('/flames-calculator', 'flames-calculator')->name('flames-calculator');
Route::get('/flames-report', [NumerologyToolsController::class, 'flames'])->name('flames-report');
Route::view('/friendship-calculator', 'friendship-calculator')->name('friendship-calculator');
Route::get('/friendship-report', [NumerologyToolsController::class, 'friendship'])->name('friendship-report');
Route::view('/name-compatibility-calculator', 'name-compatibility-calculator')->name('name-compatibility-calculator');
Route::get('/name-compatibility-report', [NumerologyToolsController::class, 'nameCompatibility'])->name('name-compatibility-report');
Route::view('/destiny-number-calculator', 'destiny-number-calculator')->name('destiny-number-calculator');
Route::get('/destiny-number-report', [NumerologyToolsController::class, 'destinyNumber'])->name('destiny-number-report');
Route::view('/lo-shu-grid-calculator', 'lo-shu-grid-calculator')->name('lo-shu-grid-calculator');
Route::get('/lo-shu-grid-report', [NumerologyToolsController::class, 'loShuGrid'])->name('lo-shu-grid-report');
Route::view('/mobile-number-numerology-calculator', 'mobile-number-numerology-calculator')->name('mobile-number-numerology-calculator');
Route::get('/mobile-number-numerology-report', [NumerologyToolsController::class, 'mobileNumber'])->name('mobile-number-numerology-report');
Route::view('/lucky-vehicle-number-calculator', 'lucky-vehicle-number-calculator')->name('lucky-vehicle-number-calculator');
Route::get('/lucky-vehicle-number-report', [NumerologyToolsController::class, 'vehicleNumber'])->name('lucky-vehicle-number-report');
Route::view('/lucky-name-numerology-calculator', 'lucky-name-numerology-calculator')->name('lucky-name-numerology-calculator');
Route::get('/lucky-name-numerology-report', [NumerologyToolsController::class, 'luckyName'])->name('lucky-name-numerology-report');

// Authentication Routes (Manual)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Protected Routes (Sirf login kiye hue admin ke liye)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Hero Section Routes
    Route::get('/hero-section', [HeroSectionController::class, 'index'])->name('hero_section.index');
    Route::get('/hero-section/create', [HeroSectionController::class, 'create'])->name('hero_section.create');
    Route::post('/hero-section/store', [HeroSectionController::class, 'store'])->name('hero_section.store');
    Route::get('/hero-section/edit/{id}', [HeroSectionController::class, 'edit'])->name('hero_section.edit');
    Route::put('/hero-section/update/{id}', [HeroSectionController::class, 'update'])->name('hero_section.update');
    Route::get('/hero-section/delete/{id}', [HeroSectionController::class, 'delete'])->name('hero_section.delete');

    // Browse by Category Routes
    Route::get('/astrologer-category', [AstrologerCategoryController::class, 'index'])->name('astrologer_category.index');
    Route::get('/astrologer-category/create', [AstrologerCategoryController::class, 'create'])->name('astrologer_category.create');
    Route::post('/astrologer-category/store', [AstrologerCategoryController::class, 'store'])->name('astrologer_category.store');
    Route::get('/astrologer-category/edit/{id}', [AstrologerCategoryController::class, 'edit'])->name('astrologer_category.edit');
    Route::put('/astrologer-category/update/{id}', [AstrologerCategoryController::class, 'update'])->name('astrologer_category.update');
    Route::get('/astrologer-category/delete/{id}', [AstrologerCategoryController::class, 'delete'])->name('astrologer_category.delete');

    // Our Services Routes
    Route::get('/home-service', [HomeServiceController::class, 'index'])->name('home_service.index');
    Route::get('/home-service/create', [HomeServiceController::class, 'create'])->name('home_service.create');
    Route::post('/home-service/store', [HomeServiceController::class, 'store'])->name('home_service.store');
    Route::get('/home-service/edit/{id}', [HomeServiceController::class, 'edit'])->name('home_service.edit');
    Route::put('/home-service/update/{id}', [HomeServiceController::class, 'update'])->name('home_service.update');
    Route::get('/home-service/delete/{id}', [HomeServiceController::class, 'delete'])->name('home_service.delete');

    // Push Notification Routes (Firebase)
    Route::get('/push-notification', [PushNotificationController::class, 'index'])->name('push_notification.index');
    Route::get('/push-notification/create', [PushNotificationController::class, 'create'])->name('push_notification.create');
    Route::post('/push-notification/store', [PushNotificationController::class, 'store'])->name('push_notification.store');
    Route::get('/push-notification/delete/{id}', [PushNotificationController::class, 'delete'])->name('push_notification.delete');

    // Love Calculator Page Routes
    Route::get('/love-calculator/content', [LoveCalculatorContentController::class, 'edit'])->name('love_calculator.content.edit');
    Route::put('/love-calculator/content/update', [LoveCalculatorContentController::class, 'update'])->name('love_calculator.content.update');
    Route::get('/love-calculator/report', [LoveCalculatorContentController::class, 'reportEdit'])->name('love_calculator.report.edit');
    Route::put('/love-calculator/report/update', [LoveCalculatorContentController::class, 'reportUpdate'])->name('love_calculator.report.update');

    // FAQs
    Route::get('/love-calculator/faq', [LoveCalculatorFaqController::class, 'index'])->name('love_calculator.faq.index');
    Route::get('/love-calculator/faq/create', [LoveCalculatorFaqController::class, 'create'])->name('love_calculator.faq.create');
    Route::post('/love-calculator/faq/store', [LoveCalculatorFaqController::class, 'store'])->name('love_calculator.faq.store');
    Route::get('/love-calculator/faq/edit/{id}', [LoveCalculatorFaqController::class, 'edit'])->name('love_calculator.faq.edit');
    Route::put('/love-calculator/faq/update/{id}', [LoveCalculatorFaqController::class, 'update'])->name('love_calculator.faq.update');
    Route::get('/love-calculator/faq/delete/{id}', [LoveCalculatorFaqController::class, 'delete'])->name('love_calculator.faq.delete');

    // Numerology Calculator Page Routes
    Route::get('/numerology-calculator/content', [NumerologyCalculatorContentController::class, 'edit'])->name('numerology_calculator.content.edit');
    Route::put('/numerology-calculator/content/update', [NumerologyCalculatorContentController::class, 'update'])->name('numerology_calculator.content.update');
    Route::get('/numerology-calculator/report', [NumerologyCalculatorContentController::class, 'reportEdit'])->name('numerology_calculator.report.edit');
    Route::put('/numerology-calculator/report/update', [NumerologyCalculatorContentController::class, 'reportUpdate'])->name('numerology_calculator.report.update');

    // Numerology Calculator FAQ Routes
    Route::get('/numerology-calculator/faq', [NumerologyCalculatorFaqController::class, 'index'])->name('numerology_calculator.faq.index');
    Route::get('/numerology-calculator/faq/create', [NumerologyCalculatorFaqController::class, 'create'])->name('numerology_calculator.faq.create');
    Route::post('/numerology-calculator/faq/store', [NumerologyCalculatorFaqController::class, 'store'])->name('numerology_calculator.faq.store');
    Route::get('/numerology-calculator/faq/edit/{id}', [NumerologyCalculatorFaqController::class, 'edit'])->name('numerology_calculator.faq.edit');
    Route::put('/numerology-calculator/faq/update/{id}', [NumerologyCalculatorFaqController::class, 'update'])->name('numerology_calculator.faq.update');
    Route::get('/numerology-calculator/faq/delete/{id}', [NumerologyCalculatorFaqController::class, 'delete'])->name('numerology_calculator.faq.delete');


    //Rising Ascendant Sign Calculator Page Routes
    Route::get('/rising-ascendant-calculator/content', [RisingAscendantCalculatorContentController::class, 'edit'])->name('rising-ascendant-calculator.content.edit');
    Route::put('/rising-ascendant-calculator/content/update', [RisingAscendantCalculatorContentController::class, 'update'])->name('rising-ascendant-calculator.content.update');
    Route::get('/rising-ascendant-calculator/report', [RisingAscendantCalculatorContentController::class, 'reportEdit'])->name('rising-ascendant-calculator.report.edit');
    Route::put('/rising-ascendant-calculator/report/update', [RisingAscendantCalculatorContentController::class, 'reportUpdate'])->name('rising-ascendant-calculator.report.update');


    //Dasha Calculator Page Routes
    Route::get('/dasha-calculator/content', [DashaCalculatorContentController::class, 'edit'])->name('dasha-calculator.content.edit');
    Route::put('/dasha-calculator/content/update', [DashaCalculatorContentController::class, 'update'])->name('dasha-calculator.content.update');
    Route::get('/dasha-calculator/report', [DashaCalculatorContentController::class, 'reportEdit'])->name('dasha-calculator.report.edit');
    Route::put('/dasha-calculator/report/update', [DashaCalculatorContentController::class, 'reportUpdate'])->name('dasha-calculator.report.update');



















    // Chat with Astrologers / Talk to Astrologers Page Routes ({page} = chat | talk)
    Route::prefix('astrologer-page/{page}')->name('astrologer_page.')->where([
        'page'    => implode('|', array_keys(AstrologerPage::PAGES)),
        'section' => implode('|', array_keys(AstrologerPageItem::SECTIONS)),
    ])->group(function () {
        // Hero + section headings
        Route::get('/', [AstrologerPageController::class, 'edit'])->name('edit');
        Route::put('/update', [AstrologerPageController::class, 'update'])->name('update');

        // Cards, steps, topics, tabs, FAQs ({section} = feature | verify_step | topic | service_tab | faq)
        Route::get('/{section}', [AstrologerPageItemController::class, 'index'])->name('items.index');
        Route::get('/{section}/create', [AstrologerPageItemController::class, 'create'])->name('items.create');
        Route::post('/{section}/store', [AstrologerPageItemController::class, 'store'])->name('items.store');
        Route::get('/{section}/edit/{id}', [AstrologerPageItemController::class, 'edit'])->name('items.edit');
        Route::put('/{section}/update/{id}', [AstrologerPageItemController::class, 'update'])->name('items.update');
        Route::get('/{section}/delete/{id}', [AstrologerPageItemController::class, 'delete'])->name('items.delete');
    });
});
