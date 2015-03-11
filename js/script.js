function verif_etablissement()
	{
	if(document.form.organisateur_etablissement.value=="Autre")
		{
		document.form.organisateur_etablissement.style.display="none";
		document.getElementById("etablissement_autre").style.display="";
		document.form.organisateur_etablissement_autre.style.background="#FF0000";
		setTimeout("background_etablissement()",500);
		}
	}

function liste_etablissement()
	{
	document.form.organisateur_etablissement.value="";
	document.form.organisateur_etablissement_autre.value="";
	document.form.organisateur_etablissement.style.display="";
	document.getElementById("etablissement_autre").style.display="none";
	document.form.organisateur_etablissement.style.background="#FF0000";
	setTimeout("background_etablissement()",500);
	}

function background_etablissement()
	{
	document.form.organisateur_etablissement_autre.style.background="#FFFFFF";
	document.form.organisateur_etablissement.style.background="#FFFFFF";
	}
	
function dates_js(type)
	{
	for(i=1;i<7;i++)
		{
		document.form.elements["date"+i].value=date_format;
		document.form.elements["date"+i].style.color="grey";
		}
/*
	document.form.date1.value=date_format;
	document.form.date1.style.color="grey";
	document.form.date2.value=date_format;
	document.form.date2.style.color="grey";
	document.form.date3.value=date_format;
	document.form.date3.style.color="grey";
*/
/*	document.form.date_debut.value=date_format;
	document.form.date_debut.style.color="grey";
	document.form.date_fin.value=date_format;
	document.form.date_fin.style.color="grey";
	document.form.debut.value=null;
	document.form.fin.value=null;
	document.form.debut1.value=null;
	document.form.debut2.value=null;
	document.form.debut3.value=null;
	document.form.fin1.value=null;
	document.form.fin2.value=null;
	document.form.fin3.value=null;
*/
/*	if(type=="ponctuel")
		{
		document.getElementById('tr_date1').style.display="";
		document.getElementById('tr_date2').style.display="";
		document.getElementById('tr_date3').style.display="";
		document.getElementById('tr_recurent').style.display="none";
		document.getElementById('tr_horaires').style.display="none";
		document.getElementById('tr_periodicite').style.display="none";
		document.getElementById('tr_jours').style.display="none";
		}
	else
		{
		document.getElementById('tr_date1').style.display="none";
		document.getElementById('tr_date2').style.display="none";
		document.getElementById('tr_date3').style.display="none";
		document.getElementById('tr_recurent').style.display="";
		document.getElementById('tr_horaires').style.display="";
		document.getElementById('tr_periodicite').style.display="";
		document.getElementById('tr_jours').style.display="";
		}
*/
	}

function init_form()
	{
	for(i=1;i<7;i++)
		{
		if(document.form.elements["date"+i].value==date_format)
			document.form.elements["date"+i].style.color="grey";
		}
	verif_etablissement();
	}

function add_date()
	{
	if(document.getElementById("tr_date5").style.display=="")
		document.getElementById("tr_add_date").style.display="none";
	for(i=2;i<7;i++)
		{
		elem=document.getElementById("tr_date"+i);
		if(elem.style.display=="none")
			{
			elem.style.display="";
			return;
			}
		}
	}

function envoi(sens)
	{
	if(document.form.page.value)
		{
		page=document.form.page.value;
		if(!control_form(parseInt(page)))
			return false;
		}
	else
		page=1;
	
	if(sens=="-1")
		page--;
	else if(sens=="+1")
		page++;
	
	document.form.page.value=page;
	
	switch(parseInt(page)) {
		case 1 :  
			document.form.precedent.style.display="none";
			document.form.suivant.style.display="";
			document.form.valider.style.display="none";
			document.form.valider.disabled="disabled";
			document.getElementById('page1').style.display="block";
			document.getElementById('page2').style.display="none";
			document.getElementById('page3').style.display="none";
			document.getElementById('p1').style.display="block";
			document.getElementById('p2').style.display="none";
			document.getElementById('p3').style.display="none";
			break;
		case 2 :  
			document.form.precedent.style.display="";
			document.form.suivant.style.display="";
			document.form.valider.style.display="none";
			document.form.valider.disabled="disabled";
			document.getElementById('page1').style.display="none";
			document.getElementById('page2').style.display="block";
			document.getElementById('page3').style.display="none";
			document.getElementById('p1').style.display="none";
			document.getElementById('p2').style.display="block";
			document.getElementById('p3').style.display="none";
			break;
		case 3 :  
			document.form.precedent.style.display="";
			document.form.suivant.style.display="none";
			document.form.valider.style.display="";
			document.form.valider.disabled="";
			document.getElementById('page1').style.display="none";
			document.getElementById('page2').style.display="none";
			document.getElementById('page3').style.display="block";
			document.getElementById('p1').style.display="none";
			document.getElementById('p2').style.display="none";
			document.getElementById('p3').style.display="block";
			break;
		}
	scroll(0,0);
	}

