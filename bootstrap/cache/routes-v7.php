<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6KTFkVA5XPuKol1t',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QYo2yVE5FB6N7UcT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JB4q2Rix6lcoakyD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OZ4Qcqb3DZfLhVzf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g9nfKZecpcn9oaml',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/(.*)(*:12))/?$}sDu',
    ),
    3 => 
    array (
      12 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'laravel-folio',
          ),
          1 => 
          array (
            0 => 'fallbackPlaceholder',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'laravel-folio' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{fallbackPlaceholder}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:576:"function (\\Illuminate\\Http\\Request $request) {
            $this->terminateUsing = null;

            $mountPaths = collect($this->mountPaths)->filter(
                fn (\\Laravel\\Folio\\MountPath $mountPath) => str_starts_with(mb_strtolower(\'/\'.$request->path()), $mountPath->baseUri)
            )->all();

            return (new \\Laravel\\Folio\\RequestHandler(
                $mountPaths,
                $this->renderUsing,
                fn (\\Laravel\\Folio\\Pipeline\\MatchedView $matchedView) => $this->lastMatchedView = $matchedView,
            ))($request);
        }";s:5:"scope";s:26:"Laravel\\Folio\\FolioManager";s:4:"this";O:26:"Laravel\\Folio\\FolioManager":4:{s:13:"' . "\0" . '*' . "\0" . 'mountPaths";a:12:{i:0;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:51:"/Users/airon/dev/www/eurekabe/resources/views/pages";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:1;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:59:"/Users/airon/dev/www/eurekabe/Modules/Admin/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:2;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:62:"/Users/airon/dev/www/eurekabe/Modules/Advocate/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:3;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:58:"/Users/airon/dev/www/eurekabe/Modules/Auth/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:4;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:60:"/Users/airon/dev/www/eurekabe/Modules/Common/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:5;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:58:"/Users/airon/dev/www/eurekabe/Modules/Exam/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:6;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:61:"/Users/airon/dev/www/eurekabe/Modules/Explore/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:7;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:58:"/Users/airon/dev/www/eurekabe/Modules/File/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:8;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:63:"/Users/airon/dev/www/eurekabe/Modules/Messaging/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:9;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:61:"/Users/airon/dev/www/eurekabe/Modules/Payment/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:10;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:61:"/Users/airon/dev/www/eurekabe/Modules/Student/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}i:11;O:23:"Laravel\\Folio\\MountPath":4:{s:10:"middleware";O:37:"Laravel\\Folio\\PathBasedMiddlewareList":1:{s:10:"middleware";a:1:{s:1:"*";a:0:{}}}s:4:"path";s:58:"/Users/airon/dev/www/eurekabe/Modules/Test/resources/views";s:7:"baseUri";s:1:"/";s:6:"domain";N;}}s:14:"' . "\0" . '*' . "\0" . 'renderUsing";N;s:17:"' . "\0" . '*' . "\0" . 'terminateUsing";N;s:18:"' . "\0" . '*' . "\0" . 'lastMatchedView";N;}s:4:"self";s:32:"0000000000000b190000000000000000";}}',
        'as' => 'laravel-folio',
      ),
      'fallback' => true,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'fallbackPlaceholder' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6KTFkVA5XPuKol1t' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000b1c0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::6KTFkVA5XPuKol1t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QYo2yVE5FB6N7UcT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:350:"function () {
                    \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);

                    return \\Illuminate\\Support\\Facades\\View::file(\'/Users/airon/dev/www/eurekabe/vendor/laravel/framework/src/Illuminate/Foundation/Configuration\'.\'/../resources/health-up.blade.php\');
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000b170000000000000000";}}',
        'as' => 'generated::QYo2yVE5FB6N7UcT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JB4q2Rix6lcoakyD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:44:"function () {
    return \\view(\'welcome\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000b2d0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JB4q2Rix6lcoakyD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OZ4Qcqb3DZfLhVzf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'api/broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'controller' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
        'as' => 'generated::OZ4Qcqb3DZfLhVzf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g9nfKZecpcn9oaml' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:sanctum',
        ),
        'uses' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'controller' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
        'as' => 'generated::g9nfKZecpcn9oaml',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
