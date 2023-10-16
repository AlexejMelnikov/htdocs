/* Базовые селекторы */

$('#id') // Обращение по идентификатору (id) Элемент 1.
$('.class') // Обращение по классу .class Элементов может быть несколько
$('div') // Обращение по тегу
$('*') // Обращение ко всем элементам



$(document).ready(function() {

   var fdiv = $('.first-div').html(); //.css("display", "NONE");
    lie = $( "li" );
    
    lie.each(function( index ) {
      lie.click(function (e) { 
        var textString = $(this).text();
        var nIndex = index+1;
       console.log(liestext = $(this[index+1]).text());   
    });
      

    });

});
