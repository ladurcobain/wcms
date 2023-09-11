function reload_page() {
	location.reload();	
}

function link_new_tab(url) {
	uri = url;	
	window.open(uri,'_blank', 'directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no, width=770, height=500, top=20, left=80');
}

function link_to(url) {
	location.href = base_url + url;
}

// DATATABLE
$('#tableDt').DataTable({
    //lengthMenu: [10, 25, 50, 100],
    responsive: true,
	bInfo: false,
    "pageLength": 100,
	"oLanguage": {
		"ssearchPlaceholder":"Pencarian",
        "sSearch": "Pencarian :",
		"sZeroRecords": "Data tidak ditemukan",
		"sLengthMenu": "Tampilkan &nbsp; _MENU_ data",
		"oPaginate": {
			"sFirst": "<<",
			"sPrevious": "<",
			"sNext": ">",
			"sLast": ">>"
		 }
	},

    
    responsive: true,
    info: true,
    language: {
        'paginate': {
            'previous': "<i class='fas fa-angle-double-left'></i>",
            'next': "<i class='fas fa-angle-double-right'></i>"
        }
    }
});

$('#socialShare').socialSharingPlugin({
    // URL to share
    url: window.location.href,

    // get description from meta description tag
    description: $('meta[name=description]').attr('content'),

    // get title from title tag
    title: $('title').text(),
    
    img: $('meta[property="og:image"]').attr('content'),
    btnClass:'btn btn-light',
    enable:['copy', 'facebook', 'twitter', 'email', 'whatsapp'],
    responsive:true,
    mobilePosition:'left',
    copyMessage:'Copy to clipboard',
});