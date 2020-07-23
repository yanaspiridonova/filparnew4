function genRandNum(min, max){
    var count = Math.floor((Math.random() * (max-min)) + min);
    return count;
};
var isAnimationRunning = false;

function animate(opts) {
    var start = new Date;
    var id = setInterval(function() {
        var timePassed = new Date - start;
        var progress = timePassed / opts.duration;
        if (progress > 1) progress = 1;
        var delta = opts.delta(progress);
        opts.step(delta);
        if (progress == 1) {
            clearInterval(id);
            isAnimationRunning = false;  // Reset the global variable
        }
    }, opts.delay || 10);

}
function move(element, delta, duration) {
    var to = 50;

    animate({
        delay: 10,
        duration: duration || 1000, // 1 sec by default
        delta: delta,
        step: function(delta) {
            element.style.right = to*delta + "px";
        }
    });
}
function bounce(progress) {
    return -Math.cos(2.5 * Math.PI * progress) * Math.pow(0.33, progress * 2.5) * 3;
}

String.prototype.allReplace = function(obj) {
    var retStr = this
    for (var x in obj) {
        retStr = retStr.replace(new RegExp(x, 'g'), obj[x])
    }
    return retStr
}

Array.prototype.contains = function ( needle ) {
    for (i in this) {
        if (this[i] == needle) return true;
    }
    return false;
}

var cities = [ "Quezon City", "Manila", "Caloocan", "Davao City", "Cebu City", "Zamboanga City", "Antipolo", "Pasig", "Taguig", "Cagayan de Oro", "Parañaque", "Dasmariñas", "Valenzuela", "Las Piñas", "General Santos", "Makati", "Manila", "Quezon City", "Manila", "Las Piñas"];

texts = [  'At the moment there are 100 visitors on this site.','15 promo price packages left!', 'An order from CITY was just made.', '15 promo price packages left!', 'An order from CITY was just made.', '15 promo price packages left!'];


function createDiv()
{
    var iDiv = document.createElement('div');
    iDiv.id = 'popUp';
    document.getElementsByTagName('body')[0].appendChild(iDiv);
    popUp = document.getElementById('popUp');
}



products = genRandNum(9, 10);
k =0;

function showPopUp(){


    if(k == texts.length) {
        setTimeout(function(){
            popUp.style.display = 'none';
        }, 5000);
        return;
    }

    //if (k>2) products-- ;
    if(k==0)
    {
        time = 4500; // time delay for first view
        time2 = 1;
    }
    else
    {
        time =  genRandNum(4500, 5500);
        time2 = genRandNum(2500, 4500);
    }
    setTimeout(function() {
        popUp.style.display = 'none';
        setTimeout(function() {

            popUp.style.display = 'block';
            var currentText = texts[k];
            var people = genRandNum(181, 248);
            if(k%2!=0)products = products - 1;
            //Replace the appropraite texts
            popUp.innerHTML = texts[k].allReplace({ '100': people, '15': products, 'CITY' : cities[Math.floor(Math.random()*cities.length)] });

            //Bounce the popUp
            move(popUp, bounce, 600);


            k++;
            //recursion
            showPopUp();

        },time2);

    }, time);
}

window.onload = function(){
    createDiv();
    showPopUp();
}
