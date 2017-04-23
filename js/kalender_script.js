/*jslint devel: true */
var html_data;

window.onload = function () {
    "use strict";
    var d = new Date();
    initKalender(d);
}
    function initKalender(d){
    var month_name_ger = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktber", "November", "Dezember"];
    var month_name = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var day_name = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
    var wochentage = ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"];
    var month = d.getMonth();
    var year = d.getFullYear();
    var first_date = month_name[month] + " " + 1 + " " + year;
    var first_date_name = new Date(first_date).toDateString();
    var first_date_name_day = first_date_name.substring(0, 3);
    var day_number = day_name.indexOf(first_date_name_day);
    var current_day_number = day_name.indexOf((new Date(month_name[month] + " " + d.getDate() + " " + year).toDateString()).substring(0, 3));
    var last_date_day = new Date(year, month+1, 0).getDate();
    document.getElementById("kalender_kopf_inhalt").innerHTML = month_name_ger[month]+ " " + year;
    
	var dmonth = getZeroDate(d.getMonth()+1);
	var day = getZeroDate(d.getDate());
	var fulldate = d.getFullYear() + "-" + dmonth + "-" + day;
	
	getAllEvents(year + "-" + dmonth);
	var eventDates = parseEventDates(html_data);
	var kalender_table = getKalenderTable(day_number, last_date_day,d, wochentage, eventDates);
    document.getElementById("kalender_bauch").removeChild(document.getElementById("kalender_bauch").firstChild);
    document.getElementById("kalender_bauch").appendChild(kalender_table);
        
    initButtons(document.getElementById("pfeil_back"), document.getElementById("pfeil_for"), month, year);
    
    setText('calendar-day',wochentage[current_day_number]);
    setText('calendar-date', d.getDate());
    setText('calendar-month-year',  document.getElementById("kalender_kopf_inhalt").textContent);
    getData(fulldate);
	//setText('calendar-eventtext', "Keine Veranstaltungen");
}

// Nummer des ersten Tages des aktuellen Monats, Anzahl der Tage des aktuellen Monats
function getKalenderTable(day_number, last_date_day,d,wochentage, eventDates){
	var table = document.createElement("table");
    var tr = document.createElement("tr");
    //Reihe der Tage
    for(var i=0 ; i<=6; i++){
        var td = document.createElement("td");
        td.innerHTML = "MDMDFSS"[i];
        tr.appendChild(td);
    }
    table.appendChild(tr);
    
    //Zweite Reihe, Blanks und Tage
    tr = document.createElement("tr");
    var i;
    for(i = 0; i<=6; i++){
        if(i==day_number){
            break;
        }
        var td = document.createElement("td");
        td.innerHTML = "<font color = \"grey\">" + new Date(d.getFullYear(),d.getMonth(),0-(day_number-i)+1).getDate() + "</font>";
       td.setAttribute("currentMonth", d.getMonth());
                td.setAttribute("currentYear", d.getFullYear());
                td.setAttribute("GoalDay", (new Date(d.getFullYear(),d.getMonth(),0-(day_number-i)+1).getDate()));
                td.onmouseover = f_mouseover;
                td.onmouseout = f_mouseout;
                td.onclick = b_b_mouseclick;
        tr.appendChild(td);
    }
    var day_counter = 1;
    
    for(;i<=6;i++){
        var td = document.createElement("td");
		td.innerHTML = day_counter;
        td.onclick = f_click;
        td.onmouseover = f_mouseover;
        td.onmouseout = f_mouseout;
		
        if(day_counter == d.getDate()){  
            td.innerHTML =  day_counter;
                td.className ="spezial";
                td.onmouseout = null;
            }
        else if(contains(eventDates,fulldate))
			{
				td.innerHTML = "<b><font color=\"red\">" + day_counter + "</font></b>";
			}
            else{
                td.innerHTML = day_counter;
            }
        td.setAttribute("value",day_counter);
        td.setAttribute("wochentag", wochentage[i]);
        td.setAttribute("monatJahr", document.getElementById("kalender_kopf_inhalt").textContent);
        day_counter++;
        tr.appendChild(td);
    }
    table.appendChild(tr);
    
    //Restliche Zeilen
    for(var z = 3; z<=6; z++){
        tr = document.createElement("tr");
        for(var i = 0; i<=6; i++){
			var day = getZeroDate(day_counter);
			var month = getZeroDate(d.getMonth()+1);
			var fulldate = d.getFullYear() + "-" + month + "-" + day;
			
            if(day_counter > last_date_day){
               /* table.appendChild(tr);
            return table; */
                var td = document.createElement("td");
                td.innerHTML = "<font color =\"grey\">" + (day_counter-last_date_day) + "</font>";
                td.setAttribute("currentMonth", d.getMonth());
                td.setAttribute("currentYear", d.getFullYear());
                td.setAttribute("GoalDay", (day_counter-last_date_day));
                td.onmouseover = f_mouseover;
                td.onmouseout = f_mouseout;
                td.onclick = b_f_mouseclick;
                day_counter++;
            tr.appendChild(td); 
                continue;
            }
            var td = document.createElement("td");
            td.onclick = f_click;
            td.onmouseover = f_mouseover;
            td.onmouseout = f_mouseout;
            
			if(day_counter == d.getDate()){  
            td.innerHTML = day_counter;
                td.className ="spezial";
                td.onmouseout = null;
            }
			else if(contains(eventDates,fulldate))
			{
				td.innerHTML = "<b><font color=\"red\">" + day_counter + "</font></b>";
			}
            else{
                td.innerHTML = day_counter;
            }

			var day = getZeroDate(day_counter);
			var month = getZeroDate(d.getMonth()+1);
			
            td.setAttribute("value",day_counter);
			td.setAttribute("date",fulldate);
            td.setAttribute("wochentag", wochentage[i]);
            td.setAttribute("monatJahr", document.getElementById("kalender_kopf_inhalt").textContent);
            day_counter++;
            tr.appendChild(td); 
        }
        table.appendChild(tr);
    }
    return table;
}
function getZeroDate(date)
{
	 if(date < 10){
				date = '0' + date;    //add leading 0 if val < 10
			}
	return date;
}

