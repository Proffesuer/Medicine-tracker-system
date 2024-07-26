<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("prescriptions/add");
$can_edit = ACL::is_allowed("prescriptions/edit");
$can_view = ACL::is_allowed("prescriptions/view");
$can_delete = ACL::is_allowed("prescriptions/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Prescriptions</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("prescriptions/add") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Prescriptions 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('prescriptions'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('prescriptions'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('prescriptions'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="prescriptions-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-sno">#</th>
                                                <th  class="td-prescriptions_id"> Prescriptions Id</th>
                                                <th  class="td-test_id"> Test Id</th>
                                                <th  class="td-medicine_id"> Medicine Id</th>
                                                <th  class="td-date_issue"> Date Issue</th>
                                                <th  class="td-patient_address"> Patient Address</th>
                                                <th  class="td-clinic_id"> Clinic Id</th>
                                                <th  class="td-patient_id"> Patient Id</th>
                                                <th  class="td-doctor_id"> Doctor Id</th>
                                                <th  class="td-quantity_prescribe"> Quantity Prescribe</th>
                                                <th  class="td-time_prescribe"> Time Prescribe</th>
                                                <th  class="td-number_refil"> Number Refil</th>
                                                <th  class="td-days_prescribe"> Days Prescribe</th>
                                                <th  class="td-instructions"> Instructions</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['prescriptions_id']) ? urlencode($data['prescriptions_id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['prescriptions_id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-prescriptions_id"><a href="<?php print_link("prescriptions/view/$data[prescriptions_id]") ?>"><?php echo $data['prescriptions_id']; ?></a></td>
                                                    <td class="td-test_id">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['test_id']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="test_id" 
                                                            data-title="Enter Test Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['test_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-medicine_id">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['medicine_id']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="medicine_id" 
                                                            data-title="Enter Medicine Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['medicine_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-date_issue">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['date_issue']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="date_issue" 
                                                            data-title="Enter Date Issue" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['date_issue']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-patient_address">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['patient_address']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="patient_address" 
                                                            data-title="Enter Patient Address" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['patient_address']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-clinic_id">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['clinic_id']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="clinic_id" 
                                                            data-title="Enter Clinic Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['clinic_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-patient_id">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['patient_id']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="patient_id" 
                                                            data-title="Enter Patient Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['patient_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-doctor_id">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['doctor_id']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="doctor_id" 
                                                            data-title="Enter Doctor Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['doctor_id']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-quantity_prescribe">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['quantity_prescribe']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="quantity_prescribe" 
                                                            data-title="Enter Quantity Prescribe" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['quantity_prescribe']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-time_prescribe">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['time_prescribe']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="time_prescribe" 
                                                            data-title="Enter Time Prescribe" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="time" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['time_prescribe']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-number_refil">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['number_refil']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="number_refil" 
                                                            data-title="Enter Number Refil" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['number_refil']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-days_prescribe">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['days_prescribe']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="days_prescribe" 
                                                            data-title="Enter Days Prescribe" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['days_prescribe']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-instructions">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['instructions']; ?>" 
                                                            data-pk="<?php echo $data['prescriptions_id'] ?>" 
                                                            data-url="<?php print_link("prescriptions/editfield/" . urlencode($data['prescriptions_id'])); ?>" 
                                                            data-name="instructions" 
                                                            data-title="Enter Instructions" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['instructions']; ?> 
                                                        </span>
                                                    </td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("prescriptions/view/$rec_id"); ?>">
                                                            <i class="material-icons">visibility</i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("prescriptions/edit/$rec_id"); ?>">
                                                            <i class="material-icons">edit</i> Edit
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("prescriptions/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                            <i class="material-icons">clear</i>
                                                            Delete
                                                        </a>
                                                        <?php } ?>
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="material-icons">block</i> No record found
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("prescriptions/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="material-icons">clear</i> Delete Selected
                                                    </button>
                                                    <?php } ?>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="material-icons">save</i> Export
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
