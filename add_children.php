<?php

session_start();
require_once 'classes/childrens.php';
require_once 'classes/datetime.php';

$childrens = new childrens();

if(isset($_REQUEST['childrenid']) && !empty($_REQUEST['childrenid'])){
    $childrens->pk_id = $_REQUEST['childrenid'];
}

$childrens->name = $_POST['name'];
$childrens->date_of_birth = $dt->dbformat($_POST['child_dob']);
$childrens->school_name = $_POST['school_name'];
$childrens->family_record_id = $_POST['family_children_id'];

$file = $childrens->save();

$result = $childrens->find_by_family($_POST['family_children_id']);

 if ($result) {
            ?>
            <!-- Table -->

            <table class="dynamicTable table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>School Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table row -->
                    <?php
                    $count = 1;
                    while ($row = $result->fetch_array()) {

                        $class = "gradeX";
                        if ($count % 2 == 0) {
                            $class = "gradeC";
                        }
                        //$attchment = new attachments();
                        //$att_count = $attchment->count_all($row['pk_id']);
                        ?>
                        <tr class="<?php echo $class; ?>">
                            <td class="center"><?php echo $count; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td class="important"><?php echo $row['date_of_birth']; ?></td>
                             <td class="important"><?php echo $row['school_name']; ?></td>
                            <td class="center" style="width: 200px;">
                                <a id="<?php echo $row['pk_id']; ?>-delchildren" class="btn-action glyphicons bin" title="delete"><i></i></a>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    }
                    ?>
                    <!-- // Table row END -->
                    <!-- Table row -->

                    <!-- // Table row END -->
                </tbody>
            </table>
            <!-- // Table END -->
            <?php
        } else {
            echo "<hr><h5> No records found!</h5>";
        }