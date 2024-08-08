<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("prescriptions/add");
$can_edit = ACL::is_allowed("prescriptions/edit");
$can_view = ACL::is_allowed("prescriptions/view");
$can_delete = ACL::is_allowed("prescriptions/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Prescriptions</h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['prescriptions_id']) ? urlencode($data['prescriptions_id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-prescriptions_id">
                                        <th class="title"> Prescriptions Id: </th>
                                        <td class="value"> <?php echo $data['prescriptions_id']; ?></td>
                                    </tr>
                                    <tr  class="td-medicine_id">
                                        <th class="title"> Medicine Id: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-date_issue">
                                        <th class="title"> Date Issue: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-patient_address">
                                        <th class="title"> Patient Address: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-patient_id">
                                        <th class="title"> Patient Id: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-doctor_id">
                                        <th class="title"> Doctor Id: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-quantity_prescribe">
                                        <th class="title"> Quantity Prescribe: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-time_prescribe">
                                        <th class="title"> Time Prescribe: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-number_refil">
                                        <th class="title"> Number Refil: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-days_prescribe">
                                        <th class="title"> Days Prescribe: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-instructions">
                                        <th class="title"> Instructions: </th>
                                        <td class="value">
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
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("prescriptions/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("prescriptions/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
