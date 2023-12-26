<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:29 PM
 **/

namespace app\lib;

use JetBrains\PhpStorm\NoReturn;
use voku\helper\AntiXSS;

/**
 * Class App.
 * This class handles getting params and assets configurations and then makes it "callable" on the View.
 * Besides, this class also performs any methods that affect the View.
 */
class App
{

    /**
     * @var Csrf $csrf Instance of the Csrf class
     */
    public Csrf $csrf;
    /**
     * @var AntiXSS $xss Instance of the AntiXSS class
     */
    public AntiXSS $xss;
    /**
     * @var array|mixed $assets Web assets
     */
    public array $assets = [];
    /**
     * @var array|mixed $params Web parameters
     */
    public array $params = [];
    /**
     * @var array|mixed $permission Page permission
     */
    public array $permission = [];

    /**
     * Asset constructor.
     */
    public function __construct()
    {
        $this->csrf       = new Csrf();
        $this->xss        = new AntiXSS();
        $this->assets     = include __DIR__.'/../config/assets.php';
        $this->params     = include __DIR__.'/../config/params.php';
        $this->permission = include __DIR__.'/../config/permission.php';
    }

    /**
     * Call a function by the given name.
     *
     * @param  string  $className
     *
     * @return mixed
     */
    public function call(string $className): mixed
    {
        $class = '\app\functions\\'.$className;

        return new $class();
    }

    /**
     * Register assets.
     */
    public function registerAssets()
    {
        $cssTags = '';
        $jsTags  = '';
        if ( ! empty($this->assets)) {
            foreach ($this->assets['css'] as $css) {
                $cssTags .= '<link rel="stylesheet" type="text/css" href="/assets/'.$css.'">';
            }
            foreach ($this->assets['js'] as $js) {
                $jsTags .= '<script src="/assets/'.$js.'" defer></script>';
            }
            foreach ($this->assets['jquery'] as $jquery) {
                $jsTags .= '<script src="/assets/'.$jquery.'"></script>';
            }
        }
        echo $cssTags;
        echo $jsTags;
    }

    /**
     * Register optional css.
     *
     * @param  string  $style
     */
    public function registerCss(string $style)
    {
        echo '<style>'.$style.'</style>';
    }

    /**
     * Register optional javascript.
     *
     * @param  string  $script
     */
    public function registerJs(string $script)
    {
        echo '<script>'.$script.'</script>';
    }

    /**
     * Redirect to a specific URL.
     *
     * @param  string  $url
     */
    #[NoReturn] public function redirect(string $url)
    {
        header('Location: '.$url);
        exit();
    }

    /**
     * Go to the homepage.
     */
    #[NoReturn] public function goHome()
    {
        header('Location: /');
        exit();
    }

    /**
     * Go to the previous page.
     */
    #[NoReturn] public function previous()
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }

    /**
     * Get permission of the given page name.
     *
     * @param  string  $page
     * @param  string  $key
     *
     * @return mixed|void
     */
    public function getPermission(string $page, string $key = '')
    {
        if (empty($this->permission[$page])) {
            die('Permission of page "'.$page.'" is not configured yet.');
        }

        return empty($key) ? $this->permission[$page] : $this->permission[$page][$key];
    }
}
