<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New User</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="user-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("user/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=""> 
                                        <input id="ctrl-name"  value="<?php  echo $this->set_field_value('name',""); ?>" type="text" placeholder="Enter Name"  required="" name="name"  data-url="api/json/user_name_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                            <div class="check-status"></div> 
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                        <div id="ctrl-email-holder" class=""> 
                                            <input id="ctrl-email"  value="<?php  echo $this->set_field_value('email',""); ?>" type="email" placeholder="Enter Email"  required="" name="email"  data-url="api/json/user_email_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                                <div class="check-status"></div> 
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="gender">Gender <span class="text-danger">*</span></label>
                                            <div id="ctrl-gender-holder" class=""> 
                                                <?php
                                                $gender_options = Menu :: $gender;
                                                if(!empty($gender_options)){
                                                foreach($gender_options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                //check if current option is checked option
                                                $checked = $this->set_field_checked('gender', $value, "");
                                                ?>
                                                <label class="custom-control custom-radio custom-control-inline">
                                                    <input id="ctrl-gender" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="gender" />
                                                        <span class="custom-control-label"><?php echo $label ?></span>
                                                    </label>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="image">Image </label>
                                                <div id="ctrl-image-holder" class=""> 
                                                    <div class="dropzone " input="#ctrl-image" fieldname="image"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                        <input name="image" id="ctrl-image" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('image',""); ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="DOB">Dob <span class="text-danger">*</span></label>
                                                    <div id="ctrl-DOB-holder" class="input-group"> 
                                                        <input id="ctrl-DOB" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('DOB',""); ?>" type="datetime" name="DOB" placeholder="Enter Dob" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                                                        <div id="ctrl-password-holder" class="input-group"> 
                                                            <input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',""); ?>" type="password" placeholder="Enter Password" maxlength="255"  required="" name="password"  class="form-control  password password-strength" />
                                                                <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="password-strength-msg">
                                                                <small class="font-weight-bold">Should contain</small>
                                                                <small class="length chip">6 Characters minimum</small>
                                                                <small class="caps chip">Capital Letter</small>
                                                                <small class="number chip">Number</small>
                                                                <small class="special chip">Symbol</small>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                                            <div id="ctrl-confirm_password-holder" class="input-group"> 
                                                                <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="Confirm Password" />
                                                                <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Password does not match
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="role">Role <span class="text-danger">*</span></label>
                                                            <div id="ctrl-role-holder" class=""> 
                                                                <select required=""  id="ctrl-role" name="role"  placeholder="Select a value ..."    class="custom-select" >
                                                                    <option value="">Select a value ...</option>
                                                                    <?php
                                                                    $role_options = Menu :: $role2;
                                                                    if(!empty($role_options)){
                                                                    foreach($role_options as $option){
                                                                    $value = $option['value'];
                                                                    $label = $option['label'];
                                                                    $selected = $this->set_field_selected('role', $value, "");
                                                                    ?>
                                                                    <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                        <?php echo $label ?>
                                                                    </option>                                   
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-submit-btn-holder text-center mt-3">
                                                        <div class="form-ajax-status"></div>
                                                        <button class="btn btn-primary" type="submit">
                                                            Submit
                                                            <i class="fa fa-send"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
