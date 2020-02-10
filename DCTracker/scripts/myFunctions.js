var timeCheckerVar;
var loadParkingAreaVar;
var loadParkingViolationToday;

var loadDashNotifVar;
var loadDashLatestAct;

var loadUserOnlineVar;
var loadUserCountVar;
var loadAllViolationsTodayVar;

var loadAnnualReportVar;
var loadMonthlyReportVar;
var loadWeeklyReportVar;
var loadUserHistory;

var loadStatisticsVar;

var currentDate;

var userIdLoggedIn;
var taxiIdProfile;
var config,config2,config3;
var chart,chart2,chart3;

//For notifications
var currNotifCount;
var isFirstLoad = true;


var message1 = " has illegally parked at ";
var message2 = " has reached the boundary at ";
var loadingImage = '<tr>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                        '<td><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                    '</tr>';
var loadingImage2 = '<img src="../images/loadingBars/loading_3bars.gif" alt="" style="display:block; margin:auto;">';                    
var profilLoadingHeader = '<tr>'+
                                '<td class="wrapCol"><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                                '<td class="center"><small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                                '<td class="center" style="width:80px;"><small>Loading</small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                                '<td class="center" style="width:80px;"><small>Loading</small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                                '<td class="center" style="width:80px;"><small>Loading</small><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>'+
                            '</tr>';

var historyTableHeaders = '<tr><th >Taxi Name</th><th >Plate #</th><th >Type</th><th >Place of Violation</th><th >Date</th><th >Time</th><th>Profile</th></tr>';
var profileHeaders = '<tr><th >Place of Violation</th><th >Date</th><th >Time</th><th >Latitude</th><th >Longitude</th></tr>';

var notifTemp;
var searchTemp;

var secs=0;

