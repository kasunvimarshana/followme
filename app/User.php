<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\LDAPModel;

class User extends Authenticatable
{
    use Notifiable;
    
    // table name
    protected $table = "users";
    // primary key
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto'
    ];
    /*protected $fillable = [
        'name', 'email', 'password'
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function setDataArray($attributes){
        if( (!is_array($attributes)) ){
            return false;
        }
        foreach($attributes as $field=>$value){
          $this->$field = $value;
        }
    }
    
    public function getUser(){
        $ldapModel = new LDAPModel();
        $mail = $this->mail;
        $filter = "(mail=" . $mail . ")";
        $attributes = array('cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto');
        $result = $ldapModel->doSearch($filter, $attributes);
        $result = $ldapModel->formatEntries( $result );
        if( $result ){
            //$result = (object) array_shift($result);
            $result = array_shift($result);
            $this->setDataArray($result);
        }
        
        return $this;
    }
    
    public function findUsers($filter = '(mail=*)'){
        $users = array();
        $ldapModel = new LDAPModel();
        $attributes = array('cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto');
        $results = $ldapModel->doSearch($filter, $attributes);
        $results = $ldapModel->formatEntries( $results );
        if( $results ){
            foreach($results as $result){
                $user = new User();
                $user->setDataArray($result);
                $user->thumbnailphoto = null;
                array_push($users, $user);
            }
        }
        
        return $users;
    }
    
}
