<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >Welcome <?php echo USER_NAME;?></h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_medicine();  ?>
                    <a class="animated zoomIn record-count <?php echo ($rec_count==0 ? 'card bg-primary text-white' : 'card bg-success text-white'); ?>"  href="<?php print_link("medicine/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Medicine</div>
                                    <div class="progress mt-2">
                                        <?php 
                                        $perc = ($rec_count / 1000) * 100 ;
                                        ?>
                                        <div class="progress-bar bg-light text-dark" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="1000" style="width:<?php echo $perc ?>%">
                                            <span class="progress-label"><?php echo round($perc,2); ?>%</span>
                                        </div>
                                    </div>
                                    <small class="small desc"></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_prescription();  ?>
                    <a class="animated zoomIn record-count <?php echo ($rec_count==0 ? 'card bg-primary text-white' : 'card bg-primary text-white'); ?>"  href="<?php print_link("prescription/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Prescription</div>
                                    <div class="progress mt-2">
                                        <?php 
                                        $perc = ($rec_count / 1000) * 100 ;
                                        ?>
                                        <div class="progress-bar bg-light text-dark" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="1000" style="width:<?php echo $perc ?>%">
                                            <span class="progress-label"><?php echo round($perc,2); ?>%</span>
                                        </div>
                                    </div>
                                    <small class="small desc"></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_reviews();  ?>
                    <a class="animated zoomIn record-count <?php echo ($rec_count==0 ? 'card bg-primary text-white' : 'card bg-success text-white'); ?>"  href="<?php print_link("reviews/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Reviews</div>
                                    <div class="progress mt-2">
                                        <?php 
                                        $perc = ($rec_count / 1000) * 100 ;
                                        ?>
                                        <div class="progress-bar bg-light text-dark" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="1000" style="width:<?php echo $perc ?>%">
                                            <span class="progress-label"><?php echo round($perc,2); ?>%</span>
                                        </div>
                                    </div>
                                    <small class="small desc"></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_user();  ?>
                    <a class="animated zoomIn record-count <?php echo ($rec_count==0 ? 'card bg-primary text-white' : 'card bg-primary text-white'); ?>"  href="<?php print_link("user/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">User</div>
                                    <div class="progress mt-2">
                                        <?php 
                                        $perc = ($rec_count / 1000) * 100 ;
                                        ?>
                                        <div class="progress-bar bg-light text-dark" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="1000" style="width:<?php echo $perc ?>%">
                                            <span class="progress-label"><?php echo round($perc,2); ?>%</span>
                                        </div>
                                    </div>
                                    <small class="small desc"></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_reminder();  ?>
                    <a class="animated zoomIn record-count <?php echo ($rec_count==0 ? 'card bg-primary text-white' : 'card bg-success text-white'); ?>"  href="<?php print_link("reminder/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Reminder</div>
                                    <div class="progress mt-2">
                                        <?php 
                                        $perc = ($rec_count / 1000) * 100 ;
                                        ?>
                                        <div class="progress-bar bg-light text-dark" role="progressbar" aria-valuenow="<?php echo $rec_count; ?>" aria-valuemin="0" aria-valuemax="1000" style="width:<?php echo $perc ?>%">
                                            <span class="progress-label"><?php echo round($perc,2); ?>%</span>
                                        </div>
                                    </div>
                                    <small class="small desc"></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
