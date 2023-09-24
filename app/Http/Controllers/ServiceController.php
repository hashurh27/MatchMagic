<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Repositories\EscortsRepository;
use App\Http\Repositories\RegionsRepository;
use App\Http\Repositories\PagesRepository;
use App\Http\Repositories\SubcategoriesRepository;
use App\Http\Repositories\SubjectsRepository;
use App\Http\Repositories\SettingsRepository;

class ServiceController extends Controller
{

	private $escortsRepository;
	private $regionsRepository;
	private $pagesRepository;
	private $subcategoriesRepository;
    private $subjectsRepository;
    private $settingsRepository;

	public function __construct(
		EscortsRepository $escortsRepository,
		RegionsRepository $regionsRepository,
		PagesRepository   $pagesRepository,
		SubcategoriesRepository $subcategoriesRepository,
        SubjectsRepository $subjectsRepository,
        SettingsRepository $settingsRepository
		) {
		$this->escortsRepository = $escortsRepository;
		$this->regionsRepository = $regionsRepository;
		$this->pagesRepository 	 = $pagesRepository;
		$this->subcategoriesRepository = $subcategoriesRepository;
        $this->subjectsRepository = $subjectsRepository;
        $this->settingsRepository = $settingsRepository;
	}

    public function getEscorts($limit = null, $rand = null) {
    	return json_encode($this->escortsRepository->getRandom(10));
    }

    public function getEscortsByRegion($region = 1, $ageMin = null, $ageMax = null) {
    	return json_encode($this->escortsRepository->getByRegion($region, $ageMin, $ageMax));
    }

    public function getEscortsBySubcategory($sc_id = 1) {
        return(json_encode($this->escortsRepository->getBySubcategory($sc_id)));
    }

    public function getEscort($esc_id = 1) {
        return json_encode($this->escortsRepository->getById($esc_id));
    }

    public function getEscortsRandom($take = 12, $available = true) {
        return json_encode($this->escortsRepository->getRandom($take, $available));
    }

    // --------------------------------
    //  Regions
    // --------------------------------
    public function getRegions() {
    	return json_encode($this->regionsRepository->getRegions());
    }

    public function getRegion($region_id = 1) {
        return json_encode($this->regionsRepository->getRegion($region_id));
    }

    // --------------------------------
    // Pages
    // --------------------------------

    public function getPage($page_id = 1) {
    	return json_encode($this->pagesRepository->getPage($page_id));
    }

    public function getPageTitles() {
        return json_encode($this->pagesRepository->getTitles());
    }

    // --------------------------------
    // Subcategories
    // --------------------------------

    public function getSubcategory($sc_id = null) {
    	return json_encode($this->subcategoriesRepository->getSubcategory($sc_id));
    }

    public function getSubcategoryTitles() {
        return json_encode($this->subcategoriesRepository->getTitles());
    }

    // --------------------------------
    // Subjects
    // --------------------------------

    public function getSubject($subject_id = 1) {
        return json_encode($this->subjectsRepository->getSubject($subject_id));
    }

    public function getSubjectTitles() {
        return json_encode($this->subjectsRepository->getTitles());
    }

    // --------------------------------
    // Settings
    // --------------------------------

    public function getSetting($setting) {
        return json_encode(['value' =>  $this->settingsRepository->parseSettings($setting)]);
    }

    // --------------------------------
    // Settings
    // --------------------------------

    public function getGeoProfiles() {
        $clientIp = \Request::ip();
        return file_get_contents("http://ip-api.com/json/" . $clientIp);
    }
}
