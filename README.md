READ ME

INSTRUCTION

for fresh installation, go to ```https://github.com/HansSchouten/Laravel-Pagebuilder```

---------------------------------------------

FOR CONFIGURATION SETUP: 

Instruction

Copy the ```.env.example``` file and rename it to ```.env``` 

Edit the ```.env``` configuration

Set ```APP_URL``` to ```APP_URL=http://localhost:8000```

Set ```DB_DATABASE``` to ```DB_DATABASE=pagebuilder_db```

Run ```composer update```

Run ```php artisan migrate```


---------------------------------------------

Open the browser and go to ```http://localhost:8000/admin```

Use this credential
```
username: admin
password: 123123
```

---------------------------------------------

HOW TO CHANGE THE COMPOMENT BLOCK ICONS

page builder change icon
file: 
```FILE 
vendor\hansschouten\phpagebuilder\src\Modules\GrapesJS\Block\BlockAdapter.php 
```

method: ```getBlockManagerArray()```

changes:
change value of ```Variable $iconClass ```

```$iconClass = $this->getCorrectClassIcon ($data['label']); ```

```ADD_FUNCTION
    public function getCorrectClassIcon ($iconLabel) 
    {
        $iconClass = '';

        switch ($iconLabel) {
            case 'Header':
                $iconClass = 'fa fa-header';
            break;

            case 'Hello world':
                $iconClass = 'fa fa-font';
            break;

            default:
                $iconClass = 'fa fa-bars';
            break; 
        }

        return $iconClass;
    }
```
---------------------------------------------

INSTALL PACKAGE USING COMPOSER
```COMPOSER 
composer require spatie/browsershot 
```

---------------------------------------------

OTHER REFERENCE
```REFENCE 
url: https://github.com/HansSchouten/Laravel-Pagebuilder/issues/8
```

---------------------------------------------

Add cdn for jquery in ```generator-view.php```
```SCRIPT
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
```
---------------------------------------------

To set an image or a category you can create a ```config.php``` file in the folder of a block and create an array with ```"category" => "Your name here" ```
```CONTENT
<?php
return [
    'category' => 'Group name',
];
```

---------------------------------------------

Create controller ```PageBuilderController.php ```

```CONTENT
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
```

---------------------------------------------

Create controller ```CONTROLLER WebsiteController.php ```
```CONTENT
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PageBuilder;
use PHPageBuilder\PHPageBuilder;
use PHPageBuilder\Theme;
use PHPageBuilder\Modules\GrapesJS\PageRenderer;
use PHPageBuilder\Repositories\PageRepository;
use PHPageBuilder\Repositories\PageTranslationRepository;


class WebsiteController extends Controller 
{
    public function uri()
    {
        $currentUrl = phpb_current_relative_url();
        $urlTitle = substr($currentUrl, 1);
        $parameters = array();
        array_push($parameters, $urlTitle);
        $page = (new PageTranslationRepository)->findWhere("route", $urlTitle);
        return $page;
        return phpb_e(phpb_full_url(phpb_current_relative_url()));
        $pageId = 5;
        
        $theme = new Theme(config('pagebuilder.theme'), config('pagebuilder.theme.active_theme'));
        $page = (new PageRepository)->findWithId($pageId);
        $pageRenderer = new PageRenderer($theme, $page);
        $html = $pageRenderer->render();
        return $html;



        $pageBuilder = app()->make('phpPageBuilder');
        $pageBuilder->handlePublicRequest();
        // return $pageBuilder;
        // return phpb_current_relative_url();
        return phpb_e(phpb_full_url(phpb_current_relative_url()));
    }
    // public function uri()
    // {
    //     // return "asd";
    //     $pageBuilder = app()->make('phpPageBuilder');
    //     $pageBuilder->handlePublicRequest();
    //     return "ok";
    //     return $pageBuilder;
    // }
}
```
