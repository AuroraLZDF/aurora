<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        // Web 中间件组，应用于 routes/web.php 路由文件
        'web' => [
            // Cookie 加密解密
            \App\Http\Middleware\EncryptCookies::class,
            // 将 Cookie 添加到响应中
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            // 开启session
            \Illuminate\Session\Middleware\StartSession::class,
            // 认证用户，此中间件以后 Auth 类才能生效
            // 见：https://d.laravel-china.org/docs/5.5/authentication
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // 将系统的错误数据注入到视图变量 $errors 中
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // 检验 CSRF ，防止跨站请求伪造的安全威胁
            // 见：https://d.laravel-china.org/docs/5.5/csrf
            \App\Http\Middleware\VerifyCsrfToken::class,
            // 处理路由绑定
            // 见：https://d.laravel-china.org/docs/5.5/routing#route-model-binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            // 记录用户最后活跃时间
            \App\Http\Middleware\RecordLastActivedTime::class,
        ],

        // API 中间件组，应用于 routes/api.php 路由文件
        'api' => [
            // 使用别名来调用中间件
            // 请见：https://d.laravel-china.org/docs/5.5/middleware#为路由分配中间件
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    // 中间件别名设置，允许你使用别名调用中间件，例如上面的 api 中间件组调用
    protected $routeMiddleware = [
        // 只有登录用户才能访问
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        // HTTP Basic Auth 认证
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        // 处理路由绑定
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // 用户授权功能
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // 只有游客才能访问，在 register 和 login 请求中使用，只有未登录用户才能访问这些页面
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // 访问节流，类似于 『1 分钟只能请求 10 次』的需求，一般在 API 中使用
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // bbs auth
        'auth.bbs' => \App\Http\Middleware\AuthBbs::class,
        // admin auth
        'auth.admin' => \App\Http\Middleware\AuthAdmin::class,
    ];
}