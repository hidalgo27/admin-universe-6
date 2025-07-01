<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//ADMINISTRADOR
Auth::routes();
Route::get('/home', 'Admin\HomeController@index')->name('home')->middleware('auth', 'role:admin');

//package
Route::post('admin/estado_home/', [
    'uses' => 'Admin\PackageController@estado_home',
    'as' => 'estado_home_path',
]);
Route::post('admin/offer_home/', [
    'uses' => 'Admin\PackageController@offer_home',
    'as' => 'offer_home_path',
]);
Route::post('admin/is_package/', [
    'uses' => 'Admin\PackageController@is_package',
    'as' => 'is_package_path',
]);
Route::post('admin/is_tours/', [
    'uses' => 'Admin\PackageController@is_tours',
    'as' => 'is_tours_path',
]);
Route::post('admin/descuento/', [
    'uses' => 'Admin\PackageController@descuento',
    'as' => 'descuento_path',
]);

Route::get('admin/package/create', [
    'uses' => 'Admin\HomeController@create',
    'as' => 'admin_package_create_path',
]);
Route::post('admin/package/store', [
    'uses' => 'Admin\HomeController@store',
    'as' => 'admin_package_store_path',
]);
Route::get('admin/package/edit/{id}', [
    'uses' => 'Admin\HomeController@edit',
    'as' => 'admin_package_edit_path',
]);
Route::post('admin/package/update/{id}', [
    'uses' => 'Admin\HomeController@update',
    'as' => 'admin_package_update_path',
]);
Route::post('admin/package/duration', [
    'uses' => 'Admin\HomeController@duration',
    'as' => 'admin_package_duration_path',
]);
Route::get('admin/package/load/{id}/{duration}', [
    'uses' => 'Admin\HomeController@load',
    'as' => 'load_path',
]);
Route::delete('admin/package/edit/{id}', [
    'uses' => 'Admin\HomeController@destroy',
    'as' => 'admin_package_delete_path',
]);

Route::get('admin/package/image/image_upload', [
    'uses' => 'Admin\HomeController@image_upload',
    'as' => 'admin_upload_file_path',
]);
Route::post('admin/package/image/image_store', [
    'uses' => 'Admin\HomeController@image_store',
    'as' => 'admin_image_maps_store_path',
]);
Route::post('admin/package/image/image_delete', [
    'uses' => 'Admin\HomeController@image_delete',
    'as' => 'admin_image_delete_path',
]);


Route::post('admin/package/image/image_store_slider', [
    'uses' => 'Admin\HomeController@image_store_slider',
    'as' => 'admin_image_slider_store_path',
]);
Route::post('admin/package/image/image_delete_slider', [
    'uses' => 'Admin\HomeController@image_delete_slider',
    'as' => 'admin_image_slider_delete_path',
]);
Route::post('admin/package/image/image_delete_package_form', [
    'uses' => 'Admin\HomeController@image_delete_package_form',
    'as' => 'admin_image_delete_package_form_path',
]);
Route::post('admin/package/image/image_delete_map_package_form', [
    'uses' => 'Admin\HomeController@image_delete_map_package_form',
    'as' => 'admin_image_delete_map_package_form_path',
]);

//itinerary
Route::get('admin/itinerary', [
    'uses' => 'Admin\ItineraryController@index',
    'as' => 'admin_itinerary_index_path',
]);
Route::get('admin/itinerary/create', [
    'uses' => 'Admin\ItineraryController@create',
    'as' => 'admin_itinerary_create_path',
]);
Route::post('admin/itinerary/store', [
    'uses' => 'Admin\ItineraryController@store',
    'as' => 'admin_itinerary_store_path',
]);
Route::get('admin/itinerary/edit/{id}', [
    'uses' => 'Admin\ItineraryController@edit',
    'as' => 'admin_itinerary_edit_path',
]);
Route::post('admin/itinerary/update/{id}', [
    'uses' => 'Admin\ItineraryController@update',
    'as' => 'admin_itinerary_update_path',
]);
Route::delete('admin/itinerary/edit/{id}', [
    'uses' => 'Admin\ItineraryController@destroy',
    'as' => 'admin_itinerary_delete_path',
]);
Route::post('admin/itinerary/image/image_store', [
    'uses' => 'Admin\ItineraryController@image_store',
    'as' => 'admin_itinerary_image_store_path',
]);

