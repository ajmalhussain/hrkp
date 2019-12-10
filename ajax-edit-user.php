<?php
require_once 'classes/user.php';
require_once 'classes/datetime.php';
require_once 'classes/locations.php';

$user = new user();
$user_id = $_POST['id'];
$file = $user->find_by_id($user_id);
$data = $file->fetch_array();


?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                            
                   <div class="control-group">
                        <label class="control-label" for="username">User Name</label>
                        <div class="controls"><input class="span12" id="username" name="username" value="<?php echo $data['username']; ?>" type="text" /></div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="designation">Designation</label>
                        <div class="controls"><input class="span12" id="designation" name="designation" value="<?php echo $data['designation']; ?>" type="text" /></div>
                    </div> 
                     <div class="control-group">
                        <label class="control-label" for="login_id">Login Id</label>
                        <div class="controls"><input readonly="" class="span12" id="login_id" name="login_id" value="<?php echo $data['login_id']; ?>" type="text" /></div>
                    </div>  
                      <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls"><input class="span12" id="password" name="password" value="" type="text" placeholder="Enter password if you want to change" />
                            <input type="hidden" name="old_password" id="old_password" value="<?php echo $data['password']; ?>"/>
                        </div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls"><input class="span12" id="email" name="email" value="<?php echo $data['email']; ?>" type="text" /></div>
                    </div>  
                     <div class="control-group">
                        <label class="control-label" for="phone">Phone No</label>
                        <div class="controls"><input class="span12" id="phone" name="phone" value="<?php echo $data['phone']; ?>" type="text" /></div>
                    </div>  
        <div class="control-group">
            <label class="control-label" for="district_of_domicile">District</label>
            <div class="controls">
                <select class="span12" id="district_of_domicile" name="district_of_domicile">
                    <option value="">Select</option>
                    <?php
                    $location = new locations();
                    $file = $location->districtdropdown();
                    while ($row = $file->fetch_array()) {
                        ?>
                        <option value="<?php echo $row['pk_id']; ?>" <?php if ($data['district_of_domicile'] == $row['pk_id']) { ?>selected=""<?php } ?>><?php echo $row['location_name']; ?></option>
                        <?php
                    }           
                    ?>
                </select></div>
        </div>
        <div class="control-group">
                        <label class="control-label" for="role_id">Role Id</label>
                        <div class="controls">
                            <select class="span12" id="role_id" name="role_id">
                                <option value="1" <?php if($data['role_id'] == 1) { ?>selected=""<?php } ?>>Super Admin</option>
                                <option value="2" <?php if($data['role_id'] == 2) { ?>selected=""<?php } ?>>Admin</option>
                                <option value="3" <?php if($data['role_id'] == 3) { ?>selected=""<?php } ?>>User</option>                                
                            </select>
                        </div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="status">status</label>
                        <div class="controls">
                            <select class="span12" id="status" name="status">
                                <option value="1" <?php if($data['is_active'] == 1) { ?>selected=""<?php } ?>>Active</option>
                                <option value="0" <?php if($data['is_active'] == 0) { ?>selected=""<?php } ?>>Inactive</option>                                
                            </select>
                        </div>
                    </div> 
        
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="userid" value="<?php echo $user_id; ?>"/>