<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>
        <style type="text/css">
            #notMatchMessage{
                color: red;
                display: none;
            }
            #userTaken{
                color: red;
                display: none;
            }
            #added{
                color: green;
                display: none;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        //INSERT INTO `lab8_user` (`userId`, `firstName`, `lastName`, `email`, `username`, `password`, `zipCode`) VALUES (NULL, 'Alice', 'Jones', 'alice.jones@gmail.com', 'alice', 'abf', '93906');
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        <script>
            var userAvailable = false;
            var passwordsMatch = false;
        
        
            // function insertUserIntoDb(firstName, lastName, email, user, password){
            //     if(userAvailable && passwordsMatch){
                     
            //     }
            // }
        
            $(document).ready(function(){

                $(".button1").on("click",function(){
                    if($("#firstName").val() == "" || $("#lastName").val() == "" || $("#email").val() == "" || $("#phoneNumber").val() == "" || $("#userName").val() == "" || $("#password").val() == "" || $("#zipcode").val() == ""){
                        alert("please fill out all fields");
                    }else{
                        $.ajax({

                        type: "GET",
                        url: "addToDB.php",
                        dataType: "json",
                        data: { "firstname": $("#firstName").val(),
                                "lastname": $("#lastName").val(),
                                "email": $("#email").val(),
                                "username": $("#userName").val(),
                                "password": $("#password").val(),
                                "zipcode": $("#zipcode").val()
                        },
                        success: function(data,status) {
                        
                            // alert(data.password);
                            if (!data) {  //data == false
                                $("#added").show();
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                        });//ajax
                    }
                    
                });
                
                if($("#userName").val() == ""){
                    $("#userTaken").hide();
                }
                $("#userName").change(function() {
                    // alert($("#userName").val());
                    $.ajax({

                        type: "GET",
                        url: "checkusername.php",
                        dataType: "json",
                        data: { "username": $("#userName").val()},
                        success: function(data,status) {
                        
                            // alert(data.password);
                            
                            if (!data) {  //data == false
                                //  alert("Username is AVAILABLE!");
                                 $("#userTaken").hide();
                                 userAvailable = true;
                                
                                
                            } else {
                                $("#userTaken").show();
                                // alert("Username ALREADY TAKEN!");
                                userAvailable = false;
                                
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                        });//ajax
                });
                
                if($("#password").val() == "" && $("#re-password").val() == ""){
                    $("#notMatchMessage").hide();
                }
                
                $("#re-password").change(function(){
                    if($("#password").val() == $("#re-password").val()){
                        alert("passwords match");
                        passwordsMatch = true;
                        $("#notMatchMessage").hide();
                    }
                    else{
                        alert("passwords do not match");
                        passwordsMatch = false;
                        $("#notMatchMessage").show();
                    }
                });
                
                $("#zipcode").change(function(){
                    $.ajax({
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php?",
                        dataType: "json",
                        data: { "zip": $("#zipcode").val()},
                        success: function(data,status) {
                        // alert(data);
                        $("#city").html(data.city);
                        $("#lat").html(data.latitude);
                        $("#long").html(data.longitude);
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        
                        }
                        
                        });//ajax
                        
                    // alert($("#zipcode").val());
                });
                
                $("#stateSelect").change(function(){
                    $.ajax({
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php?",
                        dataType: "json",
                        data: { "state" : $("#stateSelect").val()},
                        success: function(data,status) {
                        $("#county").html("<option value=''> Select One </option>");
                        for(var i = 0; i < data.length; i++){
                            
                            $("#county").append("<option value='" + data[i].county + "'>" + data[i].county + "</option>");
                        }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        
                        }
                        
                        });//ajax
                });
                
            });
        
        </script>
        
    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text" id ="firstName"><br> 
                Last Name:   <input type="text" id = "lastName" ><br> 
                Email:       <input type="text" id = "email"><br> 
                Phone Number:<input type="text" id = "phoneNumber" ><br><br>
                Zip Code:    <input type="text" id="zipcode"><br>
                City:        <span id="city"></span>
                <br>
                Latitude:    <span id="lat"></span>
                <br>
                Longitude:   <span id="long"></span>
                <br><br>
                State: 
                <select id="stateSelect">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                Desired Username: <input id="userName" type="text"> <span id="userTaken">username is taken</span><br>
                
                Password: <input id="password" type="password"><br>
                
                Type Password Again: <input id="re-password" type="password"><br>
                <p id="notMatchMessage">passwords do not match</p>
                
                <button class="button1">Sign Up!</button>
                <h3 id="added">Added account to database</h3>
            </fieldset>
        </form>
        
    </body>
</html>
