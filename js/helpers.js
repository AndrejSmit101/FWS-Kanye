//Quote markup
"use strict";
export const _generateMarkup = function(response) 
{
    const parentElement = document.querySelector('.quotes-wrap');
    response.forEach(item => {
        const html = `
        <p class="quotes-text">${item.text}</p>
        `;
        parentElement.insertAdjacentHTML('afterbegin', html);
    });
    
}
//Quote info markup
export const _generateMarkup2 = function(response) 
{
    const parentElement = document.querySelector('.quote-report__table-content');

    response.forEach(item => {
        const html = `
            <tr class="quote-report__table-row">
                <td class="quote-report__table-row-content--quote">${item.text}</td>
                <td>${item.count}</td>
                <td>${item.speed}ms</td>
                <td>${item.date}</td>
            </tr>
        `;
        parentElement.insertAdjacentHTML('beforeend', html); 
    });
}

export const _removeMarkup = function() {
    const parentElement1 = document.querySelector('.quotes-wrap');
    const parentElement2 = document.querySelector('.quote-report__table-content');
    parentElement1.innerHTML = '';
    parentElement2.innerHTML = `
    <tr class="quote-report__table-header">
    <th class="quote-report__table-cell quote-report__table-cell--first">Quote</th>
    <th class="quote-report__table-cell">Individual Fetch Count</th>
    <th class="quote-report__table-cell">Fetch Speed</th>
    <th class="quote-report__table-cell">Fetch Timing</th>
    </tr>
    `;
}