<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\AboutInfoController;
use App\Http\Controllers\AboutStoryController;
use App\Http\Controllers\AboutDoctrinController;
use App\Http\Controllers\AboutLogoController;
use App\Http\Controllers\AboutIadController;
use App\Http\Controllers\AboutIntroController;
use App\Http\Controllers\AboutVisionController;
use App\Http\Controllers\AboutMisionController;
use App\Http\Controllers\AboutProgramController;
use App\Http\Controllers\AboutCommandController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\IntegrityLegalController;
use App\Http\Controllers\IntegrityMechanismController;
use App\Http\Controllers\IntegrityArrangementController;
use App\Http\Controllers\IntegrityAccountabilityController;
use App\Http\Controllers\IntegrityProfessionalismController;
use App\Http\Controllers\IntegrityInnovationController;
use App\Http\Controllers\IntegritySupervisionController;
use App\Http\Controllers\InformationUnitController;
use App\Http\Controllers\InformationDpoController;
use App\Http\Controllers\InformationStructuralController;
use App\Http\Controllers\InformationServiceController;
use App\Http\Controllers\InformationInfrastructureController;
use App\Http\Controllers\ConferenceNewsController;
use App\Http\Controllers\ConferenceAnnouncementController;
use App\Http\Controllers\ConferenceEventController;
use App\Http\Controllers\ConferenceArticleController;
use App\Http\Controllers\ConferenceBulletinController;
use App\Http\Controllers\ArchiveRegulationController;
use App\Http\Controllers\ArchivePhotoController;
use App\Http\Controllers\ArchiveMovieController;
use App\Http\Controllers\MentenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


