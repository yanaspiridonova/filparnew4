var numErrors = 0;
var errMsg = Array();
var tmpRegexs = Array();
/*
 tmpRegexs['E'] = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
 tmpRegexs['N'] = /\S/;
 tmpRegexs['D'] = /[0-9]+/;
 */
$(document).on('keydown', function(){
    clear_errors();
});


function alert_msg(F, msg){
    clear_errors();
    numErrors = Math.floor(numErrors + 1);
    //var acb = document.getElementsByName(F);
    $("body").append("<div class=\"tip\"><div class=\"toolTip\"><div class=\"toolTipArrow\"></div>"+msg+"</div></div>");
    $(".tip").css({
        top: $(F).offset().top + $(".tip").height() - 3,
        left: $(F).offset().left
    });
    $(F).focus();
}

function clear_errors(){
    $(".tip").remove();
    numErrors = 0;
}

function show_hidden(obj){
    $(obj).fadeIn(500);
}

function template_validator(list){
    clear_errors();
    for(x in list){
        var elem = document.getElementById(x);
        if(!$(elem).length) continue;
        if(!$(elem).val().match(list[x].mask)){
            if($(elem).closest(".mainInfo").is(":hidden")){
                $(elem).closest(".mainInfo").fadeIn(50);
            }
            alert_msg(elem, list[x].hint);
            break;
        }
    }

    if(numErrors == 0){

        return true;
    }
    return false;
}

function dump_array(arr){
    var out = '';
    for(x in arr){
        out += x+" => "+arr[x]+"\n";
    }
    alert(out);
}