Route::post('admin/itinerary/image/uploadGallery', [
    'uses' => 'Admin\ItineraryController@uploadGallery',
    'as' => 'admin_hotel_gallery_upload_path',
]);

Route::post('admin/itinerary/image/image_delete', [
    'uses' => 'Admin\ItineraryController@image_delete',
    'as' => 'admin_iitinerary_mage_delete_path',
]);
Route::post('admin/itinerary/image/image_delete_form', [
    'uses' => 'Admin\ItineraryController@image_delete_form',
    'as' => 'admin_iitinerary_image_delete_form_path',
]);
Route::post('admin/itinerary/image/deleteGalleryImage', [
    'uses' => 'Admin\ItineraryController@deleteGalleryImage',
    'as' => 'admin_hotel_gallery_delete_path',
]);
Route::get('admin/itinerary/image/image_list', [
    'uses' => 'Admin\ItineraryController@image_list',
    'as' => 'admin_itinerary_list_path',
]);

//destinations
Route::get('admin/destinations', [
    'uses' => 'Admin\DestinationsController@index',
    'as' => 'admin_destinations_index_path',
]);
Route::get('admin/destinations/create', [
    'uses' => 'Admin\DestinationsController@create',
    'as' => 'admin_destinations_create_path',
]);
Route::post('admin/destinations/store', [
    'uses' => 'Admin\DestinationsController@store',
    'as' => 'admin_destinations_store_path',
]);
Route::get('admin/destinations/edit/{id}', [
    'uses' => 'Admin\DestinationsController@edit',
    'as' => 'admin_destinations_edit_path',
]);
Route::post('admin/destinations/update/{id}', [
    'uses' => 'Admin\DestinationsController@update',
    'as' => 'admin_destinations_update_path',
]);
Route::delete('admin/destinations/edit/{id}', [
    'uses' => 'Admin\DestinationsController@destroy',
    'as' => 'admin_destinations_delete_path',
]);




Route::post('admin/destinations/image/image_destinations_slider_store', [
    'uses' => 'Admin\DestinationsController@image_destinations_slider_store',
    'as' => 'admin_image_destinations_slider_store_path',
]);
Route::post('admin/destinations/image/image_destinations_slider_delete', [
    'uses' => 'Admin\DestinationsController@image_destinations_slider_delete',
    'as' => 'admin_destinations_slider_delete_path',
]);
Route::post('admin/destinations/image/image_destinations_slider_form_delete', [
    'uses' => 'Admin\DestinationsController@image_destinations_slider_form_delete',
    'as' => 'admin_destinations_slider_form_delete_path',
]);

Route::post('admin/destinations/image/image_destinations_image_store', [
    'uses' => 'Admin\DestinationsController@image_destinations_image_store',
    'as' => 'admin_image_destinations_image_store_path',
]);
Route::post('admin/destinations/image/image_destinations_image_delete', [
    'uses' => 'Admin\DestinationsController@image_destinations_image_delete',
    'as' => 'admin_destinations_image_delete_path',
]);
Route::post('admin/destinations/image/image_delete_form', [
    'uses' => 'Admin\DestinationsController@image_destinations_image_form_delete',
    'as' => 'admin_destinations_image_form_delete_path',
]);

//country
Route::get('admin/countries', [
    'uses' => 'Admin\CountryController@index',
    'as' => 'admin_countries_index_path',
]);
Route::get('admin/countries/create', [
    'uses' => 'Admin\CountryController@create',
    'as' => 'admin_countries_create_path',
]);
Route::post('admin/countries/store', [
    'uses' => 'Admin\CountryController@store',
    'as' => 'admin_countries_store_path',
]);
Route::get('admin/countries/edit/{id}', [
    'uses' => 'Admin\CountryController@edit',
    'as' => 'admin_countries_edit_path',
]);
Route::post('admin/countries/update/{id}', [
    'uses' => 'Admin\CountryController@update',
    'as' => 'admin_countries_update_path',
]);
Route::delete('admin/countries/edit/{id}', [
    'uses' => 'Admin\CountryController@destroy',
    'as' => 'admin_countries_delete_path',
]);

