<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\LDAPModel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto'
    ];

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
    
    public function getUserFromEmployeeNumber(){
        $ldapModel = new LDAPModel();
        $employeenumber = $this->employeenumber;
        $filter = "(employeenumber=" . $employeenumber . ")";
        $attributes = array('cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto');
        $result = $ldapModel->doSearch($filter, $attributes);
        $result = $ldapModel->formatEntries( $result );
        if( $result ){
            //$result = (object) array_shift($result);
            $result = array_shift($result);
            $this->setDataArray($result);
            return $this;
        }
    }
    
    public function getUserFromEmail(){
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
            return $this;
        }
    }
    
}
