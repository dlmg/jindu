<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/3/14
 * Time: 15:09
 */

namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
        public function initialize()
        {
            if (!session('user_id') ) {
                $this -> redirect('login/index');
            }
        }
}