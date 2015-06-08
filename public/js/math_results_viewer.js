var prevRow = null

function opToStr(op)
{
    switch (op) {
        case '1':
            return '+';
        case '2':
            return '-';
        case '3':
            return '*';
        case '4':
            return '/';
    }
}

function isResultCorrect(result)
{
    switch (result.operation) {
        case '1':
            return (parseInt(result.num1) + parseInt(result.num2)) == parseInt(result.result);
        case '2':
            return (parseInt(result.num1) - parseInt(result.num2)) == parseInt(result.result);
        case '3':
            return (parseInt(result.num1) * parseInt(result.num2)) == parseInt(result.result);
        case '4':
            return (Math.round(parseInt(result.num1)/ parseInt(result.num2))) == 
                        parseInt(result.result);
    }
}

function viewResults(currRow, results)
{
    function showNewResults()
    {
        var resSummary = "";

        for (i = 0;  i < results.length; ++i) {
            if (resSummary.length > 0)
                resSummary = resSummary + "<br/>";
            resSummary = resSummary + '<span style="padding-left:199px">' + results[i].num1 + 
                             " " +  opToStr(results[i].operation) + " " + results[i].num2 + 
                             " = " + results[i].result + 
                             '<span style="left:8px" class="glyphicon ';
            if (isResultCorrect(results[i]))
                resSummary = resSummary + 'glyphicon-ok"></span></span>';
            else
                resSummary = resSummary + 'glyphicon-remove"></span></span>';
        }
        prevRow = $('<tr"><td colspan="3"><div>' + resSummary + 
                       '</div></td></tr>').insertAfter($(currRow).parents("tr").eq(0));
        prevRow.children().children("div").first().hide().slideDown(200);
        $(currRow).toggleClass("btn-info btn-warning");
        $(currRow).children().eq(0).toggleClass("glyphicon-eye-open glyphicon-eye-close");
        $(currRow).children().eq(1).text("Hide");
    }

    if (prevRow != null) {
        var row = prevRow;
        var btn = row.prev().children().children(".btn");
        var showNewRes = !$(currRow).hasClass("btn-warning");

        row.children().children("div").first().slideUp(200, function() {
            btn.toggleClass("btn-info btn-warning");
            btn.children().eq(0).toggleClass("glyphicon-eye-open glyphicon-eye-close");
            btn.children().eq(1).text("View");
            $(row).remove();
            if (showNewRes)
                showNewResults();
        });
    }
    else 
        showNewResults();
}