//country imagen edit
Route::post('admin/countries/image/image_countries_slider_store', [
    'uses' => 'Admin\CountryController@image_countries_slider_store',
    'as' => 'admin_image_countries_slider_store_path',
]);
Route::post('admin/countries/image/image_countries_slider_delete', [
    'uses' => 'Admin\CountryController@image_countries_slider_delete',
    'as' => 'admin_countries_slider_delete_path',
]);
Route::post('admin/countries/image/image_countries_slider_form_delete', [
    'uses' => 'Admin\CountryController@image_countries_slider_form_delete',
    'as' => 'admin_countries_slider_form_delete_path',
]);

Route::post('admin/countries/image/image_countries_image_store', [
    'uses' => 'Admin\CountryController@image_countries_image_store',
    'as' => 'admin_image_countries_image_store_path',
]);
Route::post('admin/countries/image/image_countries_image_delete', [
    'uses' => 'Admin\CountryController@image_countries_image_delete',
    'as' => 'admin_countries_image_delete_path',
]);
Route::post('admin/countries/image/image_delete_form', [
    'uses' => 'Admin\CountryController@image_countries_image_form_delete',
    'as' => 'admin_countries_image_form_delete_path',
]);

//country imagen create
Route::post('admin/countries/image/countries_imagen_getFile', [
    'uses' => 'Admin\CountryController@countries_imagen_getFile',
    'as' => 'admin_countries_imagen_getFile_path',
]);
Route::post('admin/countries/image/countries_imagen_deleteFile', [
    'uses' => 'Admin\CountryController@countries_imagen_deleteFile',
    'as' => 'admin_countries_imagen_deleteFile_path',
]);
Route::post('admin/countries/image/countries_slider_getFile', [
    'uses' => 'Admin\CountryController@countries_slider_getFile',
    'as' => 'admin_countries_slider_getFile_path',
]);
Route::post('admin/countries/image/countries_slider_deleteFile', [
    'uses' => 'Admin\CountryController@countries_slider_deleteFile',
    'as' => 'admin_countries_slider_deleteFile_path',
]);


//country seo imagen create
Route::post('admin/seo/image/seo_country_image_store', [
    'uses' => 'Admin\SeoController@seo_country_image_store',
    'as' => 'admin_seo_country_image_store_path',
]);
Route::post('admin/seo/image/seo_country_image_delete', [
    'uses' => 'Admin\SeoController@seo_country_image_delete',
    'as' => 'admin_seo_country_image_delete_path',
]);
Route::post('admin/seo/image/seo_country_image_delete_form', [
    'uses' => 'Admin\SeoController@seo_country_image_form_delete',
    'as' => 'admin_seo_country_image_form_delete_path',
]);
Route::post('admin/seo/image/seo_country_imagen_getFile', [
    'uses' => 'Admin\SeoController@seo_country_imagen_getFile',
    'as' => 'admin_seo_country_imagen_getFile_path',
]);
Route::post('admin/seo/image/seo_country_imagen_deleteFile', [
    'uses' => 'Admin\SeoController@seo_country_imagen_deleteFile',
    'as' => 'admin_seo_country_imagen_deleteFile_path',
]);



//included
Route::get('admin/included', [
    'uses' => 'Admin\IncludedController@index',
    'as' => 'admin_included_index_path',
]);
Route::post('admin/included/store', [
    'uses' => 'Admin\IncludedController@store',
    'as' => 'admin_included_store_path',
]);
Route::post('admin/included/update/{id}', [
    'uses' => 'Admin\IncludedController@update',
    'as' => 'admin_included_update_path',
]);
Route::delete('admin/included/edit/{id}', [
    'uses' => 'Admin\IncludedController@destroy',
    'as' => 'admin_included_delete_path',
]);
//not included
Route::get('admin/not-included', [
    'uses' => 'Admin\NotIncludedController@index',
    'as' => 'admin_not_included_index_path',
]);
Route::post('admin/not-included/store', [
    'uses' => 'Admin\NotIncludedController@store',
    'as' => 'admin_not_included_store_path',
]);
Route::post('admin/not-included/update/{id}', [
    'uses' => 'Admin\NotIncludedController@update',
    'as' => 'admin_not_included_update_path',
]);
Route::delete('admin/not-included/edit/{id}', [
    'uses' => 'Admin\NotIncludedController@destroy',
    'as' => 'admin_not_included_delete_path',
]);
//category
Route::get('admin/category', [
    'uses' => 'Admin\CategoryController@index',
    'as' => 'admin_category_index_path',
]);
Route::get('admin/category/edit/{id}', [
    'uses' => 'Admin\CategoryController@edit',
    'as' => 'admin_category_edit_path',
]);


