<?php

namespace App\Http\Controllers\Common;

use App\Handlers\TranslateHandler;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslateController extends Controller
{
    use ApiResponseTrait;
    public function translate($text)
    {
        $result = (new TranslateHandler())->translate($text);
        if ($result) {
            return $this->sendSuccess('翻译成功!',$result);
        } else {
            return $this->sendError('翻译失败!');
        }
    }
}
