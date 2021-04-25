var numofpro = 2;


// check algoritme type
function chck_typ(){
	var chck = document.getElementById('myonoffswitch').checked;
	var form = document.getElementById('form');
	var loogo = document.getElementById('loogo');
	
	if( chck==true )
	{
		form.setAttribute('action','fcfs.php');
		loogo.setAttribute('src','lib/FCFS.png');
	}
	else{
		form.setAttribute('action','sjf.php');
		loogo.setAttribute('src','lib/SJF.png');
	}
	
}


function slct(typ){

	if( typ=='FCFS')
	{
		$('.main_logo .active').removeClass('active');
		$('.main_logo #FCFS').addClass('active');
		$('.help_txt .active').removeClass('active');
		$('.help_txt #FCFS_TXT').addClass('active');
		changeCSS('FCFS');
		document.getElementById('form').setAttribute('action','fcfs.php');
	}
	else if( typ=='SJF')
	{
		$('.main_logo .active').removeClass('active');
		$('.main_logo #SJF').addClass('active');
		$('.help_txt .active').removeClass('active');
		$('.help_txt #SJF_TXT').addClass('active');
		changeCSS('SJF');
		document.getElementById('form').setAttribute('action','sjf.php');
	}
	else if( typ=='RR')
	{
		$('.main_logo .active').removeClass('active');
		$('.main_logo #RR').addClass('active');
		$('.help_txt .active').removeClass('active');
		$('.help_txt #RR_TXT').addClass('active');
		changeCSS('RR');
		document.getElementById('form').setAttribute('action','rr.php');
	}
	else if( typ=='PR')
	{
		$('.main_logo .active').removeClass('active');
		$('.main_logo #PR').addClass('active');
		$('.help_txt .active').removeClass('active');
		$('.help_txt #PR_TXT').addClass('active');
		changeCSS('PR');
		document.getElementById('form').setAttribute('action','pr.php');
	}

}


// +1
function increase(){
	var slct = document.getElementById('input');
	var fields = document.getElementsByClassName('fields')[0];
	var count = document.getElementsByName('count')[0];
	
	var i = numofpro + 1;
	
	var string=
		'<div class="fields_div">'+
		'<label for="PN_'+i+'">نام فرآیند '+i+': </label><input name="PN_'+i+'" id="PN_'+i+'" type="text" value="" required="required" />&nbsp;&nbsp;&nbsp;' + "\n" +
		'<label for="PB_'+i+'">زمان انفجار فرآیند '+i+': </label><input name="PB_'+i+'" id="PB_'+i+'" type="number" value="" required="required" />&nbsp;&nbsp;&nbsp;' + "\n" +
		'<label for="PC_'+i+'">زمان ورود فرآیند '+i+': </label><input name="PC_'+i+'" id="PC_'+i+'" type="number" value="" required="required" />&nbsp;&nbsp;&nbsp;' + "\n" +
		'<label for="PP_'+i+'">اولویت فرآیند '+i+': </label><input name="PP_'+i+'" id="PP_'+i+'" type="number" value="1" />' +
		'</div>';

	$('.fields').append(string);
	numofpro = i;
	slct.innerHTML = i;
	count.value = i;
	
}




// -1
function decrease(){
	var slct = document.getElementById('input');
	var fields = document.getElementsByClassName('fields')[0];
	var count = document.getElementsByName('count')[0];

	var VAL = numofpro - 1;
	
	if( slct.innerHTML>1)
	{
	
		var string="";
		
		for(var i=1;i<=VAL;i++){
			var pro_nam = document.getElementById('PN_'+i).value;
			var pro_bru = document.getElementById('PB_'+i).value;
			var pro_com = document.getElementById('PC_'+i).value;
			var pro_pp = document.getElementById('PP_'+i).value;
		
		
			string = string + 
			'<div class="fields_div">'+
			'<label for="PN_'+i+'">نام فرآیند '+i+': </label><input name="PN_'+i+'" id="PN_'+i+'" type="text" value="'+pro_nam+'" required="required" />&nbsp;&nbsp;&nbsp;' + "\n" +
			'<label for="PB_'+i+'">زمان انفجار فرآیند '+i+': </label><input name="PB_'+i+'" id="PB_'+i+'" type="number" value="'+pro_bru+'" required="required" />&nbsp;&nbsp;&nbsp;' + "\n" +
			'<label for="PC_'+i+'">زمان ورود فرآیند '+i+': </label><input name="PC_'+i+'" id="PC_'+i+'" type="number" value="'+pro_com+'" required="required" />&nbsp;&nbsp;&nbsp;' + "\n" +
			'<label for="PP_'+i+'">اولویت فرآیند '+i+': </label><input name="PP_'+i+'" id="PP_'+i+'" type="number" value="'+pro_pp+'" />' +
			'</div>';
		}

		fields.innerHTML = string;
		numofpro = VAL;
		slct.innerHTML = VAL;
		count.value = VAL;
	}
	else
	{
		alert('حداقل تعداد فرآیند ها یک فرآیند میباشد.');
	}
	
}


// Check T.S
function tschck(){
	var ts = document.getElementById('ts');
	var tsinp = document.getElementsByName('ts')[0];

	if( ts.innerHTML>0 )
	{
		tsinp.value = ts.innerHTML;
	}
	else
	{
		ts.innerHTML = tsinp.value;
	}


}


// +1 TS
function tsincrease(){
	var ts = document.getElementById('ts');
	var tsinp = document.getElementsByName('ts')[0];
	
	tsinp.value = ++tsinp.value;
	ts.innerHTML = tsinp.value;
}
// -1 TS
function tsdecrease(){
	var ts = document.getElementById('ts');
	var tsinp = document.getElementsByName('ts')[0];
	
	tsinp.value = --tsinp.value;
	ts.innerHTML = tsinp.value;
}



//////////	CHANGE PAGE STYLE	//////////
function changeCSS(cssFile) {	
	var oldlink = document.getElementsByTagName("link").item(1);
	var oldval = oldlink.getAttribute('href');
	var newlink = document.createElement("link")
	
	if( oldval!=cssFile )
	{
		newlink.setAttribute("rel", "stylesheet");
		newlink.setAttribute("type", "text/css");
		newlink.setAttribute("href", 'lib/' + cssFile + '.css');
		document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink);
	}
}