//Initialized Functions
function initScripts(userId) {

    userIdLoggedIn = userId;
    //console.log('dashBoard functions initializing');
    timeCheckerVar = setInterval(getTime,1000);
    //  alert("User Id: "+userId);
    if(userIdLoggedIn == 1){
        loadParkingAreaVar = setInterval("returnValues('count(id) as \"count\"','places','where placeType=1',2)",5000);
        loadParkingViolationToday = setInterval("returnValues('*','parkviolationtoday','',3)",1000);
        loadAllViolationsTodayVar = setInterval("returnValues('*','allviolationtoday','',6)",5000);
    }
    
    loadDashNotifVar = setInterval("returnValues('*','violationview','',4)",3000); //Make the function a string if it doesn't work. Annoying, I know hahahaha
    loadDashLatestAct = setInterval("returnValues('*','violationview','',13)",3000);
    loadUserOnlineVar = setInterval("returnValues('*','usersonline','',5)",5000);
    
    loadUserCountVar = setInterval("returnValues('*','allusers','',7)",5000);
}
function initScripts2(userId){
    userIdLoggedIn = userId;
    //console.log('violationHistory functions initializing');
    loadDashNotifVar = setInterval("returnValues('*','violationview','',4)",3000);
    //timeCheckerVar = setInterval(getTime,1000);
    searchHistory('',1,'','');
}
function initScripts3(userId){
    userIdLoggedIn = userId;
    //console.log('Analytics functions initializing');
    //timeCheckerVar = setInterval(getTime,1000);
    loadDashNotifVar = setInterval("returnValues('*','violationview','',4)",3000);

    loadDoughtnutChart();
    loadDoughtnutChart2();
    loadDoughtnutChart3();

    loadAnnualReportVar = setInterval("returnValues('*','annualreportsview','',9)",3000);
    loadAnnualReportVar = setInterval("returnValues('*','monthlyreportsview','',10)",3000);
    loadAnnualReportVar = setInterval("returnValues('*','weeklyreportsview','',11)",3000);

    loadUserCountVar = setInterval("returnValues('*','allusers','',7)",5000);
}
function initScripts4(userId,taxiId){
    userIdLoggedIn = userId;
    taxiIdProfile = taxiId;

    loadDashNotifVar = setInterval("returnValues('*','violationview','',4)",3000);
    
    //timeCheckerVar = setInterval(getTime,1000);
    searchViolations();
    console.log("Starting profile");
}
//#region Otherfunctions
function redirectPage(pageUrl){
    window.location=pageUrl;
}
function changeValue(id,value) {
    var d = document.getElementById(id);
    d.innerHTML = value;    
}
function getValue(id){
    return document.getElementById(id).innerHTML;
}
function getAttValue(id,type){
    var d = document.getElementById(id);
    if(type == 'name'){
        return d.name;
    }else if(type == 'value'){
        return d.value;
    }
}
function setAttValue(id,type,value){
    var d = document.getElementById(id);
    d.setAttribute(type,value);
}
function showHide(id,showHide) {
    var d = document.getElementById(id);
    if (showHide) {
        d.style.display = "block";
    } else {
        d.style.display = "none";
    }
}
function getTime() {
    currentDate = new Date();
    changeValue("dateTime",
        from24To12Hour(currentDate.getHours())+":"+
        addExtraNumber(currentDate.getMinutes())+" "+
        getMeridiem(currentDate.getHours())+" "+
        numberToDate(currentDate.getMonth()) +" "+
        currentDate.getDate()+", "+
        currentDate.getFullYear()
        
    );


}
function changeAttribute(id,attributeName,value) {
    var d = document.getElementById(id);
    switch (attributeName) {
        case 0:
            
            break;
    
        default:
            break;
    }
}
//#endregion
//#region Mysql query for AJAX
function returnValues(select,from,where,functionIndex) {
    var myRequest = new XMLHttpRequest();
    var url = "../returnValues.php?select="+select+"&from="+from+"&where="+where;
    //console.log(url);
    myRequest.open("GET",url,true);
    myRequest.onreadystatechange = function () {
        //returns an array name 'result'
        // access the column of each row :  resultArr[INDEX].COLUMN_NAME

        if(this.readyState == 4 && this.status == 200){
            var resultJSON = JSON.parse(this.responseText);
            ////console.log("result length: "+resultJSON.result.length);

            if(resultJSON.result.length > 0){
                //select which function to execute
                ////console.log("Result Found");
                switch(functionIndex){
                    case 1:{
                        showUserResult(resultJSON.result);break;
                    }case 2:{
                        loadParkingAreas(resultJSON.result);break;
                    }case 3:{
                        loadViolationToday(resultJSON.result);break;
                    }case 4:{
                        loadDashboardNotifNoButtons(resultJSON.result);break;
                    }case 5:{
                        loadUsersOnline(resultJSON.result);break;
                    }case 6:{
                        loadAllParkingViolationToday(resultJSON.result);break;
                    }case 7:{
                        loadAllUserCount(resultJSON.result);break;
                    }case 8:{
                        processSearchResult(resultJSON.result);break;
                    }case 9:{
                        loadAnnualReports(resultJSON.result);break;
                    }case 10:{
                        loadMonthlyReports(resultJSON.result);break;
                    }case 11:{
                        loadWeeklyReports(resultJSON.result);break;
                    }case 12:{
                        loadUserViolations(resultJSON.result);break;
                    }case 13:{
                        loadDashboardNotif(resultJSON.result);break;
                    }
                }
            }else{
                return null;
            }
            
        }else{
            //Do something if request fails
            return null;
        }
    };
    myRequest.send();
}
function updateValues(table,sets,where,functionIndex){
    var myRequest = new XMLHttpRequest();
    var url = "../updateValues.php?table="+table+"&set="+sets+"&where="+where;
    //console.log(url);
    myRequest.open("GET",url,true);
    myRequest.onreadystatechange = function () {
        //returns an array name 'result'
        // access the column of each row :  resultArr[INDEX].COLUMN_NAME

        if(this.readyState == 4 && this.status == 200){
            var resultJSON = JSON.parse(this.responseText);
            ////console.log("result length: "+resultJSON.result.length);

            if(resultJSON.result.length > 0){
                //select which function to execute
                ////console.log("Result Found");
                switch(functionIndex){
                    case 1:{
                        resetNotifBar();break;
                    }
                }
            }else{
                return null;
            }
            
        }else{
            //Do something if request fails
            console.error("Update Failed. Pls check 'updateValues()' function @ myFunctions.php");
            return null;
        }
    };
    myRequest.send();
}
//#endregion
//#region Load functions
function resetNotifBar(){
    //changeValue("dashBoardNotification",loadingImage2);
}
function showUserResult(resultVar){
    //console.log("Var result " + resultVar);
    if(resultVar != null){
        alert(
            resultVar[0].id
        );
    }else{
        alert("No Results");
    }
}
function loadParkingAreas(resultVar){
    if(resultVar != null){
        changeValue("parkingAreas",resultVar[0].count);
    }    
}
function loadViolationToday(resultVar){
    if(resultVar != null){
        //console.log('parking violations today loaded');
        changeValue("parkingViolationsToday",resultVar[0].parkViolationToday);
    }
}
function loadAllParkingViolationToday(resultVar){
    if(resultVar != null){
        //console.log('all violations today loaded');
        changeValue('allViolationsToday',resultVar[0].allViolationToday);
    }
}
function loadUsersOnline(resultVar){
    if(resultVar != null){
        //console.log('users online loaded');
        changeValue('usersOnline',resultVar[0].usersOnline);    
    }    
}
function loadDashboardNotif(resultVar){
    if(resultVar == null){
        //console.log('No results. Returning...');
    }else{
        secs++;
        ////console.log('Refreshing '+secs);
        notifTemp = "";
        for(var n=0;n<resultVar.length;n++){
            if(userIdLoggedIn == 1 && resultVar[n].placeType == 1){
                //Illegal Parking notification
                notifTemp+=
                '<div class="notificationBox left">'+
                    '<span class="violatorName"><b>'+resultVar[n].taxiName+' </b></span>'+
                    '<span class="violatorPlate"><b>'+resultVar[n].plateNumber+'</b></span>';
                    //Check if illegal parking or out of bounds
                    if(resultVar[n].placeType == 1){
                        notifTemp+=message1;
                    }else{
                        notifTemp+=message2;
                    }
                notifTemp+='<span class="violatorPlace"><b>'+resultVar[n].placeName+'</b></span>'+
                    '<br>'+
                    '<small><b>'+numberToWordDate(resultVar[n].dateListed)+' at '+from24To12Hour2(resultVar[n].timeListed,false)+'</b></small>'+
                    '<div id="notifButtons'+resultVar[n].id+'">'+
                        '<button onclick="addMarker('+resultVar[n].userLat+','+resultVar[n].userLng+');" class="btn btn-primary button-width">View</button>'+' ';
                    
                    //Buttons
                    if(resultVar[n].status == 'pending'){
                        notifTemp += '<button onclick="approveIgnoreReport(true,'+resultVar[n].id+');" class="btn btn-danger">Report</button>'+' '+
                        '<button onclick="approveIgnoreReport(false,'+resultVar[n].id+');" class="btn btn-light  button-width">Ignore</button>';
                    }else{
                        notifTemp+='<br><small>Status: '+resultVar[n].status+'</small>';
                    }
                notifTemp+='</div>'+
                '</div>'+
                '<hr>';
            }else if(userIdLoggedIn == 2 && resultVar[n].placeType == 2){
                //Out of boundary notification
                notifTemp+=
                '<div class="notificationBox left">'+
                    '<span class="violatorName"><b>'+resultVar[n].taxiName+' </b></span>'+
                    '<span class="violatorPlate"><b>'+resultVar[n].plateNumber+'</b></span>';
                    //Check if illegal parking or out of bounds
                    if(resultVar[n].placeType == 1){
                        notifTemp+=message1;
                    }else{
                        notifTemp+=message2;
                    }
                notifTemp+='<span class="violatorPlace"><b>'+resultVar[n].placeName+'</b></span>'+
                    '<br>'+
                    '<small><b>'+numberToWordDate(resultVar[n].dateListed)+' at '+from24To12Hour2(resultVar[n].timeListed,false)+'</b></small>'+
                    '<div id="notifButtons'+resultVar[n].id+'">'+
                        '<button onclick="addMarker('+resultVar[n].userLat+','+resultVar[n].userLng+');" class="btn btn-primary button-width">View</button> ';
                    //Buttons
                    if(resultVar[n].status == 'pending'){
                        notifTemp += '<button onclick="approveIgnoreReport(true,'+resultVar[n].id+');" class="btn btn-danger">Report</button> '+
                        '<button onclick="approveIgnoreReport(false,'+resultVar[n].id+');" class="btn btn-light  button-width">Ignore</button> ';
                    }else{
                        notifTemp+='<br><small>Status: '+resultVar[n].status+'</small>';
                    }
                notifTemp+='</div>'+
                '</div>'+
                '<hr>';
            }else{
                
            }
            
        }
        changeValue('dashBoardLatestActivity',notifTemp);
    }    
}
function notifRead(newCurrentNotifCount){
    currNotifCount = newCurrentNotifCount;
    setAttValue("newNotif","class","");
}
function loadDashboardNotifNoButtons(resultVar){
    if(resultVar == null){
        //console.log('No results. Returning...');
    }else{
        //Check if this is first loading, hide the new notifIndicatior
        if(isFirstLoad){
            isFirstLoad = false;
            currNotifCount = resultVar.length;
            setAttValue("newNotif","class","");
        }else{
            //Check if there is a new notif by count, hide the notif if refreshed or notif button is clicked to update the currentNotif count
            if(resultVar.length != currNotifCount ){
                setAttValue("newNotif","class","indicator");
                setAttValue("navbarDropdownMenuLink1","onclick",'notifRead('+resultVar.length+');');
            }
        }

        secs++;
        ////console.log('Refreshing '+secs);
        notifTemp = "";
        for(var n=0;n<resultVar.length;n++){
            if(userIdLoggedIn == 1 && resultVar[n].placeType == 1){
                //Illegal Parking notification
                notifTemp+=
                '<div class="notificationBox left">'+
                    '<span class="violatorName"><b>'+resultVar[n].taxiName+' </b></span>'+
                    '<span class="violatorPlate"><b>'+resultVar[n].plateNumber+'</b></span>';
                    //Check if illegal parking or out of bounds
                    if(resultVar[n].placeType == 1){
                        notifTemp+=message1;
                    }else{
                        notifTemp+=message2;
                    }
                    notifTemp+='<span class="violatorPlace"><b>'+resultVar[n].placeName+'</b></span>'+
                        '<br>'+
                        '<small><b>'+numberToWordDate(resultVar[n].dateListed)+' at '+from24To12Hour2(resultVar[n].timeListed,false)+'</b></small>'+
                '</div>'+
                '<hr>';
            }else if(userIdLoggedIn == 2 && resultVar[n].placeType == 2){
                //Out of boundary notification
                notifTemp+=
                '<div class="notificationBox left">'+
                    '<span class="violatorName"><b>'+resultVar[n].taxiName+' </b></span>'+
                    '<span class="violatorPlate"><b>'+resultVar[n].plateNumber+'</b></span>';
                    //Check if illegal parking or out of bounds
                    if(resultVar[n].placeType == 1){
                        notifTemp+=message1;
                    }else{
                        notifTemp+=message2;
                    }
                    notifTemp+='<span class="violatorPlace"><b>'+resultVar[n].placeName+'</b></span>'+
                    '<br>'+
                    '<small><b>'+numberToWordDate(resultVar[n].dateListed)+' at '+from24To12Hour2(resultVar[n].timeListed,false)+'</b></small>'+
                '</div>'+
                '<hr>';
            }else{
                
            }
            
        }
        changeValue('dashBoardNotification',notifTemp);
    }    
}
function loadAllUserCount(resultVar){
    if(resultVar != null){
        changeValue('totalUsers',resultVar[0].allUsersCount);
    }
}
function processSearchResult(resultVar){
    //console.log("Processing search result");
    searchTemp = historyTableHeaders;
    var len = resultVar.length;
    if(processSearchResult != null){
        //setTimeout("",2000);
        for(var n=0;n<len;n++){
            searchTemp+='<tr>'+
            '<td class="wrapCol">'+resultVar[n].taxiName+'</td>'+
            '<td class="center">'+resultVar[n].plateNumber+'</td>'+
            '<td class="center" style="width:80px;">'+resultVar[n].violationType+'</td>'+
            '<td class="wrapCol">'+resultVar[n].placeName+'</td>'+
            '<td class="center" style="width:100px;">'+resultVar[n].dateListed+'</td>'+
            '<td class="center" style="width:80px;">'+resultVar[n].timeListed+'</td>'+
            '<td class="center" style="width:60px;"><button onclick="redirectPage(\'web_profile.php?id='+resultVar[n].userId+'\');" class="btn btn-info btn-block">View Profile</button></td>'+
        '</tr>';
        }
    }
    changeValue('searchResult',searchTemp);
}
function loadAnnualReports(resultVar){
    if(resultVar != null){
        changeValue('annualReports',resultVar[0].annualReports);
        updateAnnualDoughnutChart([
            resultVar[0].annualParkingReports,
            resultVar[0].annualOutOfBoundsReports
        ]);
    }
}
function loadMonthlyReports(resultVar){
    if(resultVar != null){
        changeValue('monthlyReports',resultVar[0].monthlyReports);
        updateMonthlyDoughnutChart([
            resultVar[0].monthlyParkingReports,
            resultVar[0].monthlyOutOfBoundsReports
        ]);
    }
}
function loadWeeklyReports(resultVar){
    if(resultVar != null){
        changeValue('weeklyReports',resultVar[0].weeklyReports);
        updateWeeklyDoughnutChart([
            resultVar[0].weeklyParkingReports,
            resultVar[0].weeklyOutOfBoundsReports
        ]);
    }
}
function loadUserViolations(resultVar){
    searchTemp = profileHeaders;
    var len = resultVar.length;
    if(resultVar != null){
        changeValue('taxiName',resultVar[0].taxiName);
        changeValue('taxiPlateNumber',resultVar[0].plateNumber);
        for(var n=0;n<len;n++){
            searchTemp+='<tr>'+
                '<td class="wrapCol">'+resultVar[n].placeName+'</td>'+
                '<td class="center">'+numberToWordDate(resultVar[n].dateListed)+'</td>'+
                '<td class="center" style="width:80px;">'+from24To12Hour2(resultVar[n].timeListed,false)+'</td>'+
                '<td class="center" style="width:80px;">'+resultVar[n].userLat+'</td>'+
                '<td class="center" style="width:80px;">'+resultVar[n].userLng+'</td>'+
            '</tr>';
        }
    }
    changeValue('searchResult',searchTemp);
}
//#region Init Doughnuts
function loadDoughtnutChart(){
    config = {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    data: [0,0],
                    backgroundColor: ["#000aff","#00069c"],
                    label: 'Dataset 1'
                }
            ],
            labels: [
                'Illegal Parking','Out of Bounds'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'All Annual Violations'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
    var ctx = document.getElementById('myChartAnnual').getContext('2d');
    chart = window.myDoughnut;
    chart = new Chart(ctx, config);
    chart.options.rotation = -1.5 * Math.PI;
}
function loadDoughtnutChart2(){
    config2 = {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    data: [0,0],
                    backgroundColor: ["#1cc543","#2ec551"],
                    label: 'Dataset 2'
                }
            ],
            labels: [
                'Illegal Parking','Out of Bounds'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'All Monthly Violations'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
    var ctx = document.getElementById('myChartMonthly').getContext('2d');
    chart2 = window.myDoughnut;
    chart2 = new Chart(ctx, config2);
    chart2.options.rotation = -1.5 * Math.PI;
}
function loadDoughtnutChart3(   ){
    config3 = {
        type: 'doughnut',
        data: {
            datasets: [
                {
                    data: [0,0],
                    backgroundColor: ["#36b9cc","#25d5f2"],
                    label: 'Dataset 1'
                }
            ],
            labels: [
                'Illegal Parking','Out of Bounds'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'All Weekly Violations'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
    var ctx = document.getElementById('myChartWeekly').getContext('2d');
    chart3 = window.myDoughnut;
    chart3 = new Chart(ctx, config3);
    chart3.options.rotation = -1.5 * Math.PI;
}
//#endregion
function randomUpdate(){
    updateDoughnutChart([1,2]);
}
//#region Update Doughnuts
function updateAnnualDoughnutChart(resultVar){
    config.data.datasets.forEach(function(dataset) {
        dataset.data = resultVar;
    });
    chart.update();
}
function updateMonthlyDoughnutChart(resultVar){
    config2.data.datasets.forEach(function(dataset) {
        dataset.data = resultVar;
    });
    chart2.update();
}
function updateWeeklyDoughnutChart(resultVar){
    config3.data.datasets.forEach(function(dataset) {
        dataset.data = resultVar;
    });
    chart3.update();
}
//#endregion
//#endregion
//#region Extra functions
function searchViolations(){
    //Search for parking or boundary violations by taxiId & violationType
    console.log("Searching");    
    if(taxiIdProfile == -1){
        return;
    }
    changeValue('taxiName',loadingImage2);
    changeValue('taxiPlateNumber',loadingImage2);
    changeValue('searchResult',profileHeaders+profilLoadingHeader);
    if(userIdLoggedIn == 1){
        setTimeout("returnValues('*','violationview','where userId="+taxiIdProfile+" AND placeType=1',12);",1000);
        //returnValues('*','violationview','where userId='+taxiIdProfile+' AND placeType=1',12);
    }else{
        setTimeout("returnValues('*','violationview','where userId="+taxiIdProfile+" AND placeType=2',12);",1000);
        //returnValues('*','violationview','where userId='+taxiIdProfile+' AND placeType=2',12);
    }
}
function approveIgnoreReport(isApproved,violationId){
    changeValue('notifButtons'+violationId,loadingImage2);
    if(isApproved){
        //Update via violation id loaded
        updateValues('violations','status="Reported"','id='+violationId,1);
    }else{
        updateValues('violations','status="Ignored"','id='+violationId,1);
    }
}
function numberToWordDate(numberDate){
    var temp = numberDate.split('-'); //yyyy-mm-dd
    return numberToDate(temp[1]-1)+" "+temp[2]+", "+temp[0]; //Have to subract 1 in month because function starts at 0 as January
}
function from24To12Hour2(value,includeSeconds){
    var temp = value.split(':'); //hh:mm:ss
    if(includeSeconds){
        return addExtraNumber(from24To12Hour(temp[0]))+
        ":"+addExtraNumber(temp[1])+":"+
        addExtraNumber(temp[2])+" "+
        getMeridiem(temp[0]);
    }else{
        return addExtraNumber(from24To12Hour(temp[0]))+
        ":"+addExtraNumber(temp[1])+" "+
        getMeridiem(temp[0]);
    }
}
function addExtraNumber(value){
    if(value <10){
        if(value.length < 2){
            return "0"+value;
        }else{
            return value;
        }
    }else{
        return value;
    }
}
function getMeridiem(hour24){
    if(hour24<13){
        return "AM";
    }else{
        return "PM";
    }
}
function from24To12Hour(value){
    if(value <13){
        if(value == 0){
            return addExtraNumber(12);
        }else{
            return addExtraNumber(value);
        }
    }else{
        return addExtraNumber(value-12);
    }
}
function numberToDate(index) {
    switch (index) {
        case 0:{
            return 'January';break;
        }case 1:{
            return 'February';break;
        }case 2:{
            return 'March';break;
        }case 3:{
            return 'April';break;
        }case 4:{
            return 'May';break;
        }case 5:{
            return 'June';break;
        }case 6:{
            return 'July';break;
        }case 7:{
            return 'August';break;
        }case 8:{
            return 'September';break;
        }case 9:{
            return 'October';break;
        }case 10:{
            return 'November';break;
        }case 11:{
            return 'December';break;
        }
        default:
            break;
    }
}
function searchHistory(toSearch,page,columnSort,sortOrder){
    //$sql = "SELECT * FROM Orders LIMIT 15, 10";    15=record starting EXCLUSIVE, 10=number of records
    var where = "";

    if(toSearch.length > 0){
        where+='WHERE plateNumber LIKE "%25'+toSearch+'%25" AND placeType="'+userIdLoggedIn+'" AND status!="pending"  ';
    }else{
        where+='WHERE placeType="'+userIdLoggedIn+'" AND status!="pending" ';
    }

    //Check if cctmo or ltfrb
    if(userIdLoggedIn == 1){
        where+=' AND placeType=1 ';
    }else if(userIdLoggedIn == 2){
        where+=' AND placeType=2 ';
    }else{}

    if(columnSort.length > 0){
        where+=" ORDER BY "+columnSort+" "+sortOrder+" ";
    }
    if(page > 1){
        where+=" LIMIT "+((page-1)*10)+",10";
    }else{
        where+=" LIMIT 0,10";
    }
    changeValue('searchResult',historyTableHeaders);
    changeValue('pageNumber',page);
    //console.log("condition made: "+where);
    returnValues('*','violationview',where,8);
}
function turnPage(nextOrPrev){
    var currentPage = parseInt(getValue('pageNumber'));
    switch (nextOrPrev) {
        case 1:{
            searchHistory(getAttValue('toSearch','value'),currentPage+1,'','');break;
        }case -1:{
            if(currentPage-1 != 0){
                searchHistory(getAttValue('toSearch','value'),currentPage-1,'','');
            }else{
                //searchHistory(getAttValue('toSearch','value'),1,'','');
            }
            break;
        }
    }
}

//#endregion