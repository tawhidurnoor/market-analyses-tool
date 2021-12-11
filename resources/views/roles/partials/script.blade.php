<script>
    /**
     * Check all the permissions
     */
    $("#checkPermissionAll").click(function() {
        if ($(this).is(':checked')) {
            // check all the checkbox
            $('input[type=checkbox]').prop('checked', true);
        } else {
            // un check all the checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    /**
     * Check specific group permissions
     */
    function checkPermissionByGroup(className, checkThis) {
        const groupIdName = $("#" + checkThis.id);
        const classCheckBox = $('.' + className + ' input');
        if (groupIdName.is(':checked')) {
            classCheckBox.prop('checked', true);
        } else {
            classCheckBox.prop('checked', false);
        }
    }
</script>