Route::post('admin/category/image/image_category_slider_store', [
    'uses' => 'Admin\CategoryController@image_category_slider_store',
    'as' => 'admin_image_category_slider_store_path',
]);
Route::post('admin/category/image/image_category_slider_delete', [
    'uses' => 'Admin\CategoryController@image_category_slider_delete',
    'as' => 'admin_category_slider_delete_path',
]);
Route::post('admin/category/image/image_category_slider_form_delete', [
    'uses' => 'Admin\CategoryController@image_category_slider_form_delete',
    'as' => 'admin_category_slider_form_delete_path',
]);

Route::post('admin/category/image/image_category_image_store', [
    'uses' => 'Admin\CategoryController@image_category_image_store',
    'as' => 'admin_image_category_image_store_path',
]);
Route::post('admin/category/image/image_category_image_delete', [
    'uses' => 'Admin\CategoryController@image_category_image_delete',
    'as' => 'admin_category_image_delete_path',
]);
Route::post('admin/category/image/image_delete_form', [
    'uses' => 'Admin\CategoryController@image_category_image_form_delete',
    'as' => 'admin_category_image_form_delete_path',
]);



Route::post('admin/category/store', [
    'uses' => 'Admin\CategoryController@store',
    'as' => 'admin_category_store_path',
]);
Route::post('admin/category/update/{id}', [
    'uses' => 'Admin\CategoryController@update',
    'as' => 'admin_category_update_path',
]);
Route::delete('admin/category/edit/{id}', [
    'uses' => 'Admin\CategoryController@destroy',
    'as' => 'admin_category_delete_path',
]);
//difficulty
Route::get('admin/difficulty', [
    'uses' => 'Admin\DifficultyController@index',
    'as' => 'admin_difficulty_index_path',
]);
Route::post('admin/difficulty/store', [
    'uses' => 'Admin\DifficultyController@store',
    'as' => 'admin_difficulty_store_path',
]);
Route::post('admin/difficulty/update/{id}', [
    'uses' => 'Admin\DifficultyController@update',
    'as' => 'admin_difficulty_update_path',
]);
Route::delete('admin/difficulty/edit/{id}', [
    'uses' => 'Admin\DifficultyController@destroy',
    'as' => 'admin_difficulty_delete_path',
]);
//video
Route::get('admin/video', [
    'uses' => 'Admin\VideoController@index',
    'as' => 'admin_video_index_path',
]);
Route::get('admin/video/create', [
    'uses' => 'Admin\VideoController@create',
    'as' => 'admin_video_create_path',
]);
Route::post('admin/video/store', [
    'uses' => 'Admin\VideoController@store',
    'as' => 'admin_video_store_path',
]);
Route::get('admin/video/edit/{id}', [
    'uses' => 'Admin\VideoController@edit',
    'as' => 'admin_video_edit_path',
]);
Route::post('admin/video/update/{id}', [
    'uses' => 'Admin\VideoController@update',
    'as' => 'admin_video_update_path',
]);
Route::delete('admin/video/edit/{id}', [
    'uses' => 'Admin\VideoController@destroy',
    'as' => 'admin_video_delete_path',
]);
Route::post('admin/video/image/image_store', [
    'uses' => 'Admin\VideoController@image_store',
    'as' => 'admin_video_image_store_path',
]);
Route::post('admin/video/image/image_delete', [
    'uses' => 'Admin\VideoController@image_delete',
    'as' => 'admin_video_image_delete_path',
]);
Route::post('admin/video/image/image_delete_form', [
    'uses' => 'Admin\VideoController@image_delete_form',
    'as' => 'admin_video_image_delete_form_path',
]);
Route::get('admin/video/image/image_list', [
    'uses' => 'Admin\VideoController@image_list',
    'as' => 'admin_video_list_path',
]);
//inquire
Route::get('admin/inquire', [
    'uses' => 'Admin\InquireController@list',
    'as' => 'admin_list_index_path',
]);
Route::get('admin/inquire/{id}', [
    'uses' => 'Admin\InquireController@index',
    'as' => 'admin_inquire_index_path',
]);
Route::post('admin/inquire/store', [
    'uses' => 'Admin\InquireController@store',
    'as' => 'admin_inquire_store_path',
]);
Route::get('admin/inquire/edit/{id}', [
    'uses' => 'Admin\InquireController@edit',
    'as' => 'admin_inquire_edit_index_path',
]);
Route::delete('admin/inquire/delete/{id}', [
    'uses' => 'Admin\InquireController@destroy',
    'as' => 'admin_inquire_delete_path',
]);
Route::get('admin/inquire/package-file/{id}', [
    'uses' => 'Admin\InquireController@package_pdf',
    'as' => 'admin_inquire_package_pdf_path',
]);
//yourtrip
Route::get('/yourtrip/itinerary/{id}', [
    'uses' => 'HomepageController@yourtrip',
    'as' => 'yourtrip_us_path',
]);
//testimonials
Route::get('admin/testimonial', [
    'uses' => 'Admin\TestimonialController@index',
    'as' => 'admin_testimonial_index_path',
]);

