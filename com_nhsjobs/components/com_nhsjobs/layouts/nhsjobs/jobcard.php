<?php
/**
 * @package    COM_NHSJOBS
 *
 * @author     NHS South, Central and West <webteam.scwcsu@nhs.net>
 * @copyright  Copyright (C) 2019 NHS South Central and West. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.scwcsu.nhs.uk
 */

defined('_JEXEC') or die;

//extract($displayData, EXTR_OVERWRITE);

//echo $text;

$job = $displayData;


?>

<div class="card">
<div class="card-header">
    <a href="<?php echo $job->job_url;?>" target="blank">
        <h4><?php echo $job->job_title;?></h4>
        <?php if($job['multiorg'] == 'true'){
            echo '<h6 style="color: #252525;">'.$job->job_employer.'</h6>';
            } ?>
    </a>
</div>
<div class="card-body">
<?php if($job['internal'] == 'true'){echo '<p class="card-text" style="color:red;">internal only applicants</p>';}?>
<p class="card-text"><?php echo $job->job_reference;?></p>
<p class="card-text"><?php echo $job->job_staff_group;?></p>
<p class="card-text"><?php echo $job->job_salary;?></p>
<p class="card-text"><?php echo $job->job_location;?></p>
<p class="card-text"><?php echo $job->job_type;?></p>
<p class="card-text"><?php echo $job->job_description;?></p>
<a href="<?php echo $job->job_url;?>" target="blank" class="btn btn-primary pull-right">find out more</a>
 </div>
<div class="card-footer text-muted">Close <?php echo $job->job_closedate;?></div>
</div>

