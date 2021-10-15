///////////////////////////////
//THIS CODE IS NOT BEING USED//
///////////////////////////////
import {_generateMarkup, _generateMarkup2} from './helpers.js';
let globaldata = [];
function init() {
    if(globaldata.length === 0) {
        ajax(true);
    }
}

function ajax(flag) {

    var oReq = new XMLHttpRequest();
    const responseText = new Array();
    oReq.onload = function()
    {
        const data = JSON.parse(this.responseText);
        if(flag) {
            globaldata = data;
            checkData(data);
            _generateMarkup(data);
            _generateMarkup2(data);
        } else {
            globaldata = data;
            data.forEach(obj => {
                obj.count = 1;
            });
            _generateMarkup(data);
            _generateMarkup2(data);
        }
        
    };
    oReq.open("get", "../includes/Views/view.php", true);
    oReq.send();
}

function checkData(data) {
    data.forEach(obj => {
        console.log(globaldata.includes(obj));
        if(globaldata.includes(obj)) {
            if(!obj.count) {
                obj.count = 1;
            } else {
                obj.count = obj.count + 1;
            }
        }
    });
}
document.querySelector('.quotes-btn').addEventListener('click', function() {
    ajax(true);
});
init();