<?php
require_once 'classes/personal_specility.php';
$speciality = new personalspeciality();
$speciality->pk_id = $_POST['id'];
$res = $speciality->delete();
$result = $speciality->find_by_personal($_POST['pers_specility_id']);

if ($result) {
    ?>
    <!-- Table -->

    <table class="dynamicTable table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th style="width: 1%;" class="center">No.</th>
                <th>Speciality</th>
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
                    <td><?php echo $row['specility']; ?></td>
                    <td class="center" style="width: 200px;">
                        <a id="<?php echo $row['pk_id']; ?>-delspeciality" class="btn-action glyphicons bin" title="delete"><i></i></a>
                    </td>
                </tr>
                <?php
                $count++;
            }
            ?>
            <!--  Table row END -->
            <!-- Table row -->

            <!--  Table row END -->
        </tbody>
    </table>
    <!-- Table END -->
    <?php
} else {
    echo "<hr><h5> No records found!</h5>";
}