function date_focus(elem)
	{
	elem.style.color="black";
	if(elem.value==date_format)
		elem.value=null;
	}
	
function date_blur(elem)
	{
	if(!elem.value)
		{
		elem.value=date_format;
		elem.style.color="grey";
		}
	else
		{
		if(!ctrl_date(elem))
			alert("Date invalide");
		else
			elem.value=ctrl_date(elem).value;
		}
	}
	
function ctrl_date(date)
	{
	var regexp = /\b(?:(?:[0-9]{1,2}?)\/){2}(?:20[0-9]{2}|[0-9]{2}?)\b/ ;
	if (!date.value.match(regexp))
		return false;
	tmp=date.value.split("/");
	if(tmp[0]>31)
		return false;
	if(tmp[1]>12)
		return false;

	if(tmp[0].length==1)
			tmp[0]="0"+tmp[0];
	if(tmp[1].length==1)
			tmp[1]="0"+tmp[1];
	if(tmp[2].length==2)
			tmp[2]="20"+tmp[2];
	date.value=tmp.join("/");

	return date;
	}

function isValidDate(d)
	{
	var dateRegEx = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;
	return d.match(dateRegEx);
	} 
	
function ctrl_mail(mail)
	{
	var regexp = /\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/ ;
	if (!mail.match(regexp))
		return false;
	else
		return true;
	}
	
function calendrier(elem)
	{
	tab=getPosition(elem+"_img");
	document.getElementById("calendrier").src="../calendrier/index.php?champ="+elem;
	document.getElementById("calendrier").style.left=tab[0]+"px";
	document.getElementById("calendrier").style.top=tab[1]+"px";
	document.getElementById("calendrier").style.display="block";
	}
	
function getPosition(element)
	{
	var left = 0;
	var top = 0;
	/*On récupère l'élément*/
	var e = document.getElementById(element);
	/*Tant que l'on a un élément parent*/
	while (e.offsetParent != undefined && e.offsetParent != null)
		{
		/*On ajoute la position de l'élément parent*/
		left += e.offsetLeft + (e.clientLeft != null ? e.clientLeft : 0);
		top += e.offsetTop + (e.clientTop != null ? e.clientTop : 0);
		e = e.offsetParent;
		}
	return new Array(left,top);
	}
	
