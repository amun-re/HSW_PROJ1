/*jslint devel: true */

window.onload = function () {
    "use strict";
    var d = new Date();
    var month_name = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "Juni", "August", "September", "Oktber", "November", "Dezember"];
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
    document.getElementById("kalender_kopf_inhalt").innerHTML = month_name[month]+ " " + year;
    var kalender_table = getKalenderTable(day_number, last_date_day,d, wochentage);
    document.getElementById("kalender_bauch").appendChild(kalender_table);
    
    setText('calendar-day',wochentage[current_day_number]);
    setText('calendar-date', d.getDate());
    setText('calendar-month-year',  document.getElementById("kalender_kopf_inhalt").textContent);
     setText('calendar-eventtext', "Keine Veranstaltungen");
}
// Nummer desersten Tages des aktuellen Monats, Anzahl der Tage des aktuellen Monats
function getKalenderTable(day_number, last_date_day,d,wochentage){
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
        td.innerHTML = "";
        tr.appendChild(td);
    }
    var day_counter = 1;
    
    for(;i<=6;i++){
        var td = document.createElement("td");
        td.innerHTML = day_counter;
        td.onclick = f_click;
        td.onmouseover = f_mouseover;
        td.onmouseout = f_mouseout;
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
            if(day_counter > last_date_day){
                table.appendChild(tr);
            return table;
            }
            var td = document.createElement("td");
            if(day_counter == d.getDate()){  
            td.innerHTML = "<b><font color=\"blue\">" + day_counter + "</font></b>";
            }
            else{
                td.innerHTML = day_counter;
            }
            td.onclick = f_click;
            td.onmouseover = f_mouseover;
            td.onmouseout = f_mouseout;
            td.setAttribute("value",day_counter);
            td.setAttribute("wochentag", wochentage[i]);
            td.setAttribute("monatJahr", document.getElementById("kalender_kopf_inhalt").textContent);
            day_counter++;
            tr.appendChild(td);
             
        }
        table.appendChild(tr);
    }
    return table;
}

function f_click(onclick){
    setText('calendar-day',this.getAttribute("wochentag"));
    setText('calendar-date',this.getAttribute("value"));
    setText('calendar-month-year', this.getAttribute("monatJahr"));
    setText('calendar-eventtext', "Keine Veranstaltungen");
     
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