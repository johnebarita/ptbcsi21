<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Controllers\ZKLib\ZKLib;
use CodeIgniter\Controller;
use eftec\bladeone\BladeOne;
use Illuminate\Support\Carbon;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:

        service('eloquent');
        service('uri');
        $this->session = \Config\Services::session();
        $this->security = \Config\Services::security();
        $this->zk = new ZKLib('192.168.1.100');

        $views = __DIR__ . '/../Views';
        $cache = __DIR__ . '/cache';
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }

    public function template($page, $data)
    {
        echo view('includes\header', $data);
        echo view($page, $data);
        echo view('includes\footer', $data);
    }

    public function view($view = null, $data = [])
    {
        $views = __DIR__ . '/../Views';
        $cache = __DIR__ . '/cache';
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO); // MODE_DEBUG allows to pinpoint troubles.
        return $blade->run($view, $data); // it calls /views/hello.blade.php
    }
}
