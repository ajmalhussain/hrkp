<?php
require_once 'classes/education.php';
$education = new education();
$education->pk_id = $_POST['id'];
$res = $education->delete();

$result = $education->find_by_personal($_POST['personal_id']);
if ($result) {
    ?>
    <!-- Table -->

    <table class="dynamicTable table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th style="width: 1%;" class="center">No.</th>
                <th>University Name</th>
                <th>Degree Title</th>
                <th>Start Date</th>
                <th>Completion Date</th>
                <th>Percentage</th>
                <th>CGPA</th>
                <th>Total Marks</th>
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
                    <td class="important"><?php echo $row['university_name']; ?></td>
                    <td class="important"><?php echo $row['degree_title']; ?></td>
                    <td class="important"><?php echo $row['start_date']; ?></td>
                    <td class="important"><?php echo $row['completion_date']; ?></td>
                    <td><?php echo $row['percentage']; ?></td>
                    <td class="important"><?php echo $row['cgpa']; ?></td>
                    <td class="important"><?php echo $row['total_marks']; ?></td>
                    <td class="center" style="width: 200px;">
                        <a id="<?php echo $row['pk_id']; ?>-deleducation" class="btn-action glyphicons bin" title="delete"><i></i></a>
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