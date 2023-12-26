<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/5/2023
 * @time    12:12 PM
 */

namespace app\functions;

use app\lib\App;
use app\middlewares\Authentication;

class Dashboard extends Authentication
{

    /**
     * @var App $app Instance of the "App" class
     */
    public App $app;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->app = new App();
        if ($this->user === null) {
            $this->app->redirect('/login');
        }
    }
}
