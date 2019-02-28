$(function () {
    var $checkbox = $("#checkboxtable input:checkbox");
    var $table = $("#myTable");

    $checkbox.prop('checked', true);

    $checkbox.click(function () {
        var colToHide = $table.find("." + $(this).attr("name"));
        $(colToHide).toggle();
    });
});