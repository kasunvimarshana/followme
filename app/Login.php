<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Session;
use App\User;
use App\LDAPModel;

class Login extends Model
{
    //
    const PREFIX_VAL = self::class . "";
    const LOGIN_CHECK_KEY = self::class . "IS_LOGIN";
    
    function __construct(){
        //Session::put('key', 'value');
        //Session::push('user.teams', 'developers');
        //$value = Session::get('key', 'default');
        //Session::has('users')
        //Session::forget('key'); <- remove item
        //Session::flush(); <- remove all item
    }
    
    public static function setLoginTrue(){
        Session::put(self::LOGIN_CHECK_KEY, true);
    }
    
    public static function isLogin(){
        return Session::get(self::LOGIN_CHECK_KEY, false);
    }
    
    public function __toString(){
        //return Login::class;
        //return self::class;
        return get_class($this);
    }
    
    public static function setData($key, $value){
        $key = self::PREFIX_VAL . $key;
        Session::put($key, $value);
    }
    
    public static function getData($key){
        $key = self::PREFIX_VAL . $key;
        return Session::get($key, null);
    }
    
    public static function flushData(){
        Session::flush();
    }
    
    public static function setUserData($user){
        /*self::setData("userprincipalname", $user->userprincipalname);
        self::setData("employeenumber", $user->employeenumber);
        self::setData("cn", $user->cn);
        self::setData("title", $user->title);
        self::setData("description", $user->description);
        self::setData("displayname", $user->displayname);
        self::setData("department", $user->department);
        self::setData("company", $user->company);
        self::setData("mail", $user->mail);
        self::setData("mobile", $user->mobile);
        self::setData("directreports", $user->directreports);
        self::setData("thumbnailphoto", $user->thumbnailphoto);*/
        //self::setData("userprincipalname", 'KasunV@brandix.com');
        self::setData("userprincipalname", 'SumithK@brandix.com');
        self::setData("employeenumber", '27611');
        self::setData("cn", 'kasunv');
        self::setData("title", $user->title);
        self::setData("description", $user->description);
        self::setData("displayname", $user->displayname);
        self::setData("department", $user->department);
        self::setData("company", $user->company);
        //self::setData("mail", 'KasunV@brandix.com');
        self::setData("mail", 'SumithK@brandix.com');
        self::setData("mobile", $user->mobile);
        self::setData("directreports", $user->directreports);
        self::setData("thumbnailphoto", $user->thumbnailphoto);
    }
    
    public static function unsetUserData(){
        self::setData("userprincipalname", null);
        self::setData("employeenumber", null);
        self::setData("cn", null);
        self::setData("title", null);
        self::setData("description", null);
        self::setData("displayname", null);
        self::setData("department", null);
        self::setData("company", null);
        self::setData("mail", null);
        self::setData("mobile", null);
        self::setData("directreports", null);
        self::setData("thumbnailphoto", null);
    }
    
    public static function getUserData(){
        $user = new User();
        $user->userprincipalname = self::getData("userprincipalname");
        $user->employeenumber = self::getData("employeenumber");
        $user->cn = self::getData("cn");
        $user->title = self::getData("title");
        $user->description = self::getData("description");
        $user->displayname = self::getData("displayname");
        $user->department = self::getData("department");
        $user->company = self::getData("company");
        $user->mail = self::getData("mail");
        $user->mobile = self::getData("mobile");
        $user->directreports = self::getData("directreports");
        $user->thumbnailphoto = self::getData("thumbnailphoto");
        //$user->getUser();
        return $user;
    }
    
    public static function doLogin($username, $password){
        $ldapModel = new LDAPModel();
        $user = new User();
        /*if($ldapModel->isBind($username, $password)){
            self::setLoginTrue();
            $user->mail = $username;
            $user->getUser();
            self::setUserData($user);
        }*/
        self::setLoginTrue();
        self::setUserData($user);
    }
    
    public static function doLogout(){
        self::unsetUserData();
        Session::put(self::LOGIN_CHECK_KEY, false);
        self::flushData();
    }
    
}