if(Curl::statMaintenance() == 1) {
    Route::get('/', [MentenController::class, 'index'])->name('maintenance.index');
}
else {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    //Route::get('/', [LandingController::class, 'index'])->name('index');
    
    //Route::get('/{slug}', [LandingController::class, 'index'])->name('index');
    Route::get('error', [ErrorController::class, 'index'])->name('error.index');

    Route::get('ajax/set-flag/{id}', [AjaxController::class, 'set_flag']);
    Route::post('ajax/set-newsletter', [AjaxController::class, 'set_newsletter']);
    Route::post('ajax/set-contactus', [AjaxController::class, 'set_contactus']);
    Route::post('ajax/set-rating', [AjaxController::class, 'set_rating']);
    Route::post('ajax/process-rating', [AjaxController::class, 'process_rating']);
    Route::get('ajax/refresh-captcha',  [AjaxController::class, 'refreshCaptcha'])->name('refresh-captcha');
    Route::get('ajax/response',  [AjaxController::class, 'response'])->name('response');

    Route::get('home', [HomeController::class, 'index'])->name('home.index');
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contactus.index');

    Route::get('contents', [ContentsController::class, 'index'])->name('contents.index');
    Route::post('contents/filter', [ContentsController::class, 'filter'])->name('contents.filter');
    Route::post('contents/search', [ContentsController::class, 'search'])->name('contents.search');
    Route::get('contents/search', [ContentsController::class, 'search'])->name('contents.search');

    Route::get('about/info', [AboutInfoController::class, 'index'])->name('about.info.index');
    Route::get('about/story', [AboutStoryController::class, 'index'])->name('about.story.index');
    Route::get('about/doctrin', [AboutDoctrinController::class, 'index'])->name('about.doctrin.index');
    Route::get('about/logo', [AboutLogoController::class, 'index'])->name('about.logo.index');
    Route::get('about/iad', [AboutIadController::class, 'index'])->name('about.iad.index');
    Route::get('about/intro', [AboutIntroController::class, 'index'])->name('about.intro.index');
    Route::get('about/vision', [AboutVisionController::class, 'index'])->name('about.vision.index');
    Route::get('about/mision', [AboutMisionController::class, 'index'])->name('about.mision.index');
    Route::get('about/program', [AboutProgramController::class, 'index'])->name('about.program.index');
    Route::get('about/command', [AboutCommandController::class, 'index'])->name('about.command.index');


    Route::get('integrity/legal', [IntegrityLegalController::class, 'index'])->name('integrity.legal.index');
    Route::get('integrity/mechanism', [IntegrityMechanismController::class, 'index'])->name('integrity.mechanism.index');
    Route::get('integrity/arrangement', [IntegrityArrangementController::class, 'index'])->name('integrity.arrangement.index');
    Route::get('integrity/accountability', [IntegrityAccountabilityController::class, 'index'])->name('integrity.accountability.index');
    Route::get('integrity/professionalism', [IntegrityProfessionalismController::class, 'index'])->name('integrity.professionalism.index');
    Route::get('integrity/innovation', [IntegrityInnovationController::class, 'index'])->name('integrity.innovation.index');
    Route::get('integrity/supervision', [IntegritySupervisionController::class, 'index'])->name('integrity.supervision.index');

    Route::get('information/unit', [InformationUnitController::class, 'index'])->name('information.unit.index');
    Route::get('information/unit/{id}/read', [InformationUnitController::class, 'read'])->name('information.unit.read');
    Route::get('information/dpo', [InformationDpoController::class, 'index'])->name('information.dpo.index');
    Route::get('information/dpo/{id}/read', [InformationDpoController::class, 'read'])->name('information.dpo.read');
    Route::get('information/structural', [InformationStructuralController::class, 'index'])->name('information.structural.index');
    Route::get('information/structural/{id}/read', [InformationStructuralController::class, 'read'])->name('information.structural.read');
    Route::get('information/service', [InformationServiceController::class, 'index'])->name('information.service.index');
    Route::get('information/service/{id}/read', [InformationServiceController::class, 'read'])->name('information.service.read');
    Route::get('information/infrastructure', [InformationInfrastructureController::class, 'index'])->name('information.infrastructure.index');
    Route::get('information/infrastructure/{id}/read', [InformationInfrastructureController::class, 'read'])->name('information.infrastructure.read');


    Route::get('conference/news', [ConferenceNewsController::class, 'index'])->name('conference.news.index');
    Route::get('conference/news/{id}/read', [ConferenceNewsController::class, 'read'])->name('conference.news.read');
    Route::get('conference/announcement', [ConferenceAnnouncementController::class, 'index'])->name('conference.announcement.index');
    Route::get('conference/announcement/{id}/read', [ConferenceAnnouncementController::class, 'read'])->name('conference.announcement.read');
    Route::get('conference/event', [ConferenceEventController::class, 'index'])->name('conference.event.index');
    Route::get('conference/event/{id}/read', [ConferenceEventController::class, 'read'])->name('conference.event.read');
    Route::get('conference/article', [ConferenceArticleController::class, 'index'])->name('conference.article.index');
    Route::get('conference/article/{id}/read', [ConferenceArticleController::class, 'read'])->name('conference.article.read');
    Route::get('conference/bulletin', [ConferenceBulletinController::class, 'index'])->name('conference.bulletin.index');
    Route::get('conference/bulletin/{id}/read', [ConferenceBulletinController::class, 'read'])->name('conference.bulletin.read');

    Route::get('integrity/supervision', [IntegritySupervisionController::class, 'index'])->name('integrity.supervision.index');
    Route::get('integrity/professionalism', [IntegrityProfessionalismController::class, 'index'])->name('integrity.professionalism.index');
    Route::get('integrity/mechanism', [IntegrityMechanismController::class, 'index'])->name('integrity.mechanism.index');
    Route::get('integrity/legal', [IntegrityLegalController::class, 'index'])->name('integrity.legal.index');
    Route::get('integrity/innovation', [IntegrityInnovationController::class, 'index'])->name('integrity.innovation.index');
    Route::get('integrity/arrangement', [IntegrityArrangementController::class, 'index'])->name('integrity.arrangement.index');
    Route::get('integrity/accountability', [IntegrityAccountabilityController::class, 'index'])->name('integrity.accountability.index');

    Route::get('archive/regulation', [ArchiveRegulationController::class, 'index'])->name('archive.regulation.index');
    Route::get('archive/photo', [ArchivePhotoController::class, 'index'])->name('archive.photo.index');
    Route::get('archive/movie', [ArchiveMovieController::class, 'index'])->name('archive.movie.index');
}
