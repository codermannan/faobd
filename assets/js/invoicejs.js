<script>
	var empRowCount = 1;
        function addMoreEmpRows(frm) {
            empRowCount ++;
            var recRow = '<tr id="empRowCount'+empRowCount+'"><td><input type="text" id="employeeName" name="employeeName[' + empRowCount + ']"/></td><td><textarea style="height: 44px; width: 235px;" id="employeeAddress" name="employeeAddress[' + empRowCount + ']"></textarea></td><td><input type="text" id="employeeDesignation" name="employeeDesignation[' + empRowCount + ']" value="" /></td><td><input type="text" class="employementBegin" name="employementBegin[' + empRowCount + ']" style="width: 120px;" /></td><td><input type="text" class="employementEnd" name="employementEnd[' + empRowCount + ']" value="<?php echo date("d-m-Y"); ?>" style="width: 120px;"/></td><td><a href="javascript:void(0);" onclick="removeEmpRow('+empRowCount+');">X</a></td></tr>';
            $('#empTable tbody').append(recRow);
            
            $( ".employementBegin, .employementEnd").datepicker({
                changeMonth: true,//this option for allowing user to select month
                changeYear: true,
                dateFormat: 'dd-mm-yy'//this option for allowing user to select from year range
              });
        }

        function removeEmpRow(removeEmpNum) {
            $('#empRowCount'+removeEmpNum).remove();
        }
</script>