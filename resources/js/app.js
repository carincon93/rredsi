require('./bootstrap');

import dt from 'datatables.net';

document.addEventListener('DOMContentLoaded', function () {
    var $ = require( 'jquery' );
    $('.table-auto')
    .DataTable({
        "order": [[ 0, "asc" ]],
        sDom: '<"row view-filter"<"col-md-6"l><"col-md-6"f>>t<"row view-pager"<"col-sm-12"ip>>',
        paging:   false,
        info: !1,
        language: {
            paginate: {
                previous: "<span class='material-icons'>navigate_before</span>",
                next: "<span class='material-icons'>navigate_after</span>"
            },
            search: "",
            sSearchPlaceholder: "Buscar:",
            info: "Mostrando página _PAGE_ de _PAGES_",
            sInfo: "Mostrando <strong>_START_ a _END_</strong> de _TOTAL_ registros",
            emptyTable: "No hay datos disponibles en la tabla",
            sEmptyTable: "No hay datos disponibles en la tabla",
            infoFiltered: " - filtrando de _MAX_ registros",
            sInfoFiltered: "(filtrado de _MAX_ registros en total)",
            sLengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No hay registros para mostrar",
            sInfoEmpty: "Mostrando <strong>0 a 0</strong> de 0 registros"
        }
    });
    if (document.querySelector('.dataTables_filter input')) {
        document.querySelector('.dataTables_filter input').classList.add('form-input', 'rounded-b-none','border-0', 'shadow-sm', 'block', 'w-full');
    }
    
    window.changeActiveTab = function (event, tabID){
        let element = event.target;
        while(element.nodeName !== "A"){
            element = element.parentNode;
        }
        let ulElement = element.parentNode.parentNode;
        let aElements = ulElement.querySelectorAll("li > a");
        let tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
        for(let i = 0 ; i < aElements.length; i++){
            aElements[i].classList.remove("text-white");
            aElements[i].classList.remove("bg-blue-900");
            aElements[i].classList.add("text-blue-900");
            aElements[i].classList.add("bg-white");
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
        }
        element.classList.remove("text-blue-900");
        element.classList.remove("bg-white");
        element.classList.add("text-white");
        element.classList.add("bg-blue-900");
        document.getElementById(tabID).classList.remove("hidden");
        document.getElementById(tabID).classList.add("block");
    }
}, false);