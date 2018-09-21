<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/20/2018
 * Time: 3:04 PM
 */

namespace Modules\Api\Http\Controllers\App;

use App\Repositories\AdsConfigRepository;
use App\Repositories\IapRepository;
use App\Repositories\RelatedsAppRepository;
use Modules\Api\Http\Controllers\ApiController;
use App\Repositories\AppRepository;
use App\Common\Gamota\RequestApi;
use App\Common\Untils\Permission;
use App\Common\Untils\Regular;
use Illuminate\Http\Request;

class AppController extends ApiController
{
    protected $appRepository;
    protected $adsConfigRepository;
    protected $relatedsAppRepository;
    protected $iapRepository;

    public function __construct(AppRepository $appRepository, AdsConfigRepository $adsConfigRepository, RelatedsAppRepository $relatedsAppRepository, IapRepository $iapRepository)
    {
        parent::__construct();
        $this->middleware(Regular::PREFIX_CMS);
        $this->appRepository = $appRepository;
        $this->adsConfigRepository = $adsConfigRepository;
        $this->relatedsAppRepository = $relatedsAppRepository;
        $this->iapRepository = $iapRepository;
    }

    public function app(Request $request)
    {

        if (empty(auth()->guard(Regular::PREFIX_CMS)->user()) && empty($request->all())) {
            return $this->respondWithError(108);
        } else {
            if ($this->checkKeySign($request)) {
                return $this->respondWithError(105);
            }
            $appData = $this->getApp();
            return $this->respondData('Success', 0, $appData);
        }

    }

    protected function getApp($appId = 8)
    {
        $app = $this->appRepository->find($appId)->toArray();
        $app['configuration']['ads_config'] = $this->getAdsConfigWithAppId($appId);
        $app['related_apps'] = $this->getRelatedAppWithAppId($appId);
        $app['iaps'] = $this->getIapWithAppId($appId);
        return $app;
    }

    protected function getAdsConfigWithAppId($appId = null)
    {
        if ($appId) {
            return $this->adsConfigRepository->all()->where('app_id', $appId);
        }
        return [];
    }

    protected function getRelatedAppWithAppId($appId = null)
    {
        if ($appId) {
            return $this->relatedsAppRepository->all()->where('app_id', $appId);
        }
        return [];
    }

    protected function getIapWithAppId($appId = null)
    {
        if ($appId) {
            return $this->iapRepository->all()->where('app_id', $appId);
        }
        return [];
    }


}