function control_form()
	{
	erreur=false;
	erreur_dates=false;
	message="Les champs suivants sont obligatoires :\n";
	
	for(i=0;i<document.form.elements.length;i++)
		document.form.elements[i].style.background="";
	document.getElementById("div_type").style.background="";
	document.getElementById("div_type2").style.background="";
	document.getElementById("div_public").style.background="";
	document.getElementById("div_public2").style.background="";
	document.getElementById("div_disposition").style.background="";
/*	document.getElementById("div_ponctuel").style.background="";
	document.getElementById("div_recurrent").style.background="";
	document.getElementById('td_jours').style.background="";
*/
	if(document.form.titre.value=="")
		{
		erreur=true;
		message=message.concat("- Intitulé de l'événement\n");
		document.form.titre.style.background='yellow';
		}
/*	if(!document.form.dates[0].checked && !document.form.dates[1].checked)
		{
		erreur=true;
		erreur_dates=true;
		document.getElementById("div_ponctuel").style.background="yellow";
		document.getElementById("div_recurrent").style.background="yellow";
		}
	if(document.form.dates[0].checked)
		{
		if(document.form.date1.value=="" | document.form.date1.value==date_format | document.form.debut1.value=="" | document.form.fin1.value=="")
			{
			erreur=true;
			erreur_dates=true;
			if(document.form.date1.value=="" | document.form.date1.value==date_format)
				document.form.date1.style.background='yellow';
			if(document.form.debut1.value=="")
				document.form.debut1.style.background='yellow';
			if(document.form.fin1.value=="")
				document.form.fin1.style.background='yellow';
			}
		}

	if(document.form.dates[1].checked)
		{
		if(document.form.date_debut.value=="" | document.form.date_debut.value==date_format | document.form.debut.value=="" | document.form.fin.value=="" | document.form.periodicite.value=="")
			{
			erreur=true;
			erreur_dates=true;
			if(document.form.date_debut.value=="" | document.form.date_debut.value==date_format)
				document.form.date_debut.style.background='yellow';
			if(document.form.date_fin.value=="" | document.form.date_fin.value==date_format)
				document.form.date_fin.style.background='yellow';
			if(document.form.debut.value=="")
				document.form.debut.style.background='yellow';
			if(document.form.fin.value=="")
				document.form.fin.style.background='yellow';
			if(document.form.periodicite.value=="")
				document.form.periodicite.style.background='yellow';
			}
		if(document.form.periodicite.value=="Hebdomadaire")
			{
			checked=false;
			elem=document.form.elements['jours[]'];
			for(i=0;i<6;i++)
				if(elem[i].checked)
					checked=true;
			if(!checked)
				{
				erreur=true;
				erreur_dates=true;
				document.getElementById('td_jours').style.background='yellow';
				}
			}

		}
	if(erreur_dates)
		message=message.concat("- Dates et horaires\n");
*/
	if(document.form.date1.value=="" | document.form.date1.value==date_format | document.form.debut1.value=="" | document.form.fin1.value=="")
		{
		erreur=true;
		message=message.concat("- Dates et horaires\n");
		if(document.form.date1.value=="" | document.form.date1.value==date_format)
			document.form.date1.style.background='yellow';
		if(document.form.debut1.value=="")
			document.form.debut1.style.background='yellow';
		if(document.form.fin1.value=="")
			document.form.fin1.style.background='yellow';
		}
	else if(!isValidDate(document.form.date1.value))
		{
		erreur=true;
		message=message.concat("- La date saisie n'est pas valide\n");
		}

	if(document.form.organisateur_etablissement.value=="")
		{
		erreur=true;
		message=message.concat("- Nom du programme\n");
		document.form.organisateur_etablissement.style.background='yellow';
		}

	if(document.form.organisateur_etablissement.value=="Autre" && document.form.organisateur_etablissement_autre.value=="")
		{
		erreur=true;
		message=message.concat("- Nom du programme\n");
		document.form.organisateur_etablissement_autre.style.background='yellow';
		}
		
	if(document.form.organisateur_nom.value=="")
		{
		erreur=true;
		message=message.concat("- Personne en charge\n");
		document.form.organisateur_nom.style.background='yellow';
		}
	if(document.form.organisateur_courriel.value=="")
		{
		erreur=true;
		message=message.concat("- Courriel de l'organisateur\n");
		document.form.organisateur_courriel.style.background='yellow';
		}
	else if(!ctrl_mail(document.form.organisateur_courriel.value))
		{
		erreur=true;
		message=message.concat("- Courriel de l'organisateur invalide\n");
		document.form.organisateur_courriel.style.background='yellow';
		}

	checked=false;						//	Type d'événement
	elem=document.form.elements['type'];
	for(i=0;i<elem.length;i++)
		if(elem[i].checked)
			checked=true;
	if(!checked)
		{
		erreur=true;
		message=message.concat("- Type d'événement\n");
		document.getElementById("div_type").style.background='yellow';
		document.getElementById("div_type2").style.background='yellow';
		}
	
	public_err=false;					// Public attendu
	checked=false;
	elem=document.form.elements['public[]'];
	for(i=0;i<4;i++)
		if(elem[i].checked)
			checked=true;
	if(!checked)
		{
		document.getElementById("div_public").style.background='yellow';
		public_err=true;
		}
	checked=false;
	for(i=4;i<8;i++)
		if(elem[i].checked)
			checked=true;
	if(!checked)
		{
		document.getElementById("div_public2").style.background='yellow';
		public_err=true;
		}
	if(public_err)
		{
		erreur=true;
		message=message.concat("- Public attendu\n");
		}
		
	if(document.form.intervenants.value=="")			// Intervenants
		{
		erreur=true;
		message=message.concat("- Nombre d'intervenants\n");
		document.form.intervenants.style.background='yellow';
		}
	if(document.form.personnes.value=="")			// Personnes
		{
		erreur=true;
		message=message.concat("- Nombre de personnes\n");
		document.form.personnes.style.background='yellow';
		}
	
	checked=false;						//	Disposition
	elem=document.form.elements['disposition'];
	for(i=0;i<elem.length;i++)
		if(elem[i].checked)
			checked=true;
	if(!checked)
		{
		erreur=true;
		message=message.concat("- Disposition de la salle\n");
		document.getElementById("div_disposition").style.background='yellow';
		}

		
	if(erreur)
		{
		alert(message);
		return false;
		}
	return true;
	}
	
	