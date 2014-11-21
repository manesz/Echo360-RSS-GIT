<!-- Bootstrap core JavaScript
================================================== -->
<script src="libs/js/data_table_sorting.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Generate a simple captcha
        function randomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        };
        $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

        $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                offerCode: {
                    validators: {
                        notEmpty: {
                            message: 'The first name is required and cannot be empty'
                        }
                    }
                }
            }
        });

        // ---------------------------------------------------------------------------------  Validate the form manually
        $('#validateBtn').click(function() {
            $('#defaultForm').bootstrapValidator('validate');
        });

        $('#resetBtn').click(function() {
            $('#defaultForm').data('bootstrapValidator').resetForm(true);
        });

        // ------------------------------------------------------------------------------------------------- Date Picker
        $('#startDatePicker').datepicker({
            format: "yyyy-mm-dd"
        });
        $('#endDatePicker').datepicker({
            format: "yyyy-mm-dd"
        });
        $('.datePicker').datepicker({
            format: "yyyy-mm-dd"
        });

        // -------------------------------------------------------------------------------------------- dataTable Script
        $('#example').dataTable();
    });

    $('#example').removeClass( 'display' ).addClass('table table-striped table-bordered');
</script>
</body>
</html>