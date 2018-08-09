function setSatisfactionLevel(sel, contractId) {
    console.log(sel.value + " " + contractId);
    $.post("client_save_satisfaction_score.php",{"contractId": contractId, "satisfactionScore": sel.value}, function(data) {
        console.log("sucess");
        console.log(data);
    }).fail(function() {
        console.log("fail");
    });
}