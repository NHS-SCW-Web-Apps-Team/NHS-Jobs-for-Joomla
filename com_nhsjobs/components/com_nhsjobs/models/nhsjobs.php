<?php
/**
 * @package    COM_NHSJOBS
 *
 * @author     NHS South, Central and West <webteam.scwcsu@nhs.net>
 * @copyright  Copyright (C) 2019 NHS South Central and West. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.scwcsu.nhs.uk
 */

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

defined('_JEXEC') or die;

/**
 * Nhsjobs model.
 *
 * @package   COM_NHSJOBS
 * @since     1.0.0
 */
class NhsjobsModelNhsjobs extends BaseDatabaseModel
{

    public function getMsg(){
        return "test message" ;
    }
    
    public function getMsg2($something){
        return "test ".$something ;
    }
        
    public function getJobs($code=0, $internal = false){
    
        // create curl resource 
        $ch = curl_init(); 
        
        // set url 
        if($internal)
        {
            $intstr = "&internal_only=Y";
        }
        else
        {
            $intstr = "";
        }
        curl_setopt($ch, CURLOPT_URL, "https://www.jobs.nhs.uk/search_xml?client_id=".$code.$intstr); 
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        
        // $output contains the output string 
        $output = curl_exec($ch); 
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        
        // close curl resource to free up system resources 
        curl_close($ch); 
        
        
        if($output==FALSE){
            $jobs["status"]=FALSE;
            $jobs["err_no"]=$err;
            $jobs["err_message"]=$errmsg;
        }else{
            $jobs["status"]=TRUE;
            $jobs["data"]=simplexml_load_string($output);
        }
        return $jobs ;
    }    
    
}

