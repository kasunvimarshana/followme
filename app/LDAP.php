<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LDAP extends Model
{
    
    protected $ldaphost = "brandixlk.org"; //ldap://brandixlk.org
    protected $ldapport = 389;
    protected $ldapconn = null;
    
    protected $bind_rdn = "kasunv@brandix.com";
    protected $bind_password = "Brdx@9000";
    
    function __construct() {
        //parent::__construct();
        $this->doConnect()->doBind();
    }
    function __destruct() {
        //print "Destroying " . __CLASS__ . "\n";
        $this->doUnbind()->doClose();
    }
    /**
     * execute ldap_connect function
     * @return $this
     */
    public function doConnect(){
        //$ldapconn = ldap_connect($ldaphost, $ldapport) or die ("Could not connect to $ldaphost");
        $this->ldapconn = @ldap_connect($this->ldaphost, $this->ldapport);
        
        @ldap_set_option($this->ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        @ldap_set_option($this->ldapconn, LDAP_OPT_REFERRALS, 0);
        
        //@ldap_bind($this->ldapconn);
        
        return $this;
    }
    /**
     * execute ldap_close function
     * @return $this
     */
    public function doClose(){
        @ldap_close($this->ldapconn);
        
        return $this;
    }
    /**
     * execute ldap_close function
     * @return $this
     */
    public function doUnbind(){
        @ldap_unbind($this->ldapconn);
        
        return $this;
    }
    /**
     * execute ldap_bind function
     * @return $this
     */
    public function doBind(){
        // binding to ldap server
        // $ldapbind = @ldap_bind($link_identifier, $bind_rdn, $bind_password);
        $ldapbind = @ldap_bind($this->ldapconn, $this->bind_rdn, $this->bind_password);
        
        return $this;
    }
    /**
     * execute ldap_bind function
     * @return boolean
     */
    public function isBind($bind_rdn, $bind_password){
        $ldapbind = false;
        $ldapbind = @ldap_bind($this->ldapconn, $bind_rdn, $bind_password);
        
        return $ldapbind;
    }
    /**
     * execute ldap_search function
     * $ldaptree = 'OU=Users,OU=BLIW,OU=BLI,OU=Brandix Users,DC=brandixlk,DC=org';[$basedn = array('dmdName=users,dc=foo,dc=fr', 'dmdName=users,dc=bar,dc=com');]
     * $attributes = array('cn', 'sn', 'title', 'description', 'displayname', 'department', 'company', 'employeenumber', 'mailnickname', 'mail', 'mobile', 'userprincipalname', 'directreports', 'thumbnailphoto');
     * @return array
     */
    public function doSearch($ldaptree = 'OU=Users,OU=BLIW,OU=BLI,OU=Brandix Users,DC=brandixlk,DC=org', $filter = '(cn=*)', $attributes = array('cn')){
        $results = array();
        
        $searchResults = @ldap_search($this->ldapconn, $ldaptree, $filter, $attributes);
        //ldap_count_entries($this->ldapconn, $searchResults);
        $results = @ldap_get_entries($this->ldapconn, $searchResults);
        
        return $results;
    }
    /**
     * format ldap 'ldap_get_entries' to 2d Array
     * @return 2d array
     */
    public function formatEntries($entries) {
        //$count = (isset($entries["count"])) ? $entries["count"] : 0;
        $results = array();

        foreach ($entries as $inf) {
            if (is_array($inf)) {
                foreach ($inf as $key => $in) {
                    if ((@count($inf[$key]) - 1) > 0) {
                        if (is_array($in)) {
                            unset($inf[$key]["count"]);
                        }
                        $temp_result[$key] = $inf[$key];
                    }
                }
                $temp_result["dn"] = @explode(',', $inf["dn"]);
                array_push($results, $temp_result);
            }
        }
        /*$count = count($results, 0);
        if($count == 1){
            $results = array_shift($results);
        }*/
        
        return $results;
    }
    
    
}
