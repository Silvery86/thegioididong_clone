<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/5/2023
 * @time    12:11 PM
 */

namespace app\functions;

use app\lib\App;
use app\lib\Database;
use app\middlewares\Authentication;
use app\traits\RoleFilterTrait;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\Shared\ZipArchive;

class Website extends Authentication
{

    use RoleFilterTrait;

    /**
     * @var \app\classes\Website $_website Instance of the "Website" model
     */
    public \app\classes\Website $_website;
    /**
     * @var ZipArchive $zip Instance of "ZipArchie" class
     */
    public ZipArchive $zip;
    /**
     * @var App $app Instance of the "App" class
     */
    public App $app;
    /**
     * @var string $domain_name Domain name
     */
    public string $domain_name;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->app      = new App();
        $this->_website = new \app\classes\Website();
        $this->zip      = new ZipArchive();
        if ($this->user === null) {
            $this->app->redirect('/login');
        }
        if ( ! $this->hasPermission($this->user, $this->app->getPermission('create-website'))) {
            $this->session->setFlash('danger', 'Hehehe, Bạn đâu có đủ quyền vào đếyyyy');
            $this->app->goHome();
        }
        $this->getPostData();
    }

    /**
     * Create new website.
     * @throws Exception
     */
    public function createWebsite()
    {
        if ( ! empty($this->domain_name)) {
            $exitedWebsite = \app\classes\Website::findOne(['domain' => $this->domain_name]);
            if ($exitedWebsite) {
                $this->session->setFlash('danger', 'Đã tồn tại website "'.$this->domain_name.'"');
                $this->app->redirect('/create-website');
            }
            $data = [
                'tmp_domain' => $this->domain_name,
                'domain'     => $this->domain_name,
                'created_at' => time(),
                'updated_at' => time(),
            ];
            if ($this->_website->save($data)) {
                $this->extractSourceCode();
                $this->session->setFlash(
                    'success',
                    'Tạo thành công! Link đăng nhập: <a href="http://'.$this->domain_name.'.blue-dashboard.com" target="_blank">http://'.$this->domain_name.'.blue-dashboard.com</a>'
                );
            } else {
                $this->session->setFlash('danger', 'Tạo thất bại!');
            }
            $this->app->redirect('/create-website');
        }
    }

    /**
     * Extract source code to storage folder.
     * @throws Exception
     */
    private function extractSourceCode()
    {
        $hostname      = 'blue-dashboard.com';
        $path          = __DIR__.'/../storage/';
        $websiteFolder = $path.$this->domain_name;
        if ( ! file_exists($websiteFolder)) {
            mkdir($websiteFolder, 0777, true);
        }
        if ($this->zip->open($path.'website.zip') === true) {
            $this->zip->extractTo($websiteFolder);
            $this->zip->close();
        }
        $this->createConfigFile($hostname, $path);
    }

    /**
     * Create config file.
     *
     * @param  string  $hostname
     * @param  string  $path
     */
    private function createConfigFile(string $hostname, string $path)
    {
        shell_exec('chown -R www-data:www-data /var/www/html/blue-dashboard/storage');
        shell_exec('chown -R www-data:www-data /var/www/html/blue-dashboard/storage/*');
        $confDomain = $this->domain_name.'.'.$hostname;
        $template   = '<VirtualHost *:80>
DocumentRoot "/var/www/html/blue-dashboard/storage/'.$this->domain_name.'"
ServerAdmin admin@'.$confDomain.'
ServerName '.$confDomain.'
<Directory /var/www/html/blue-dashboard/storage/'.$this->domain_name.'>
Options Indexes FollowSymLinks
AllowOverride All
Require all granted
</Directory>
ErrorLog "${APACHE_LOG_DIR}/'.$confDomain.'.err"
CustomLog "${APACHE_LOG_DIR}/'.$confDomain.'.log" combined
</VirtualHost>';
        file_put_contents($path.$confDomain.'.conf', $template, FILE_APPEND);
        $shell = '
#!bin/sh
sudo cp -r /var/www/html/blue-dashboard/storage/'.$confDomain.'.conf /etc/apache2/sites-available/'.$confDomain.'.conf
sudo a2ensite '.$confDomain.'.conf
sudo systemctl reload apache2.service';
        file_put_contents($path.$confDomain.'.sh', $shell, FILE_APPEND);
        shell_exec('chmod -R 775 /var/www/html/blue-dashboard/storage/'.$confDomain.'.conf');
        shell_exec('chmod -R 775 /var/www/html/blue-dashboard/storage/'.$confDomain.'.sh');
        shell_exec('sh '.$path.$confDomain.'.sh');
    }

    /**
     * Get login data.
     */
    private function getPostData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ( ! empty($_POST['domain_name'])) {
                if (filter_var($_POST['domain_name'], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
                    if (substr_count($_POST['domain_name'], '.') !== 0) {
                        $this->session->setFlash('danger', '"'.$_POST['domain_name'].'" is not valid domain');
                    } else {
                        $this->domain_name = $this->app->xss->xss_clean($_POST['domain_name']);
                    }
                } else {
                    $this->session->setFlash('danger', '"'.$_POST['domain_name'].'" is not valid domain');
                }
            }
            $this->app->csrf->verifyRequest();
        }
    }
}
