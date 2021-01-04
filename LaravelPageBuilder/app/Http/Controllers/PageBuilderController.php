<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PHPageBuilder\PHPageBuilder;
use PHPageBuilder\Theme;
use PHPageBuilder\Modules\GrapesJS\PageRenderer;
use PHPageBuilder\Repositories\PageRepository;

use App\Models\PageBuilder;


class PageBuilderController extends Controller 
{
    public function build($pageId = null)
    {
        $route = $_GET['route'] ?? null;
        $action = $_GET['action'] ?? null;
        $pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
        $pageRepository = new \PHPageBuilder\Repositories\PageRepository;
        $page = $pageRepository->findWithId($pageId);
    
        $phpPageBuilder = app()->make('phpPageBuilder');
        $pageBuilder = $phpPageBuilder->getPageBuilder();
    
        $customScripts = view("pagebuilder.scripts")->render();
        $pageBuilder->customScripts('head', $customScripts);
    
        $pageBuilder->handleRequest($route, $action, $page);
    }

    public function page($pageId = null) 
    { 
        $pageRepository = new \PHPageBuilder\Repositories\PageRepository; 
        $page = $pageRepository->findWithId($pageId); 
        return $page; 
    }

    public function viewPage($pageId)
    {
        return $pageId;
        $theme = new Theme(config('pagebuilder.theme'), config('pagebuilder.theme.active_theme'));
        $page = (new PageRepository)->findWithId($pageId);
        $pageRenderer = new PageRenderer($theme, $page);
        $html = $pageRenderer->render();
        return $html;
    }
}
