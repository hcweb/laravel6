<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/7/25
 * Time: 10:01
 */

namespace App\Traits;


trait BreadcrumbTrait
{
    public function getBackendBreadcrumbs()
    {
        \View::share('breadcrumbs', getBreadcrumbs());
    }
}