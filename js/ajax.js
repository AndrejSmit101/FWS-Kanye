'use strict';
import {_generateMarkup, _generateMarkup2, _removeMarkup} from './helpers.js';
function ajax() {
    var oReq = new XMLHttpRequest();
    const responseText = new Array();
    oReq.onload = function()
    {
        const data = JSON.parse(this.responseText);
        console.log(data);
        _generateMarkup(data);
        _generateMarkup2(data);
    };
    oReq.open("get", "../includes/Views/view.php", true);
    oReq.send();
}
ajax();
document.querySelector('.quotes-btn').addEventListener('click', function() {
    _removeMarkup();
    ajax();
});