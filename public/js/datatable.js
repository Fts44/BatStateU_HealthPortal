//set datatable
const datatable = $('#datatable').DataTable({
    rowReorder: {
    selector: 'td:nth-child(2)'
    },
    responsive: true,
    scrollX: true,
});

//if the section change width fixed column by aligning the action col to asc
let resize_observer = new ResizeObserver(function() {
    datatable.order([[ $('#datatable tr th').length-1, 'asc']]).draw();
});

resize_observer.observe($("#cardTable")[0]);