<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
                                 'enableBeforeRedirect' => false,
                             ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
                                 'authorize' => 'Controller',
                                 'authenticate' => [
                                     'Form' => [
                                         'fields' => [
                                             'username' => 'email',
                                             'password' => 'password'
                                         ]
                                     ]
                                 ],
                                 'loginAction' => [
                                     'controller' => 'Users',
                                     'action' => 'login'
                                 ],
                                 //未確認の場合、直前のページに戻る
                                 'unauthorizedRedirect' => $this->referer()
                             ]);
        //displayアクションを許可して、PagesControllerが引き続き動作するようにします。
        //また、読み取り専用のアクションを有効にする
        $this->Auth->allow(['display', 'view', 'index']);
    }

    public function isAuthorized($user)
    {
        //デフォルトではアクセスを拒否する
        return false;
    }
}
