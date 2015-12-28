<?php

use App\User;
use Illuminate\Support\Facades\Auth;

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/',[
  'middleware' => ['auth', 'roles'],
  'as' => 'dashboard',
  'uses' => 'DashboardController@index',
  'roles' => ['Admin', 'Managerial','Petugas']
]);

Route::group(array('prefix' => 'mutation'),function() {

  Route::get('mutation_autocomplete', [
       'middleware' => ['auth', 'roles'],
       'as' => 'mutation.mutation_autocomplete',
       'uses' => 'MutationController@mutation_autocomplete',
       'roles' => ['Admin', 'Managerial','Petugas']
   ]);

  Route::get('mutation_detail/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.mutation_detail',
      'uses' => 'MutationController@mutation_detail',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('mutation_detail_data/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.mutation_detail_data',
      'uses' => 'MutationController@mutation_detail_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('store_detail_mutation', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.store_detail_mutation',
      'uses' => 'MutationController@store_detail_mutation',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('index_sent', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.index_sent',
      'uses' => 'MutationController@index_sent',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('sent_mutation_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.sent_mutation_data',
      'uses' => 'MutationController@sent_mutation_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('update_sent_mutation/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.mutation.update_sent_mutation',
      'uses' => 'MutationController@update_sent_mutation',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('index', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.index',
      'uses' => 'MutationController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('mutation_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'mutation.mutation_data',
      'uses' => 'MutationController@mutation_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.mutation.create',
      'uses' => 'MutationController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.mutation.store',
      'uses' => 'MutationController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.mutation.edit',
      'uses' => 'MutationController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.mutation.update',
      'uses' => 'MutationController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('destroy/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.mutation.destroy',
      'uses' => 'MutationController@destroy',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);
});

Route::group(array('prefix' => 'placing'),function() {

  Route::get('placing_detail/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'placing.placing_detail',
      'uses' => 'PlacingController@placing_detail',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('placing_detail_data/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'placing.placing_detail_data',
      'uses' => 'PlacingController@placing_detail_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('store_detail_placing', [
      'middleware' => ['auth', 'roles'],
      'as' => 'placing.store_detail_placing',
      'uses' => 'PlacingController@store_detail_placing',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('index', [
      'middleware' => ['auth', 'roles'],
      'as' => 'placing.index',
      'uses' => 'PlacingController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('placing_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'placing.placing_data',
      'uses' => 'PlacingController@placing_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.placing.create',
      'uses' => 'PlacingController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.placing.store',
      'uses' => 'PlacingController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.placing.edit',
      'uses' => 'PlacingController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.placing.update',
      'uses' => 'PlacingController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('destroy/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.placing.destroy',
      'uses' => 'PlacingController@destroy',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);


});

Route::group(array('prefix' => 'transaction'),function() {
  Route::get('setup', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup',
      'uses' => 'TransactionSetupController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/condition', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.condition',
      'uses' => 'TransactionSetupController@trans_condition',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/unit', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.unit',
      'uses' => 'TransactionSetupController@trans_unit_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/statusland', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.statusland',
      'uses' => 'TransactionSetupController@trans_status_land',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/statuscert', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.statuscert',
      'uses' => 'TransactionSetupController@trans_status_cert',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/statusbuildings', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.statusbuildings',
      'uses' => 'TransactionSetupController@trans_status_building',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/investors', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.investors',
      'uses' => 'TransactionSetupController@trans_investor',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/gols', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.gols',
      'uses' => 'TransactionSetupController@trans_gol',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/forvehicles', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.forvehicles',
      'uses' => 'TransactionSetupController@trans_for_vehicle',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/forlands', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.forlands',
      'uses' => 'TransactionSetupController@trans_for_land',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/forbuildings', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.forbuildings',
      'uses' => 'TransactionSetupController@trans_for_building',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);
});

Route::group(array('prefix' => 'transaction'),function() {
  Route::get('manage_assets', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.manage.assets',
      'uses' => 'TransactionAssetController@manage_assets',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/ma_asset_vehicles', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.ma_asset_vehicles',
      'uses' => 'TransactionAssetController@ma_asset_vehicles',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/ma_asset_proplands', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.ma_asset_proplands',
      'uses' => 'TransactionAssetController@ma_asset_proplands',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/ma_asset_propbuildings', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.ma_asset_propbuildings',
      'uses' => 'TransactionAssetController@ma_asset_propbuildings',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('setup/ma_asset_items', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.setup.ma_asset_items',
      'uses' => 'TransactionAssetController@ma_asset_items',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('new', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.new',
      'uses' => 'TransactionAssetController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('process', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.process',
      'uses' => 'TransactionAssetController@process',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('create_item/{ac_id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.create_item',
      'uses' => 'TransactionAssetController@create_item',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('create_vehicle/{ac_id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.create_vehicle',
      'uses' => 'TransactionAssetController@create_vehicle',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('create_propland/{ac_id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.create_propland',
      'uses' => 'TransactionAssetController@create_propland',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('create_propbuilding/{ac_id}/{tipe}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.create_propbuilding',
      'uses' => 'TransactionAssetController@create_propbuilding',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('transaction/store_item', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.store_item',
      'uses' => 'TransactionAssetController@store_item',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('transaction/store_vehicle', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.store_vehicle',
      'uses' => 'TransactionAssetController@store_vehicle',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('transaction/store_propland', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.store_propland',
      'uses' => 'TransactionAssetController@store_propland',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('transaction/store_propbuilding', [
      'middleware' => ['auth', 'roles'],
      'as' => 'transaction.store_propbuilding',
      'uses' => 'TransactionAssetController@store_propbuilding',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

});

Route::group(array('prefix' => 'master'),function() {

  Route::get('users', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.user',
      'uses' => 'UserController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('user_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_user',
      'uses' => 'UserController@user_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('user/create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.user.create',
      'uses' => 'UserController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('user/store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.user.store',
      'uses' => 'UserController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('user/edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.user.edit',
      'uses' => 'UserController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('user/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.user.update',
      'uses' => 'UserController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('user/destroy/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.user.destroy',
      'uses' => 'UserController@destroy',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);


  //end user

  Route::get('asset_type', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type',
      'uses' => 'AssetTypeController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('asset_type_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_asset_type',
      'uses' => 'AssetTypeController@asset_type_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('asset_type/create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type.create',
      'uses' => 'AssetTypeController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('asset_type/store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type.store',
      'uses' => 'AssetTypeController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('asset_type/edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type.edit',
      'uses' => 'AssetTypeController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('asset_type/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type.update',
      'uses' => 'AssetTypeController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('asset_type/destroy/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type.destroy',
      'uses' => 'AssetTypeController@destroy',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //end asset type

  Route::get('asset_category', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_category',
      'uses' => 'AssetCategoryController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('asset_category_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_asset_category',
      'uses' => 'AssetCategoryController@asset_category_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('asset_category/create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_category.create',
      'uses' => 'AssetCategoryController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('asset_category/store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_category.store',
      'uses' => 'AssetCategoryController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('asset_category/edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_type.edit',
      'uses' => 'AssetCategoryController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('asset_category/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_category.update',
      'uses' => 'AssetCategoryController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('asset_category/destroy/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.asset_category.destroy',
      'uses' => 'AssetCategoryController@destroy',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //end asset category

  Route::get('regions', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region',
      'uses' => 'RegionController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('region_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_region',
      'uses' => 'RegionController@region_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('region/create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.create',
      'uses' => 'RegionController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('region/store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.store',
      'uses' => 'RegionController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('region/edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.edit',
      'uses' => 'RegionController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('region/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.update',
      'uses' => 'RegionController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //region end

  Route::get('region/detail_kprk/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.detail_kprk',
      'uses' => 'RegionController@detail_kprk',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('get_kprk_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_kprk_data',
      'uses' => 'RegionController@get_kprk_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('region/store_kprk', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.store_kprk',
      'uses' => 'RegionController@store_kprk',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('region/detail_kprk/edit/{id}/{id_kprk}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.kprk.edit',
      'uses' => 'RegionController@edit_kprk',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('region/detail_kprk/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.kprk.update',
      'uses' => 'RegionController@update_kprk',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('region/detail_kprk/destroy_kprk/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.kprk.delete',
      'uses' => 'RegionController@destroy_kprk',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //kprk end

  Route::get('region/detail_kprk/detail_kpc/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.detail_kpc',
      'uses' => 'RegionController@detail_kpc',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('get_kpc_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_kpc_data',
      'uses' => 'RegionController@get_kpc_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('region/store_kpc', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.store_kpc',
      'uses' => 'RegionController@store_kpc',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('region/detail_kprk/detail_kpc/edit/{id}/{id_kpc}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.kpc.edit',
      'uses' => 'RegionController@edit_kpc',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('region/detail_kprk/detail_kpc/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.kpc.update',
      'uses' => 'RegionController@update_kpc',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('region/detail_kprk/detail_kpc/destroy_kpc/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.region.kpc.delete',
      'uses' => 'RegionController@destroy_kpc',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //end kpc


  Route::get('offices', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office',
      'uses' => 'OfficeController@index',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('office_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_office',
      'uses' => 'OfficeController@office_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('office/create', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.create',
      'uses' => 'OfficeController@create',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('office/store', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.store',
      'uses' => 'OfficeController@store',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('office/edit/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.edit',
      'uses' => 'OfficeController@edit',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('office/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.update',
      'uses' => 'OfficeController@update',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //end office
  Route::get('office/detail_division/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.detail_division',
      'uses' => 'OfficeController@detail_division',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('get_division_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_division_data',
      'uses' => 'OfficeController@get_division_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('office/store_division', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.store_division',
      'uses' => 'OfficeController@store_division',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('office/detail_division/edit/{id}/{id_division}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.division.edit',
      'uses' => 'OfficeController@edit_division',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('office/detail_division/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.division.update',
      'uses' => 'OfficeController@update_division',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('office/detail_division/destroy_division/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.division.delete',
      'uses' => 'OfficeController@destroy_division',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  //end divisi

  Route::get('office/detail_division/detail_depart/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.detail_depart',
      'uses' => 'OfficeController@detail_depart',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('get_depart_data', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.get_depart_data',
      'uses' => 'OfficeController@get_depart_data',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::post('office/store_depart', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.store_depart',
      'uses' => 'OfficeController@store_depart',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::get('office/detail_division/detail_depart/edit/{id}/{id_depart}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.depart.edit',
      'uses' => 'OfficeController@edit_depart',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::patch('office/detail_division/detail_depart/update/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.depart.update',
      'uses' => 'OfficeController@update_depart',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);

  Route::delete('office/detail_division/detail_depart/destroy_depart/{id}', [
      'middleware' => ['auth', 'roles'],
      'as' => 'master.office.depart.delete',
      'uses' => 'OfficeController@destroy_depart',
      'roles' => ['Admin', 'Managerial','Petugas']
  ]);
});
