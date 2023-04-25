<?php

Route::get('artisan/deploy', function () {
  Artisan::call('deploy');
  return dd(Artisan::output());
});