//hoteles
Route::get('admin/hotel', [
    'uses' => 'Admin\HotelController@index',
    'as' => 'admin_hotel_index_path',
]);
Route::get('admin/hotel/create', [
    'uses' => 'Admin\HotelController@create',
    'as' => 'admin_hotel_create_path',
]);
Route::post('admin/hotel/store', [
    'uses' => 'Admin\HotelController@store',
    'as' => 'admin_hotel_store_path',
]);
Route::get('admin/hotel/edit/{id}', [
    'uses' => 'Admin\HotelController@edit',
    'as' => 'admin_hotel_edit_path',
]);
Route::post('admin/hotel/update/{id}', [
    'uses' => 'Admin\HotelController@update',
    'as' => 'admin_hotel_update_path',
]);
Route::delete('admin/hotel/edit/{id}', [
    'uses' => 'Admin\HotelController@destroy',
    'as' => 'admin_hotel_delete_path',
]);
Route::post('admin/hotel/image/image_store', [
    'uses' => 'Admin\HotelController@image_store',
    'as' => 'admin_hotel_image_store_path',
]);
Route::post('admin/hotel/image/hotel/image_delete', [
    'uses' => 'Admin\HotelController@image_delete_hotel',
    'as' => 'admin_hotel_image_delete_path',
]);
Route::post('admin/hotel/image/image_delete_form', [
    'uses' => 'Admin\HotelController@image_delete_form',
    'as' => 'admin_hotel_image_delete_form_path',
]);
Route::get('admin/hotel/image/image_list', [
    'uses' => 'Admin\HotelController@image_list',
    'as' => 'admin_hotel_list_path',
]);

Route::post('admin/hotel/image/gallery/store', [
    'uses' => 'Admin\HotelController@hotel_imagen_gallery_store',
    'as' => 'admin_hotel_gallery_upload_path',
]);


Route::post('admin/hotel/image/hotel_slider_getFile', [
    'uses' => 'Admin\HotelController@hotel_slider_getFile',
    'as' => 'admin_hotel_slider_getFile_path',
]);

Route::post('admin/hotel/image/slider/delete', [
    'uses' => 'Admin\HotelController@hotel_slider_deleteFile',
    'as' => 'admin_hotel_slider_deleteFile_path',
]);