function contains(a, obj) {
    var i = a.length;
    while (i--) {
       if (a[i] === obj) {
           return true;
       }
    }
    return false;
}

function f_click(onclick){
    setText('calendar-day',this.getAttribute("wochentag"));
    setText('calendar-date',this.getAttribute("value"));
    setText('calendar-month-year', this.getAttribute("monatJahr"));
    getData(this.getAttribute("date"));
	
	//console.log("Selected '" + this.getAttribute("date") + "'"); 
    
       var table = document.getElementById('kalender_bauch').firstElementChild,
    rows = table.rows, rowcount = rows.length, r,
    cells, cellcount, c, cell;
for( r=0; r<rowcount; r++) {
    cells = rows[r].cells;
    cellcount = cells.length;
    for( c=0; c<cellcount; c++) {
        cell = cells[c];
        if(cell == this){
            this.onmouseout = null;
        }
        else{
            cell.onmouseout = f_mouseout;
            cell.className = "normal";
        }
    }
}
}

function parseHTML(html) {
	var parser = new DOMParser();
	var document = parser.parseFromString(html, "text/xml");
	var table = document.getElementById("events");
	var r=2;
	var ret = "<b>Veranstaltungen</b><br>";
	while(row=table.childNodes[r++])
	{
			//var c = 0;			
			ret = ret + row.childNodes[1].innerHTML + "<br>";
			//console.log(ret);
		/*	while(col=row.childNodes[c++])
			{
				if(col.nodeName != "#text")
				{ 
					//if(col.nodeName == "th") // && col.childNodes[0].nodeName == "name")
						console.log(col.childNodes[0]);
				}
			}*/
	}
	if(r == 3) ret = "Keine Veranstaltungen";
	return ret;
}

function parseEventDates(html) {
	var parser = new DOMParser();
	var document = parser.parseFromString(html, "text/xml");
	var table = document.getElementById("events");
	var r=2;
	var i=0;
	var ret = new Array(table.childNodes.length-2);
	while(row=table.childNodes[r++])
	{
		if(row.nodeName != "#text")		
		{			
			//console.log(row.nodeName);
			ret[i] = row.childNodes[0].innerHTML;
			i++;
		}
	}
	//console.log(ret);
	return ret;
}



function getData(date)
{
	//var returnval = "";
	 if (date == "") 
	 {
        document.getElementById("txtHint").innerHTML = "";
        //return returnval;
	 } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				//returnval = this.responseText;
				setText('calendar-eventtext', parseHTML(this.responseText));
				//setText('calendar-eventtext', returnval);
            }
        };
        //xmlhttp.open("GET","../functions/calender.func.php?date="+date,true);
		xmlhttp.open("GET","../functions/calender.func.php?date="+date,true);
        xmlhttp.send();
    }
}

function getAllEvents(month)
{
	//console.log(month);
	if (month == "") 
	 {
        //document.getElementById("txtHint").innerHTML = "";
	 } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				html_data = this.responseText;
            }
        };
        //xmlhttp.open("GET","../functions/calender.func.php?date="+date,true);
		xmlhttp.open("GET","../functions/calender.func.php?date="+month,false);
        xmlhttp.send();
    }
}

function setText(id, val){
    if(val < 10){
        val = '0' + val;    //add leading 0 if val < 10
    }
    
    var elements = document.getElementsByClassName(id);

    for (var i = 0; i < elements.length; i++) {
        elements[i].innerHTML = val;
    }}

function f_mouseover(onmouseover){
    this.className = "spezial";
}

function f_mouseout(onmouseout){
    this.className ="normal";
}

function initButtons (pfeil_b, pfeil_f, month, year){
    pfeil_f.setAttribute("currentMonth", month);
    pfeil_f.setAttribute("currentYear", year);
    pfeil_f.setAttribute("GoalDay", 1);
    pfeil_b.setAttribute("currentMonth", month);
    pfeil_b.setAttribute("currentYear", year);
    pfeil_b.setAttribute("GoalDay", 1);
    pfeil_b.onmouseover = b_mouseover;
    pfeil_b.onmouseout = b_mouseout;
    pfeil_f.onmouseout = b_mouseout;
    pfeil_f.onmouseover = b_mouseover;
    pfeil_f.onclick = b_f_mouseclick;
    pfeil_b.onclick = b_b_mouseclick;
}

function b_mouseover(onmouseover){
    this.className = "b_spezial";
}
function b_mouseout(onmouseout){
    this.className = "b_normal";
}
function b_f_mouseclick(onclick){
    var month = parseInt(this.getAttribute("currentMonth"));
    var year = parseInt(this.getAttribute("currentYear"));
    var day = parseInt(this.getAttribute("GoalDay"));
    var ret_d; 
    if(month>=11){
       ret_d = new Date(year+1,0,day);
    }else{
        ret_d = new Date(year, month+1, day);
    } 
    initKalender(ret_d);
}
function b_b_mouseclick(onclick){
    var month = parseInt(this.getAttribute("currentMonth"));
    var year = parseInt(this.getAttribute("currentYear"));
    var day = parseInt(this.getAttribute("GoalDay"));
    var ret_d; 
    if(month<=0){
       ret_d = new Date(year-1,11,day);
    }else{
        ret_d = new Date(year, month-1, day);
    }
    initKalender(ret_d);
}




