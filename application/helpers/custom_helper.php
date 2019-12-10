<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//-- check logged user
	if (!function_exists('check_login_user')) {
	    function check_login_user() {
//                echo '<pre>';print_r($_SESSION);exit;
	        $ci = get_instance();
	        if ($ci->session->userdata('is_login') != TRUE) {
	            $ci->session->sess_destroy();
	            redirect(base_url('auth'));
	        }
	    }
	}

	if(!function_exists('check_power')){
	    function check_power($type){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_power($type);        
	        
	        return $option;
	    }
    } 

	//-- current date time function
	if(!function_exists('current_datetime')){
	    function current_datetime(){        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}

	//-- show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	//-- show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

        if (!function_exists('get_facility_info')) {
	    function get_facility_info($id) {
	        $ci = get_instance();
                $ci->load->model('common_model');
	       return $ci->common_model->select_where_id($id,'facilities');
	    }
	}
  
        if (!function_exists('create_select_pef_modal_btn')) {
	    function create_select_pef_modal_btn($material_id,$disp_text = NULL) {
                
	        $html ='
                    <button style="white-space: normal;" type="button" class="btn btn-success btn_pef_modal"  mat_id="'.$material_id.'" data-toggle="modal" data-target="#exampleModal">
                        '.(!empty($disp_text)?$disp_text:'Select PEF').'
                    </button>';
	       return $html;
	    }
	}
  
        
	if(!function_exists('create_city_options')){
	    function create_city_options($country_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('functions_model');
	        $cities_list = $ci->functions_model->get_cities_of_country($country_id);        
//	        echo '<pre>';print_r($cities_list);exit;
                $html='';
                foreach($cities_list as $k=>$v){
                    $html.='<option value="'.$v['pk_id'].'">'.$v['city_name'].'</option>';
                }
                
	        return $html;
	    }
        }
        
	if(!function_exists('create_country_options')){
	    function create_country_options(){        
	        $ci = get_instance();
	        
	        $ci->load->model('functions_model');
	        $c_list = $ci->functions_model->get_countries();        
//	        echo '<pre>';print_r($cities_list);exit;
                $html='';
                foreach($c_list as $k=>$v){
                    $html.='<option value="'.$v['id'].'">'.$v['name'].'</option>';
                }
                
	        return $html;
	    }
        }
        
	if(!function_exists('create_facility_options')){
	    function create_facility_options($country_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('functions_model');
	        $cities_list = $ci->functions_model->get_facilities_of_country($country_id);        
//	        echo '<pre>';print_r($cities_list);exit;
                $html='';
                foreach($cities_list as $k=>$v){
                    $html.='<option value="'.$v['pk_id'].'">'.$v['name'].'</option>';
                }
                
	        return $html;
	    }
        }
	if(!function_exists('create_list_options')){
	    function create_list_options($list_master){        
	        $ci = get_instance();
	        
	        $ci->load->model('functions_model');
                $list_elements = $ci->functions_model->get_list_elements();
//	        echo '<pre>';print_r($list_elements[$list_master]);exit;
                $html='';
                foreach($list_elements[$list_master] as $list_itm_id => $itm_data){
                    $html.='<option value="'.$list_itm_id.'">'.$itm_data['name'].'</option>';
                }
                
	        return $html;
	    }
        }
            
        if (!function_exists('create_retained_input_set')) {
	    function create_retained_input_set($material_id,$form1_saved_data=array()) {
                
                $st_display = '';
                if(!empty($form1_saved_data[$material_id]['is_retained']) && $form1_saved_data[$material_id]['is_retained']=='No')$st_display = 'display:none;';
                else $st_display = 'display:block;';
                
	        $html ='
                <div class="col-md-12">
                        <div class="col-md-3">
                     
                            <select name="is_retained__'.$material_id.'"  class="form-control" onchange="javascript:show_hide_retained_set(this,'.$material_id.')">
                                <option value="Yes" '.@opt_sel($form1_saved_data[$material_id]['is_retained'],'Yes').'>Yes</option>
                                <option value="No" '.@opt_sel($form1_saved_data[$material_id]['is_retained'],'No').'>No</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="'.$material_id .'_t">
                            <textarea class="form-control" rows = "2" cols = "20" style="'.$st_display.'" name = "rationale_of_retained__'.$material_id.'" id = "rationale_of_retained__'.$material_id.'" >'.disp_val(@$form1_saved_data[$material_id]['rationale_of_retained']).'</textarea>
                        </div>
                        <div class="col-md-3" id="'.$material_id .'_l">
                            <a onclick="imPopupW('.$material_id.','.$_REQUEST['master_id'].')">
                            <input id = "btn_inv__'.$material_id.'" type="button" style="'.$st_display.'" class="btn btn-success" value="Inventory"/></a>
                        </div>
                </div>    
                ';
	       return $html;
	    }
	}
        
        // this func returns html to mark a dropdown option as selected 
        if (!function_exists('opt_sel')) {
	    function opt_sel($val_saved,$val_html) {
                $html='';
                if(!empty($val_saved) && !empty($val_html) && $val_saved == $val_html )
                {
                    $html .=' selected="selected" ';
                }
	       return $html;
	    }
	}
        
        // this func marks a checkbox as checked
        if (!function_exists('check_cb')) {
	    function check_cb($val_saved,$val_html) {
                $html='';
                if(!empty($val_saved) && !empty($val_html) && $val_saved == $val_html )
                {
                    $html .=' checked="checked" ';
                }
	       return $html;
	    }
	}
        
        
        // this func returns value to be displayed if not empty
        if (!function_exists('disp_val')) {
	    function disp_val($disp_val) {
                $html='';
                if(!empty($disp_val) )
                {
                    $html = $disp_val;
                }
	       return $html;
	    }
	}
        
        // this func returns value of date , in universal format
        if (!function_exists('disp_val_date')) {
	    function disp_val_date($disp_val) {
                $html='';
                if(!empty($disp_val) && $disp_val!='0000-00-00' )
                {
                    $html = $disp_val;
                }
	       return $html;
	    }
	}
        
        
        
            
        if (!function_exists('create_doesnt_retained_input_set')) {
	    function create_doesnt_retained_input_set($prod,$form1_saved_data=array(),$t_title) {
//                echo '<pre>';print_r($prod);exit;
	        $html ='
                   <table class="table table-bordered color-bordered-tablex muted-bordered-tablex">
                <thead>
                    <tr>
                        <th width="8%">'.$t_title.'</th>
                        <th >Have never been possessed (tick box if applicable)</th>
                        <th >Have been destroyed on (please indicate the latest date as dd/mm/yyyy)</th>
                        <th width="20%">Have been inactivated using a method known to inactivate poliovirus on  (please indicate the latest date as dd/mm/yyyy)</th>
                        <th >Have been transferred to a PEF on                          (please indicate the PEF and the latest date as dd/mm/yyyy)</th>
                    </tr>
                </thead>
                   ';
                
                    $count = 1; 
                    foreach ($prod as $k => $mat_info) {
                        $im                 = $mat_info['name'];
                        $material_id        = $p   = $mat_info['pk_id'];
                        $footnote_number    = $key = $mat_info['footnote_number'];



                        $st_display = '';
                        if(!empty($form1_saved_data[$material_id]['never_possessed']) && $form1_saved_data[$material_id]['never_possessed']=='true')$st_display = 'display:none;';
                        else $st_display = 'display:block;';

                $html .='         
                    <tr>
                        <td>'.$im.' <sup>'.$footnote_number.'</sup></td>
                        <td>
                            <select name="never_possessed__'.$material_id.'" id="wpv" class="form-control" onchange="neverpossessed(this,'.$material_id.')">
                                <option value="false" '.@opt_sel($form1_saved_data[$material_id]['never_possessed'],'false').'>False</option>
                                <option value="true" '.@opt_sel($form1_saved_data[$material_id]['never_possessed'],'true').'>True</option>
                            </select>
                        </td>
                        <td >
                            <div class="hideshow'.$material_id.'" style="'.$st_display.'">
                                <table>
                                    <tr>
                                        <td><input type="checkbox" '.@check_cb($form1_saved_data[$material_id]['is_destroyed'],'on').' name="is_destroyed__'.$material_id.'" class="check" data-checkbox="icheckbox_square-blue"></td>
                                        <td><input type="text" class="col-md-12 datepicker"  value="'.@disp_val_date($form1_saved_data[$material_id]['destroyed_on']).'" autocomplete="off" placeholder="Date"  name="destroyed_on__'.$material_id.'" id="destroyed_on__'.$material_id.'" ></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        ';
                if(!empty($mat_info['disable_col']) && $mat_info['disable_col']==1){
                    $html .= '<td><div align="center">N/A</div></td>';
                    $html .= '<td><div align="center">N/A</div></td>';
                }else{
                $html .= '
                             <td>   <div class="hideshow'.$material_id.'" style="'.$st_display.'">
                                    <table>
                                        <tr>
                                            <td><input type="checkbox" '.@check_cb($form1_saved_data[$material_id]['is_inactivated'],'on').'  name="is_inactivated__'.$material_id.'" class="check"  data-checkbox="icheckbox_square-blue"></td>
                                            <td><input type="text" class="col-md-12 datepicker" value="'.@disp_val_date($form1_saved_data[$material_id]['inactivated_on']).'" autocomplete="off" placeholder="Date"  name="inactivated_on__'.$material_id.'" id="inactivated_on__'.$material_id.'" ></td>
                                        </tr>
                                    </table>
                                </div>
                        </td>
                        <td>
                                <div class="hideshow'.$material_id.'" style="'.$st_display.'">
                                    <table>
                                        <tr>
                                            <td><input type="checkbox" '.@check_cb($form1_saved_data[$material_id]['is_transferred'],'on').'  name="is_transferred__'.$material_id.'" class="check"  data-checkbox="icheckbox_square-blue"></td>
                                            <td><input type="text" class="col-md-12 datepicker"  value="'.@disp_val_date($form1_saved_data[$material_id]['transferred_on']).'" autocomplete="off" placeholder="Date"  name="transferred_on__'.$material_id.'" id="transferred_on__'.$material_id.'"></td>
                                            <td width="30px !important;">
                                                '.@create_select_pef_modal_btn($material_id,$form1_saved_data[$material_id]['transferred_to_name']).'
                                               
                                                <input type="hidden" name="transferred_to__'.$material_id.'" value="'.@disp_val($form1_saved_data[$material_id]['transferred_to']).'"  id="transferred_to__'.$material_id.'" >
                                            </td>  
                                        </tr>
                                    </table>
                                </div>
                        </td>';
                $html .= ' </tr>';
                }//END OF IF ELSE
               }//END OF FOREACH 

            $html .='</table>
                ';
	       return $html;
	    }
	}
        
        
        
	if(!function_exists('create_display_message')){
	    function create_display_message($msg,$type){        
	        $ci = get_instance();
	        
                $html='';
                $html.='<h4>'.$msg.'</h4>';
                $html.='<br>';
                $html.='<br>';
                if($type=='success'){
                    $html.='<i class="ti-check-box text-success" style="color:green;font-size:150px !important;" font-size:150px=""></i>';
                }
	        return $html;
	    }
        }
        
        
        
	if(!function_exists('unified_date')){
	    function unified_date($date,$format='d/M/Y'){     
                $formatted_date = '';
                if(!empty($date) && $date != '0000-00-00')
	       $formatted_date = date($format,strtotime($date));
	       return $formatted_date;
               
	    }
        }
     