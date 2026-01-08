<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;

// Setup Blade
$container = new Container;
$filesystem = new Filesystem;
$eventDispatcher = new Dispatcher($container);

// Create cache directory if it doesn't exist
$cachePath = __DIR__ . '/../app/views/cache';
if (!file_exists($cachePath)) {
    mkdir($cachePath, 0777, true);
}

// Setup view finder
$viewFinder = new FileViewFinder($filesystem, [__DIR__ . '/../app/views']);

// Setup Blade compiler
$bladeCompiler = new BladeCompiler($filesystem, $cachePath);

// Setup engine resolver
$engineResolver = new EngineResolver;
$engineResolver->register('blade', function () use ($bladeCompiler) {
    return new CompilerEngine($bladeCompiler);
});

// Create the view factory
$blade = new Factory($engineResolver, $viewFinder, $eventDispatcher);

// Simple routing
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

require_once __DIR__ . '/../app/controllers/StudentController.php';
$controller = new StudentController($conn, $blade);

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit($id);
        break;
    case 'update':
        $controller->update($id);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    default:
        $controller->index();
}
?>