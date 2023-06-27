
Route::resource('paie', PaieController::class)->middleware('auth');
Route::get('paie/pdf/{status}', [PaieController::class, 'generate_pdf'])->name('paie.pdf')->middleware('auth');
Route::resource('paie', PaieController::class)->middleware('auth');
Route::get('paie/pdf/{status}', [PaieController::class, 'generate_pdf'])->name('paie.pdf')->middleware('auth');
Route::get('paie/fiche/{id}', [PaieController::class, 'fiche_paie'])->name('fiche_paie.pdf')->middleware('auth');