//BLOG
Route::get('admin/blog', [
    'uses' => 'Admin\BlogController@index',
    'as' => 'admin_blog_index_path',
]);
Route::get('admin/blog/create', [
    'uses' => 'Admin\BlogController@create',
    'as' => 'admin_blog_create_path',
]);
Route::post('admin/blog/store', [
    'uses' => 'Admin\BlogController@store',
    'as' => 'admin_blog_store_path',
]);
Route::get('admin/blog/edit/{id}', [
    'uses' => 'Admin\BlogController@edit',
    'as' => 'admin_blog_edit_path',
]);
Route::post('admin/blog/update/{id}', [
    'uses' => 'Admin\BlogController@update',
    'as' => 'admin_blog_update_path',
]);
Route::delete('admin/blog/edit/{id}', [
    'uses' => 'Admin\BlogController@destroy',
    'as' => 'admin_blog_delete_path',
]);
Route::post('admin/blog/image/image_blog_image_store', [
    'uses' => 'Admin\BlogController@image_blog_image_store',
    'as' => 'admin_image_blog_image_store_path',
]);
//BLOG categoria
Route::get('admin/blog/category', [
    'uses' => 'Admin\BlogCategoryController@index',
    'as' => 'admin_blog_category_index_path',
]);
Route::post('admin/blog/category/store', [
    'uses' => 'Admin\BlogCategoryController@store',
    'as' => 'admin_blog_category_store_path',
]);
Route::post('admin/blog/category/update/{id}', [
    'uses' => 'Admin\BlogCategoryController@update',
    'as' => 'admin_blog_category_update_path',
]);
Route::delete('admin/blog/category/edit/{id}', [
    'uses' => 'Admin\BlogCategoryController@destroy',
    'as' => 'admin_blog_category_delete_path',
]);
//blog image
Route::post('admin/blog/image/blog_image_store', [
    'uses' => 'Admin\BlogController@blog_image_store',
    'as' => 'admin_blog_image_store_path',
]);
Route::post('admin/blog/image/blog_image_delete', [
    'uses' => 'Admin\BlogController@blog_image_delete',
    'as' => 'admin_blog_image_delete_path',
]);
Route::post('admin/blog/image/blog_image_delete_form', [
    'uses' => 'Admin\BlogController@blog_image_form_delete',
    'as' => 'admin_blog_image_form_delete_path',
]);
//
Route::post('admin/blog/image/blog_slider_store', [
    'uses' => 'Admin\BlogController@blog_slider_store',
    'as' => 'admin_blog_slider_store_path',
]);
Route::post('admin/blog/image/blog_slider_delete', [
    'uses' => 'Admin\BlogController@blog_slider_delete',
    'as' => 'admin_blog_slider_delete_path',
]);
Route::post('admin/blog/image/blog_slider_form_delete', [
    'uses' => 'Admin\BlogController@blog_slider_form_delete',
    'as' => 'admin_blog_slider_form_delete_path',
]);
//
Route::post('admin/blog/image/blog_imagen_getFile', [
    'uses' => 'Admin\BlogController@blog_imagen_getFile',
    'as' => 'admin_blog_imagen_getFile_path',
]);
Route::post('admin/blog/image/blog_imagen_deleteFile', [
    'uses' => 'Admin\BlogController@blog_imagen_deleteFile',
    'as' => 'admin_blog_imagen_deleteFile_path',
]);
Route::post('admin/blog/image/blog_slider_getFile', [
    'uses' => 'Admin\BlogController@blog_slider_getFile',
    'as' => 'admin_blog_slider_getFile_path',
]);
Route::post('admin/blog/image/blog_slider_deleteFile', [
    'uses' => 'Admin\BlogController@blog_slider_deleteFile',
    'as' => 'admin_blog_slider_deleteFile_path',
]);
//paquete imagen crear
Route::post('admin/package/image/package_imagen_getFile', [
    'uses' => 'Admin\HomeController@package_imagen_getFile',
    'as' => 'admin_package_imagen_getFile_path',
]);
Route::post('admin/package/image/package_imagen_deleteFile', [
    'uses' => 'Admin\HomeController@package_imagen_deleteFile',
    'as' => 'admin_package_imagen_deleteFile_path',
]);
Route::post('admin/package/image/package_slider_getFile', [
    'uses' => 'Admin\HomeController@package_slider_getFile',
    'as' => 'admin_package_slider_getFile_path',
]);
Route::post('admin/package/image/package_slider_deleteFile', [
    'uses' => 'Admin\HomeController@package_slider_deleteFile',
    'as' => 'admin_package_slider_deleteFile_path',
]);
Route::post('admin/package/image/package_map_getFile', [
    'uses' => 'Admin\HomeController@package_map_getFile',
    'as' => 'admin_package_map_getFile_path',
]);
Route::post('admin/package/image/package_map_deleteFile', [
    'uses' => 'Admin\HomeController@package_map_deleteFile',
    'as' => 'admin_package_map_deleteFile_path',
]);
//package map update
Route::post('admin/package/image/map_store', [
    'uses' => 'Admin\HomeController@map_store',
    'as' => 'admin_map_store_path',
]);
Route::post('admin/package/image/map_delete', [
    'uses' => 'Admin\HomeController@map_delete',
    'as' => 'admin_map_delete_path',
]);
Route::post('admin/package/image/delete_map_package_form', [
    'uses' => 'Admin\HomeController@delete_map_package_form',
    'as' => 'admin_delete_map_package_form_path',
]);
//itinerary imagenes crear
Route::post('admin/itinerary/image/itinerary_slider_getFile', [
    'uses' => 'Admin\ItineraryController@itinerary_slider_getFile',
    'as' => 'admin_itinerary_slider_getFile_path',
]);
Route::post('admin/itinerary/image/itinerary_slider_deleteFile', [
    'uses' => 'Admin\ItineraryController@itinerary_slider_deleteFile',
    'as' => 'admin_itinerary_slider_deleteFile_path',
]);
//destionation imagen create
Route::post('admin/destinations/image/destinations_imagen_getFile', [
    'uses' => 'Admin\DestinationsController@destinations_imagen_getFile',
    'as' => 'admin_destinations_imagen_getFile_path',
]);
Route::post('admin/destinations/image/destinations_imagen_deleteFile', [
    'uses' => 'Admin\DestinationsController@destinations_imagen_deleteFile',
    'as' => 'admin_destinations_imagen_deleteFile_path',
]);
Route::post('admin/destinations/image/destinations_slider_getFile', [
    'uses' => 'Admin\DestinationsController@destinations_slider_getFile',
    'as' => 'admin_destinations_slider_getFile_path',
]);
Route::post('admin/destinations/image/destinations_slider_deleteFile', [
    'uses' => 'Admin\DestinationsController@destinations_slider_deleteFile',
    'as' => 'admin_destinations_slider_deleteFile_path',
]);
//hotel imagen create
Route::post('admin/hotel/image/hotel_imagen_getFile', [
    'uses' => 'Admin\HotelController@hotel_imagen_getFile',
    'as' => 'admin_hotel_imagen_getFile_path',
]);
Route::post('admin/hotel/image/hotel_imagen_deleteFile', [
    'uses' => 'Admin\HotelController@hotel_imagen_deleteFile',
    'as' => 'admin_hotel_imagen_deleteFile_path',
]);
//category images create
Route::post('admin/category/image/category_imagen_getFile', [
    'uses' => 'Admin\CategoryController@category_imagen_getFile',
    'as' => 'admin_category_imagen_getFile_path',
]);
Route::post('admin/category/image/category_imagen_deleteFile', [
    'uses' => 'Admin\CategoryController@category_imagen_deleteFile',
    'as' => 'admin_category_imagen_deleteFile_path',
]);
Route::post('admin/category/image/category_slider_getFile', [
    'uses' => 'Admin\CategoryController@category_slider_getFile',
    'as' => 'admin_category_slider_getFile_path',
]);
Route::post('admin/category/image/category_slider_deleteFile', [
    'uses' => 'Admin\CategoryController@category_slider_deleteFile',
    'as' => 'admin_category_slider_deleteFile_path',
]);
//SEO
Route::post('admin/seo/store', [
    'uses' => 'Admin\SeoController@store',
    'as' => 'admin_seo_store_path',
]);
Route::post('admin/seo/update/{id}', [
    'uses' => 'Admin\SeoController@update',
    'as' => 'admin_seo_update_path',
]);
Route::delete('admin/seo/edit/{id}', [
    'uses' => 'Admin\SeoController@destroy',
    'as' => 'admin_seo_delete_path',
]);
//SEO BLOD
Route::post('admin/seo/image/seo_blog_image_store', [
    'uses' => 'Admin\SeoController@seo_blog_image_store',
    'as' => 'admin_seo_blog_image_store_path',
]);
Route::post('admin/seo/image/seo_blog_image_delete', [
    'uses' => 'Admin\SeoController@seo_blog_image_delete',
    'as' => 'admin_seo_blog_image_delete_path',
]);
Route::post('admin/seo/image/seo_blog_image_delete_form', [
    'uses' => 'Admin\SeoController@seo_blog_image_form_delete',
    'as' => 'admin_seo_blog_image_form_delete_path',
]);
Route::post('admin/seo/image/seo_blog_imagen_getFile', [
    'uses' => 'Admin\SeoController@seo_blog_imagen_getFile',
    'as' => 'admin_seo_blog_imagen_getFile_path',
]);
Route::post('admin/seo/image/seo_blog_imagen_deleteFile', [
    'uses' => 'Admin\SeoController@seo_blog_imagen_deleteFile',
    'as' => 'admin_seo_blog_imagen_deleteFile_path',
]);
//SEO PAQUETES
Route::post('admin/seo/image/seo_package_image_store', [
    'uses' => 'Admin\SeoController@seo_package_image_store',
    'as' => 'admin_seo_package_image_store_path',
]);
Route::post('admin/seo/image/seo_package_image_delete', [
    'uses' => 'Admin\SeoController@seo_package_image_delete',
    'as' => 'admin_seo_package_image_delete_path',
]);
Route::post('admin/seo/image/seo_package_image_delete_form', [
    'uses' => 'Admin\SeoController@seo_package_image_form_delete',
    'as' => 'admin_seo_package_image_form_delete_path',
]);
Route::post('admin/seo/image/seo_package_imagen_getFile', [
    'uses' => 'Admin\SeoController@seo_package_imagen_getFile',
    'as' => 'admin_seo_package_imagen_getFile_path',
]);
Route::post('admin/seo/image/seo_package_imagen_deleteFile', [
    'uses' => 'Admin\SeoController@seo_package_imagen_deleteFile',
    'as' => 'admin_seo_package_imagen_deleteFile_path',
]);
//SEO DESTINOS
Route::post('admin/seo/image/seo_destinations_image_store', [
    'uses' => 'Admin\SeoController@seo_destinations_image_store',
    'as' => 'admin_seo_destinations_image_store_path',
]);
Route::post('admin/seo/image/seo_destinations_image_delete', [
    'uses' => 'Admin\SeoController@seo_destinations_image_delete',
    'as' => 'admin_seo_destinations_image_delete_path',
]);
Route::post('admin/seo/image/seo_destinations_image_delete_form', [
    'uses' => 'Admin\SeoController@seo_destinations_image_form_delete',
    'as' => 'admin_seo_destinations_image_form_delete_path',
]);
Route::post('admin/seo/image/seo_destinations_imagen_getFile', [
    'uses' => 'Admin\SeoController@seo_destinations_imagen_getFile',
    'as' => 'admin_seo_destinations_imagen_getFile_path',
]);
Route::post('admin/seo/image/seo_destinations_imagen_deleteFile', [
    'uses' => 'Admin\SeoController@seo_destinations_imagen_deleteFile',
    'as' => 'admin_seo_destinations_imagen_deleteFile_path',
]);
//SEO CATEGORY
Route::post('admin/seo/image/seo_category_image_store', [
    'uses' => 'Admin\SeoController@seo_category_image_store',
    'as' => 'admin_seo_category_image_store_path',
]);
Route::post('admin/seo/image/seo_category_image_delete', [
    'uses' => 'Admin\SeoController@seo_category_image_delete',
    'as' => 'admin_seo_category_image_delete_path',
]);
Route::post('admin/seo/image/seo_category_image_delete_form', [
    'uses' => 'Admin\SeoController@seo_category_image_form_delete',
    'as' => 'admin_seo_category_image_form_delete_path',
]);
Route::post('admin/seo/image/seo_category_imagen_getFile', [
    'uses' => 'Admin\SeoController@seo_category_imagen_getFile',
    'as' => 'admin_seo_category_imagen_getFile_path',
]);
Route::post('admin/seo/image/seo_category_imagen_deleteFile', [
    'uses' => 'Admin\SeoController@seo_category_imagen_deleteFile',
    'as' => 'admin_seo_category_imagen_deleteFile_path',
]);
