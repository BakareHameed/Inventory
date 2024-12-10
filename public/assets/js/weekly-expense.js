// (function() {
//     var beforePrint = function() {
//         alert("You're about to print this weeks expenses.")
//         var user_1 = prompt("You're about to print this weeks expenses?(yes/no)");
//         var answerElement = document.getElementById("answer")
//         console.log(user_1);
//     };
//     var afterPrint = function() {
//         console.log('Functionality to run after printing');
//     };

//     if (window.matchMedia) {
//         var mediaQueryList = window.matchMedia('print');
//         mediaQueryList.addListener(function(mql) {
//             if (mql.matches) {
//                 beforePrint();
//             } else {
//                 afterPrint();
//             }
//         });
//     }

//     window.onbeforeprint = beforePrint;
//     window.onafterprint = afterPrint;
// }());


