
<?php $result = $result[0]; ?>


<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                            
                   <div class="control-group">
                        <label class="control-label" for="username">User Name</label>
                        <div class="controls"><input class="span12" id="username" name="username" value="<?php echo $result['username']; ?>" type="text" /></div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="designation">Designation</label>
                        <div class="controls"><input class="span12" id="designation" name="designation" value="<?php echo $result['designation']; ?>" type="text" /></div>
                    </div> 
                     <div class="control-group">
                        <label class="control-label" for="login_id">Login Id</label>
                        <div class="controls"><input readonly="" class="span12" id="login_id" name="login_id" value="<?php echo $result['login_id']; ?>" type="text" /></div>
                    </div>  
                      <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls"><input class="span12" id="password" name="password" value="" type="text" placeholder="Enter password if you want to change" />
                            <input type="hidden" name="old_password" id="old_password" value="<?php echo $result['password']; ?>"/>
                        </div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls"><input class="span12" id="email" name="email" value="<?php echo $result['email']; ?>" type="text" /></div>
                    </div>  
                     <div class="control-group">
                        <label class="control-label" for="phone">Phone No</label>
                        <div class="controls"><input class="span12" id="phone" name="phone" value="<?php echo $result['phone']; ?>" type="text" /></div>
                    </div>  
        <div class="control-group">
            <label class="control-label" for="district_of_domicile">District</label>
            <div class="controls">
                <select class="span12" id="district_of_domicile" name="district_of_domicile">
                    <option value="">Select</option>
                    <?php
                   
$dataloc = $location->result_array();
                    foreach ($dataloc as $row) {
                        ?>
                        <option value="<?php echo $row['pk_id']; ?>" <?php if ($result['district_of_domicile'] == $row['pk_id']) { ?>selected=""<?php } ?>><?php echo $row['location_name']; ?></option>
                        <?php
                    }           
                    ?>
                </select></div>
        </div>
        <div class="control-group">
                        <label class="control-label" for="role_id">Role Id</label>
                        <div class="controls">
                            <select class="span12" id="role_id" name="role_id">
                                <option value="1" <?php if($result['role_id'] == 1) { ?>selected=""<?php } ?>>Super Admin</option>
                                <option value="2" <?php if($result['role_id'] == 2) { ?>selected=""<?php } ?>>Admin</option>
                                <option value="3" <?php if($result['role_id'] == 3) { ?>selected=""<?php } ?>>User</option>                                
                            </select>
                        </div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="status">status</label>
                        <div class="controls">
                            <select class="span12" id="status" name="status">
                                <option value="1" <?php if($result['is_active'] == 1) { ?>selected=""<?php } ?>>Active</option>
                                <option value="0" <?php if($result['is_active'] == 0) { ?>selected=""<?php } ?>>Inactive</option>                                
                            </select>
                        </div>
                    </div> 
        
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="userid" value="<?php echo $user_id; ?>"/>