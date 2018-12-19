$(function ()
{
    $("#submissionform-instalation_type").change(function ()
    {
        $(".technical-form").hide();

        inst_type = $(this).val();

        if (technical_forms[inst_type]) {
            $("#" + technical_forms[inst_type]).show();
        } else {
            $("#no-technical-form").show();
        }
    });
    
    // first trigger
    $("#submissionform-instalation_type").change();
});
