<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use TypiCMS\Modules\Faceofzzlandings\Repositories\FaceofzzlandingInterface;
use TypiCMS\Modules\Musiccards\Repositories\MusiccardInterface;
use TypiCMS\Modules\Musiclandingpages\Repositories\MusiclandingpageInterface;
use TypiCMS\Modules\Pages\Repositories\PageInterface;

class StaticPagesController extends Controller {

    private $pageRepository;
    private $musicLandingPageInterface;
    private $faceofzzlandingInterface;

    public function __construct(PageInterface $pageInterface,
                                MusiclandingpageInterface $musicLandingPageInterface,
                                FaceofzzlandingInterface $faceofzzlandingInterface,
                                MusiccardInterface $musicCardInterface) {
        $this->pageRepository = $pageInterface;
        $this->musicLandingPageInterface = $musicLandingPageInterface;
        $this->faceofzzlandingInterface = $faceofzzlandingInterface;
        $this->musicCardInterface = $musicCardInterface;

    }

    public function getAboutUs(){
        return view('frontend.static_pages.about_us');
    }

    public function getFaqs(){
        return view('frontend_zz.static_pages.faqs');
    }

    public function getFaceOfZZ(){
        $faceofzzLandingPage = $this->faceofzzlandingInterface->byId(1);

        return view('frontend_zz.faceofzz.face_of_zz', compact('faceofzzLandingPage'));
    }

    public function getComplaintz(){
        return view('frontend.static_pages.complaintz');
    }

    public function getMusic(){

        $musicLandingPage = $this->musicLandingPageInterface->byId(1);
        $musicCards = $this->musicCardInterface->allSortedByColumn('position',true,[],true);
//        $musicCards = $this->musicCardInterface->all([],true);

        $mainArtist = null;
        if($musicCards->count()){
            $mainArtist = $musicCards->get(0);
        }

        return view('frontend_zz.music.music', compact(
            'musicLandingPage',
            'mainArtist',
            'musicCards'
        ));
    }

}
