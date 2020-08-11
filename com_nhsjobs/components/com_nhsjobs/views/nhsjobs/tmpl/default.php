<?php
/**
 * @package    COM_NHSJOBS
 *
 * @author     NHS South, Central and West <webteam.scwcsu@nhs.net>
 * @copyright  Copyright (C) 2019 NHS South Central and West. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.scwcsu.nhs.uk
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\FileLayout;

defined('_JEXEC') or die;

HTMLHelper::_('script', 'com_nhsjobs/script.js', array('version' => 'auto', 'relative' => true));
HTMLHelper::_('stylesheet', 'com_nhsjobs/style.css', array('version' => 'auto', 'relative' => true));

$cardlayout = new FileLayout('nhsjobs.jobcard');

//$layout = new FileLayout('nhsjobs.page');
//$data = array();
//$ldata['text'] = 'Hello Joomla!';
//echo $layout->render($data);
// SCW 127935
// 128797,128537

$jobcount = 0;
$cardstring = "";
$multiorg = 'false';
if(substr_count($this->orgs, ",") > 0)
{
    $multiorg = 'true';
}


if($this->internal)
{
    $internalorgs = explode(",", $this->orgs);
    //var_dump($internalorgs);
    
    foreach($internalorgs as $iorg)
    {
        $data = $this->jobsmodel->getJobs($iorg, true);
        if($data['status'] != false && $data["data"]->status->number_of_jobs_found )
        {
            $jobcount += intval($data["data"]->status->number_of_jobs_found);
            foreach($data["data"]->vacancy_details as $job)
            {
                $job['internal'] = 'true';
                $job['multiorg'] = $multiorg;
                $cardstring .= $cardlayout->render($job);
            }
        }
        
    }
    
}
//$data = $this->jobsmodel->getJobs($this->orgs, $this->internal);

$data = $this->jobsmodel->getJobs($this->orgs, false);
if($data['status'] != false)
{
    $jobcount += intval($data["data"]->status->number_of_jobs_found);
    foreach($data["data"]->vacancy_details as $job)
    {
        $job['internal'] = 'false';
        $job['multiorg'] = $multiorg;
        $cardstring .= $cardlayout->render($job);
    }
}



if($cardstring == ""){
    echo "<div class='alert alert-danger'>No Jobs!</div>";
    //echo "<div class='alert alert-danger'> Error Code : ".$data["err_no"]."<br/>".$data["err_message"]."</div>";
}else{

    $document = JFactory::getDocument();
    $document->addStyleSheet("https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");

    echo "<h2>".$jobcount." Jobs </h2>" ;

    echo '<div class="card-columns">';
    echo $cardstring;
    echo ' </div>';
}
?>