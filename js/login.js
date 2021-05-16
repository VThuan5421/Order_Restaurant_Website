$(document).ready(function() {
    $(".input-1").click(function() {
        $(".hr-1").css("border-color", "black");
        $("#user").css("color", "blueviolet");
    })
    $(".input-2").click(function() {
        $(".hr-2").css("border-color", "black");
        $("#lock").css("color", "blueviolet");
    })
    $(".login-button").click(function() {
        $(".hr-1, .hr-2").css("border-color", "rgb(194, 187, 187");
        $("#lock, #user").css("color", "grey");
    })
    $(".hide,.hide-1,.username-hide,.name-hide,.email-hide,.password-signup-hide,.confirm-password-signup-hide").css("color", "red")
    // for payment
    $("#momo-hidder").click(function(){
        $("#credit,#net-banking,#cash").collapse("hide");
    });
    $("#credit-hidder").click(function(){
        $("#momo,#net-banking,#cash").collapse("hide");
    });
    $("#net-banking-hidder").click(function(){
        $("#momo,#cash,#credit").collapse("hide");
    });
    $("#cash-hidder").click(function(){
        $("#momo,#net-banking,#credit").collapse("hide");
    });
    
    //login
    $(".login-button").click(function() {
        var name = $(".input-1").val();
        var check = /^[a-zA-Z\s]+$/; // for password
        var check_email = /^\w+([\.-]?\w+)*@\w([\.-]?\w+)*(\.\w{2,3})+$/;
        //username for login
        if(name == "") {
            $(".hide").text("Enter your email id");
            return false;
        }
        else {true;}
        if(!name.match(check_email)) {
            $(".hide").text("Enter you valid email");
            return false;
        }
        else {
            $(".hide").text("");
        }
        /*
        if(name.length > 20) {
            $(".hide").text("More than 20 char. is not allowed");
            return false;
        }
        else {$(".hide").text("");} */
        //username for login
        //pass for login
        var pass = $(".input-2").val();
        if(pass == "") {
            $(".hide-1").text("Enter your password");
            return false;
        }
        else {$(".hide-1").text("");}
    })
    //for sign-up btn
    $(".signup-button").click(function() {
        var name = $(".name").val();
        var username = $(".user_name").val();
        var check = /*/^[a-zA-Z\s]+$/;*/ /^[a-zA-Z0-9]+$/;
        //firstname for sign-up
        if(username == "") {
            $(".username-hide").text("Enter your username");
            return false;
        }
        else {true;}
        if(!username.match(check)) {
            $(".username-hide").text("Enter your valid username");
            return false;
        }
        else {true;}
        if(username.length > 20) {
            $(".username-hide").text("More than 20 char. is not allowed!");
            return false;
        }
        else {$(".username-hide").text("");}
        //lastname for signup
        if(name == "") {
            $(".name-hide").text("Enter your name");
            return false;
        }
        else {true;}
        if(!name.match(check)) {
            $(".name-hide").text("Enter your valid name");
            return false;
        }
        else {true;}
        if(name.length > 20) {
            $(".name-hide").text("More than 20 char. is not allowed!");
            return false;
        }
        else {$(".name-hide").text("");}
        //email for sign up
        var check_email = /^\w+([\.-]?\w+)*@\w([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = $(".email").val();
        if(email == "") {
            $(".email-hide").text("Enter your email id");
            return false;
        }
        else {true;}
        if(!email.match(check_email)) {
            $(".email-hide").text("Enter you valid email");
            return false;
        }
        else {
            $(".email-hide").text("");
        }
        //pass for sign-up
        var pw = $(".password-signup").val();
        if(pw == "") {
            $(".password-signup-hide").text("Enter your password");
            return false;
        }
        else { $(".password-signup-hide").text("");}
        // confirm-pass sign up
        var confirmPassword = $(".confirm-password-signup").val();
        if(confirmPassword == "") {
            $(".confirm-password-signup-hide").text("Enter your password");
            return false;
        }
        if(!confirmPassword.match(pw)) {
            $(".confirm-password-signup-hide").text("Your password did not match");
            return false;
        }
        else {
            $(".confirm-password-signup-hide").text("");
        } 
    });
    $(".hide-4,.hide-5,.hide-6,.hide-7").css("color", "red");
    // for form delivery
    $(".place-button").click(function() {
        var name = $("#txtName").val();
        if(name == "" || name == null) {
            $(".hide-4").text("Enter your name");
            return false;
        }
        //else {$(".hide".text(""));}
        else {true;}
        if (name != "" || name != null) {
            $(".hide-4").text("")
        }

        var check_phone = /^(0[234789][0-9]{8}|1[89]00[0-9]{4})$/;
        var phone = $("#txtPhone").val();

        if(phone == "" || phone == null) {
            $(".hide-5").text("Enter your number phone");
            return false;
        } else {true;}
        if(!phone.match(check_phone)) {
            $(".hide-5").text("Enter your valid phone");
            return false;
        } else {
            $(".hide-5").text("");
        }

        var address = $("#txtAddress").val();
        if(address == "" || address == null) {
            $(".hide-6").text("Enter your address");
            return false;
        } else {true;}
        if(address != "" || address != null) {
            $(".hide-6").text("");
        }
    });
})