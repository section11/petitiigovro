
var min=8;
var max=18;


function increaseFS () {
	increaseFontSize('p');
	increaseFontSize('h1');
	increaseFontSize('h4');
	increaseFontSize('h3');
  increaseFontSize('td');
	}
	
function decreaseFS () {
	decreaseFontSize('p');
	decreaseFontSize('h1');
	decreaseFontSize('h4');
	decreaseFontSize('h3');
  decreaseFontSize('td');
	}


function increaseFontSize(tag) {
	ns = 12;
	if(tag == 'h1') ns = 48;
	if(tag == 'h3') ns = 14;

   var p = document.getElementsByTagName(tag);
   for(i=0;i<p.length;i++) {
      if(p[i].style.fontSize) {
         var s = parseInt(p[i].style.fontSize.replace("px",""));
      } else {
         var s = ns;
      }
      if(s!=max) {
         s += 1;
      }
      p[i].style.fontSize = s+"px"
   }
}
function decreaseFontSize(tag) {
	ns = 12;
	if(tag == 'h1') ns = 35;
	if(tag == 'h3') ns = 14;
	
   var p = document.getElementsByTagName(tag);
   for(i=0;i<p.length;i++) {
      if(p[i].style.fontSize) {
         var s = parseInt(p[i].style.fontSize.replace("px",""));
      } else {
         var s = ns;
      }
      if(s!=min) {
         s -= 1;
      }
      p[i].style.fontSize = s+"px"
   }   
}

function showThirdmenu(el) {
$(el).show();
}

function hideThirdmenu(el) {
$(el).hide();
}

function addClassCss(el) {       
    if($(el).hasClassName('firstlevellink'))
                $(el).addClassName('selected');
}

function removeClassCss(el) {       
    if($(el).hasClassName('selected'))
                $(el).removeClassName('selected');
}

/*************************************  ajax update  ***********************************************/
//------------ Ajax Form ------------------------------------------------------------------------------------------------------- //
//     url -> url-ul catre cerere, 
//     my_method -> get or post, 
//     fromName -> numele formularului de unde se preiau valorile
//     daca nu vreau s apreiau date din formular atunci fromName = ''
//     iar values -> parametru1=valaore1&parametru2=valoare2
//     id_div -> id-ul elementului in care se pune rezultat
//     exemplu: 
//     <input type=button value=Request onclick="makeRequest('calea_catre_cerere','get','addGpsData','placeholder')"
//     <textarea id="placeholder"></textarea>
//------------------------------------------------------------------------------------------------------------------------------//

function makeFormRequest(url,my_method,values,formName,id_div)
{
 if (formName != '')
	var pars = Form.serialize(formName);
	   else 
	     var pars = values;
	 	   
	var myAjax = new Ajax.Updater(
	{success: id_div},
	
	url,
	
	{method: my_method, parameters: pars, evalScripts: true, onFailure: reportError }
	
	);	
}

/****************   daca exista o problema cu requestul se apeleaza functia  ************************/

function reportError(request)
{
	alert('Ajax error. Please try again');
}

/****************   mai 2010 - hide/expand div tag - pt paginile de reforme  ************************/
visibleDiv = "";
function showHide(elementid) {
if (document.getElementById(elementid).style.display == 'none') { 
document.getElementById(elementid).style.display = '';
if(visibleDiv != ""){
document.getElementById(visibleDiv).style.display = 'none'; }
visibleDiv = elementid;
} 
else {document.getElementById(elementid).style.display = 'none';}
}

/****************   INCLUDING A 'BOOKMARK THIS SITE' TEXT LINK  ************************/

function bookmark() 
     {
            var title = 'Guvernul Romaniei';
            var url = 'http://petitii.gov.ro';

            if (document.all)// Check if the browser is Internet Explorer
                window.external.AddFavorite(url, title);

            else if (window.sidebar) //If the given browser is Mozilla Firefox
                window.sidebar.addPanel(title, url, "");

            else if (window.opera && window.print) //If the given browser is Opera
            {
                var bookmark_element = document.createElement('a');
                bookmark_element.setAttribute('href', url);
                bookmark_element.setAttribute('title', title);
                bookmark_element.setAttribute('rel', 'sidebar');
                bookmark_element.click();
            } else 	{ alert("Sorry! Your browser doesn't appear to support this function."); }
     }
