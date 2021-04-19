
<script>

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function setSession(token,id) {
    return new Promise(function(resolve, reject){
        // alert(token)
        $.ajax({
            type: "get",
            url : "{{ route('setsession') }}",
            data: {token:token,id:id},
            success : function(result){
                resolve(result)
            }
        });
    });
}

function today(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

    today = yyyy+'-'+mm+'-'+dd;
    console.log(today)
    if($('input[type="date"]').length > 0){

        var pathname = window.location.pathname;
        if(pathname != '/web/register'){
            $('input[type="date"]').attr("min", today);
        }else{
            $('input[type="date"]').attr("max", today);
        }
    }

}
today()

function stopPaste(){

    $('input[type=text]').attr('onpaste','return false');

}
stopPaste()

function setAddtoCartSession(service,cart_id){
    return new Promise(function(resolve,reject){
        $.ajax({
            type: "get",
            url : "{{ route('setCartSession') }}",
            data: {service:service,cart_id:cart_id},
            success : function(result){
                resolve(result)
            }
        });
    });
}

function destroyCartsession(){
    return new Promise(function(resolve,reject){
        $.ajax({
            type: "get",
            url : "{{ route('destroyCartsession') }}",
            data: {service:service,cart_id:cart_id},
            success : function(result){
                resolve(result)
            }
        });
    });
}


function ValidateEmail(mail)
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    alert("You have entered an invalid email address!")
    return (false)
}

function printElement(elem, append, delimiter) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    if (append !== true) {
        $printSection.innerHTML = "";
    }

    else if (append === true) {
        if (typeof(delimiter) === "string") {
            $printSection.innerHTML += delimiter;
        }
        else if (typeof(delimiter) === "object") {
            $printSection.appendChlid(delimiter);
        }
    }

    $printSection.appendChild(domClone);
}

$( document ).ready( function (){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    } );

    $( '#login' ).click( function ()
    {
        var email = $( '#email' ).val();
        var password = $( '#password' ).val();
        var device_token = 'WEB';
        var device_type = '3';

        if ( ( email == '' ) || ( password == '' ) )
        {
            alert( 'Please fill all fields!' )
            return false
        }

        $.ajax( {
            type: "post",
            url: "{{ url('api/login') }}",
            data: { email: email, password: password, device_token: device_token, device_type: device_type },
            success: async function ( result, textStatus, xhr )
            {
                const session = await setSession(result.body.user_token,result.body.id)
                // console.log(session)
                if(session) location.replace("{{ route('web.home') }}");
            },
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
            }
        })

    })

    $('#logout').click(function(){
        $.ajax({
            type: "get",
            url : "{{ route('destroysession') }}",
            // data: {token,token},
            success : function(result){
                    if(result) location.replace("{{ route('web.home') }}");
            }
        });
    })

    $('#continue').click(function(){

        var first_name = $('input[name="first_name"]').val();
        var last_name = $('input[name="last_name"]').val();
        var dob = $('input[name="dob"]').val();

        var date = new Date(dob);
        var getDate = date.getDate();
        getDate = (String(getDate).length == 2) ? getDate : '0'+ getDate;
        var getMonth = date.getMonth() + 1;
        getMonth = (String(getMonth).length == 2) ? getMonth : '0'+ getMonth;
        var getYear = date.getFullYear();
        var newDate = getYear + '-' + getMonth + '-' + getDate;

        var dob = newDate;


        var country_code = $('input[name="country_code"]').val();
        var contact = $('input[name="contact"]').val();
        var username = $('input[name="username"]').val();
        var email = $('#regester_email').val();

        if(!ValidateEmail(email)){
            return false
        }

        var password = $('#regester_password').val();
        var password_confirmation = $('input[name="password_confirmation"]').val();
        if(password !== password_confirmation){
            alert('Confirm password doesn`t match');
            return false;
        }
        var school_name = $('input[name="school_name"]').val();
        var in_campus = $('input[name="in_campus_value"]').val();
        var hall = $('input[name="hall"]').val();
        var room_number = $('input[name="room_number"]').val();
        var address = $('input[name="address"]').val();
        var city = $('input[name="city"]').val();
        var state = $('input[name="state"]').val();
        var zipcode = $('input[name="zipcode"]').val();
        var country = $('input[name="country"]').val();
        var pfirst_name = $('input[name="pfirst_name"]').val();
        var plast_name = $('input[name="plast_name"]').val();
        var pemail = $('input[name="pemail"]').val();
        console.log(pemail)
        if(!ValidateEmail(pemail)){
            return false
        }
        var pcontact = $('input[name="pcontact"]').val();
        var pcountry_code = $('input[name="pcountry_code"]').val();
        var billing_address = $('input[name="billing_address"]').val();
        var billing_city = $('input[name="billing_city"]').val();
        var billing_state = $('input[name="billing_state"]').val();
        var billing_zipcode = $('input[name="billing_zipcode"]').val();
        var appartment_number = $('input[name="appartment_number"]').val();
        var gate_code = $('input[name="gate_code"]').val();
        var name_on_card = $('input[name="name_on_card"]').val();
        var card_type = $('select[name="card_type"]').val();
        var card_number = $('input[name="card_number"]').val();
        if((card_number.length < 16) || (card_number.length > 16) ){
            alert('Please enter valid card number')
            return false;
        }
        var expiry_month = $('select[name="expiry_month"]').val();
        var expiry_year = $('select[name="expiry_year"]').val();
        var terms = $('input[name="terms"]:checked').val();
        if(terms != '1'){
            alert('Please appect terms and condition!');
            return false;
        }
        var policies = $('input[name="policies"]:checked').val();
        if(policies != '1'){
            alert('Please appect Policies and privacy!');
            return false;
        }


        //console.log((first_name) ,(last_name) ,(dob) , (country_code ) ,(contact),(username) ,(email) ,(password) ,(school_name) ,(in_campus) ,(hall) , (room_number) , (address) , (city) , (state), ( zipcode) ,( country) ,(pfirst_name), (plast_name) , (pemail) ,(pcontact) ,(pcountry_code), (billing_address) ,(billing_city) ,(billing_state), (billing_zipcode), (appartment_number), (gate_code) , (name_on_card) ,(card_type), (card_number), (expiry_month) , (expiry_year), (terms) ,(policies) )

        var image = $('#file')[0].files[0];
        var schedule = $('#file1')[0].files[0];


        if((first_name == '') || (last_name == '') || (dob == '') || (country_code == '') || (contact == '') || (username == '') || (email == '') || (password == '') || (school_name == '') || (in_campus == '') || ( (in_campus== '1') && (hall == '')) || ( (in_campus== '1') && (room_number == '') ) || ( (in_campus== '0') && (address == '')) || ( (in_campus== '0') && (city == '')) || ( (in_campus== '0') && (state == '')) || ( (in_campus== '0') && (zipcode == '')) || ( (in_campus== '0') && (country == '')) || (pfirst_name == '') || (plast_name == '') || (pemail == '') || (pcontact == '') || (pcountry_code == '') || (billing_address == '') || (billing_city == '') || (billing_state == '') || (billing_zipcode == '') || (appartment_number == '') || (gate_code == '') || (name_on_card == '') || (card_type == '') || (card_number == '') || (expiry_month == '') || (expiry_year == '') || (terms == '') || (policies == '')   ){
            alert('Please fill all fields!');
            return false;
        }

        var form = $('#formData');

        $.ajax({
            type:"post",
            url: "{{ url('api/register') }}",
//            data: {first_name:first_name, last_name:last_name, dob:dob, country_code:country_code,contact:contact,username, email:email,password:password,school_name:school_name,in_campus:in_campus,hall:hall,room_number:room_number,address:address,city:city,state:state,zipcode:zipcode,country:country,pfirst_name:pfirst_name,plast_name:plast_name,pemail:pemail,pcontact:pcontact,pcountry_code:pcountry_code,schedule:schedule,image:image},
            data: new FormData(document.getElementById("formData")),
            contentType: false,
            cache: false,
            processData:false,
            async: false,
            complete: async function(e, xhr, settings){
                if(e.responseJSON.status == 200){

                    const session = await setSession(e.responseJSON.body.user_token,e.responseJSON.body.id)
                    var user_id = e.responseJSON.body.id;

                    $.ajax({
                        type:"post",
                        url: "{{ url('api/billingAddress_web') }}",
                        data:{user_id:user_id,address:billing_address, city:billing_city, state:billing_state, zipcode:billing_zipcode, appartment_number:appartment_number, gate_code:gate_code   },
                        complete: function(e, xhr, settings){

                            console.log("{{\Session::get('auth_token')}}")

                            if(e.responseJSON.status == 200){
                                $.ajax({
                                    type:"post",
                                    url: "{{ url('api/addupdateCard_web') }}",
                                    data:{user_id:user_id, name_on_card:name_on_card, card_type:card_type, card_number:card_number,  expiry_month:expiry_month, expiry_year:expiry_year, is_default:'1' },
                                    complete: function(e, xhr, settings){

                                        if(e.responseJSON.status == 200){
                                            alert('Register Successfully!')
                                            location.replace("{{ route('web.home') }}");
                                        }else{
                                            alert(e.responseJSON.message)
                                        }
                                    }
                                })
                            }else{
                                alert(e.responseJSON.message)
                            }
                        }
                    });

                }else{
                    alert(e.responseJSON.message)
                }


            }
        })

    })


    $('#submit_laundry').click(function(){

        var inventry = $('.inventry');
        var dryclean = $('.dryclean');
        var subscription_id = $('input[name="subscription_id"]').val();

        var gratuity = $('input[name="gratuity_amount"]').val();;
        var card_id = $('input[name="laundry_card_id"]').val();
        var token = $('input[name="laundry_token"]').val();
        var total_amount = $('input[name="laundry_total"]').val();

        var is_dryclean = 0;

        var laundry_items = [];
        var dryclean_id = [];

        for(var i = 0; i < inventry.length; i++){
            var value = $(inventry[i]).val()
            if(value != null && value != ''){
                laundry_items.push({
                    "item_id":$(inventry[i]).data('inventry_id'),
                    "quantity":$(inventry[i]).val()
                })
            }
        }

        for(var i = 0; i < dryclean.length; i++){
            var value = $(dryclean[i]).val()
            // console.log(value)
            if(value != null && value != ''){
                dryclean_id.push({
                    "dryclean_id":$(dryclean[i]).data('dryclean_id'),
                    "quantity":$(dryclean[i]).val()
                })
            }
        }

        if((laundry_items.length < 1) &&  (dryclean_id.length < 1) ){
            alert('Please select the inventory items.')
            return false;
        }

        if(laundry_items.length > 0){
            laundry_items = JSON.stringify(laundry_items)
        }else{
            laundry_items = '';
        }

        if(dryclean_id.length >0){
            dryclean_id = JSON.stringify(dryclean_id)
            is_dryclean = 1

        }

        if( subscription_id == '' ){
            alert('Something went wrong, Please reload the page and try again')
            return false;
        }

        $('#submit_laundry').css({
            "pointer-events": "none"
        });

        $.ajax({
            type:"post",
            url:"{{ url('api/addToCartLaundry') }}",
            data:{subscription_id:subscription_id, gratuity:0, laundry_items:laundry_items, is_dryclean:is_dryclean, dryclean_id:dryclean_id},
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            success: function(result){
                // alert(result.message);
                console.log(result)
                var cart_id = result.body.id

                $.ajax({
                    type:"post",
                    url: "{{ url('api/bookLaundry') }}",
                    data: {cart_id:cart_id, total:total_amount, subscription_id:subscription_id, token:token, card_id:card_id, gratuity:gratuity},
                    beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                    success: function(result){

                    },
                    complete: function(e, xhr, settings){
                        console.log(e.responseJSON)
                        // return false;
                        alert(e.responseJSON.message)
                        if(e.responseJSON.status == 200){
                            location.reload();
                        }
                    }

                })
            },
            complete:function(e, xhr, settings){
                // alert(e.responseJSON.message);
            }

        })


    })

    function convertTime12to24(time12h) {
        const [time, modifier] = time12h.split(' ');

        let [hours, minutes] = time.split(':');

        if (hours === '12') {
            hours = '00';
        }

        if (modifier === 'PM') {
            hours = parseInt(hours, 10) + 12;
        }

        return `${hours}:${minutes}`;
    }


    $('#storage_update_dropoff').click(function(){
        var subscription_id = $('input[name="subscription_id"]').val()
        var dropoff_date = $('input[name="dropoff_date"]').val()
        var dropoff_time = $('input[name="dropoff_time"]').val()
        var address = $('input[name="dropoff_address"]').val()

        var date = new Date(dropoff_date);
        var getDate = date.getDate();
        getDate = (String(getDate).length == 2) ? getDate : '0'+ getDate;
        var getMonth = date.getMonth() + 1;
        getMonth = (String(getMonth).length == 2) ? getMonth : '0'+ getMonth;
        var getYear = date.getFullYear();
        var newDate = getYear + '-' + getMonth + '-' + getDate;

        dropoff_date = newDate;

        dropoff_time = convertTime12to24(dropoff_time)

        if((subscription_id == '') || (dropoff_date == '') || (dropoff_time == '') || (address == '') ){
            alert('Please fill all fields!')
            return false
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/rescheduleStorage') }}",
            data: {service_id:subscription_id, dropoff_date:dropoff_date, dropoff_time:dropoff_time, address:address },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                location.reload()
            }
        })

    })

    $('#storage_update_pickup').click(function(){
        var subscription_id = $('input[name="subscription_id"]').val()
        var pickup_date = $('input[name="pickup_date"]').val()
        var pickup_time = $('input[name="pickup_time"]').val()
        var address = $('input[name="pickup_address"]').val()

        var date = new Date(pickup_date);
        var getDate = date.getDate();
        getDate = (String(getDate).length == 2) ? getDate : '0'+ getDate;
        var getMonth = date.getMonth() + 1;
        getMonth = (String(getMonth).length == 2) ? getMonth : '0'+ getMonth;
        var getYear = date.getFullYear();
        var newDate = getYear + '-' + getMonth + '-' + getDate;

        pickup_date = newDate;

        pickup_time = convertTime12to24(pickup_time)

        if((subscription_id == '') || (pickup_date == '') || (pickup_time == '') || (address == '') ){
            alert('Please fill all fields!')
            return false
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/rescheduleStorage') }}",
            data: {service_id:subscription_id, pickup_date:pickup_date, pickup_time:pickup_time, address:address },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                location.reload()
            }
        })

    });


    $('#housekeeping_reschedule_done').click(function(){
        var subscription_id = $('input[name="subscription_id"]').val()
        var pickup_date = $('input[name="housekeeping_pickup_date"]').val()
        var pickup_time = $('input[name="housekeeping_pickup_time"]').val()
        var address = $('input[name="housekeeping_address"]').val()

        var date = new Date(pickup_date);
        var getDate = date.getDate();
        getDate = (String(getDate).length == 2) ? getDate : '0'+ getDate;
        var getMonth = date.getMonth() + 1;
        getMonth = (String(getMonth).length == 2) ? getMonth : '0'+ getMonth;
        var getYear = date.getFullYear();
        var newDate = getYear + '-' + getMonth + '-' + getDate;

        pickup_date = newDate;

        pickup_time = convertTime12to24(pickup_time)

        if((subscription_id == '') || (pickup_date == '') || (pickup_time == '') || (address == '') ){
            alert('Please fill all fields!')
            return false
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/rescheduleHousekeeping') }}",
            data: {service_id:subscription_id, pickup_date:pickup_date, pickup_time:pickup_time, address:address },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                location.reload()
            }
        })
    })

    $('#changepassword').click(function(){
        // var oldpassword = $('input[name="oldpassword"]').val()
        var newpassword = $('input[name="newpassword"]').val()
        var newpassword_con = $('input[name="newpassword_con"]').val()

        if( (newpassword == '') || (newpassword_con == '')){
            alert('Please fill all fields!')
            return false
        }

        if(newpassword !== newpassword_con){
            alert('New Password and Confirm Password doesn`t Match');
            return false;
        }

        $.ajax({
            type: "post",
            url: "{{ url('api/changepassword') }}",
            data: { newpassword:newpassword},
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                if(e.responseJSON.status == 200){
                    $('#for_g').modal('hide');
                    $("#thnk_you").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#thnk_you').modal('show');
                }
            }
        })


    });

    $('#forgetpasswordlink').click(function(){
        var email = $('input[name="email"]').val();

        if(!ValidateEmail(email)){
            return false
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/forgetPassword') }}",
            data: {email:email},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    $('#forgetpassword').modal('hide')
                    $('#thnk_you1').modal('show')
                    $('#forgetpassword_message').text(e.responseJSON.message)
                }else{
                    alert(e.responseJSON.message)
                }
            }
        })

    });

    $('#editprofile').click(function(){
        var first_name = $('input[name="first_name"]').val();
        var last_name = $('input[name="last_name"]').val();
        var country_code = $('input[name="country_code"]').val();
        var contact = $('input[name="contact"]').val();
        var email = $('input[name="email"]').val();
        var dob = $('input[name="dob"]').val();
        var school_name = $('input[name="school_name"]').val();
        var in_campus = $('input[name="in_campus"]').val();
        var hall = $('input[name="hall"]').val();
        var room_number = $('input[name="room_number"]').val();
        var address = $('input[name="address"]').val();
        var city = $('input[name="city"]').val();
        var state = $('input[name="state"]').val();
        var zipcode = $('input[name="zipcode"]').val();
        var country = $('input[name="country"]').val();
        var image = $('#imgInp')[0].files[0];

        if((first_name == '') || (last_name == '') || (country_code == '') || (contact == '') || (email == '') || (dob == '') || (school_name == '') || (in_campus == '') || ( (in_campus == 1) && (hall == '')) || ((in_campus == 1) && (room_number == '')) || ((in_campus == 0) && (address == '')) || ((in_campus == 0) && (city == ''))  || ((in_campus == 0) && (state == '')) || ((in_campus == 0) && (zipcode == '')) || ((in_campus == 0) && (country == '')) ){
            alert('Please fill all fields!')
            return false
        }

        $.ajax({
            type: "post",
            url: "{{ url('api/updateProfile') }}",
            data: new FormData(document.getElementById("editprofile_data")),
            contentType: false,
            cache: false,
            processData:false,
            async: false,
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){

                if(e.responseJSON.status == 200){
                    $('#edit_details').modal('hide')
                    $('#profileupdate_message').text(e.responseJSON.message)
                    $("#thnk_you2").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#thnk_you2').modal('show')
                }else{
                    alert(e.responseJSON.message)
                }



            }
        })



    });

    $('#updatecard').click(function(){
        // alert('asdsa');
        $.ajax({
            type:"post",
            url: "{{ url('api/addupdateCard') }}",
            data: new FormData(document.getElementById("paymentupdate")),
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            contentType: false,
            cache: false,
            processData:false,
            async: false,
            complete: function(e, xhr, settings){

                if(e.responseJSON.status == 200){
                    alert('Card details updated successfully!');
                    location.reload()
                }else{
                    alert(e.responseJSON.message)
                }
            }
        })

    })

    $('#updatebillingdata').click(function(){

        var address = $('input[name="billing_address"]').val()
        var city = $('input[name="billing_city"]').val()
        var state = $('input[name="billing_state"]').val()
        var zipcode = $('input[name="billing_zipcode"]').val()
        var appartment_number = $('input[name="billing_appartment_number"]').val()
        var gate_code = $('input[name="billing_gate_code"]').val()

        $.ajax({
            type:"post",
            url: "{{ url('api/billingAddress') }}",
            data: { address: address, city:city, state:state, zipcode:zipcode, appartment_number:appartment_number, gate_code:gate_code },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    alert('Billing Address updated successfully!');
                    location.reload()
                }else{
                    alert(e.responseJSON.message)
                }
            }
        })

    });

    $('#fileaclaim').click(function(){
        var data = new FormData(document.getElementById('claim_data'))

        $.ajax({
            type:"post",
            url: "{{ url('api/claim') }}",
            data: data,
            contentType: false,
            cache: false,
            processData:false,
            async: false,
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    alert('Thank you for submitting your laundry claim. Please allow up 5-7 business days to resolve this matter. ');
                    location.reload()
                }else{
                    alert(e.responseJSON.message)
                }
            }
        })

    });

    $('#updateServiceAddress').click(function(){

        var data = new FormData(document.getElementById('serviceaddressdata'))

        $.ajax({
            type:"post",
            url: "{{ url('api/updateServiceAddress') }}",
            data: data,
            contentType: false,
            cache: false,
            processData:false,
            async: false,
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    alert(e.responseJSON.message);
                    location.reload()
                }else{
                    alert(e.responseJSON.message)
                }
            }
        })
    });


    $('body').on('click','#housekeepingreschedule',function(){
        // alert('dasdas')
        var subscription_id = $(this).data('subscription_id')
        var pickup_date = $('input[name="housekeeping_pickup_date1"]').val()
        var pickup_time = $('input[name="housekeeping_pickup_time1"]').val()
        var address = $('input[name="housekeeping_address1"]').val()

        var date = new Date(pickup_date);
        var getDate = date.getDate();
        getDate = (String(getDate).length == 2) ? getDate : '0'+ getDate;
        var getMonth = date.getMonth() + 1;
        getMonth = (String(getMonth).length == 2) ? getMonth : '0'+ getMonth;
        var getYear = date.getFullYear();
        var newDate = getYear + '-' + getMonth + '-' + getDate;

        pickup_date = newDate;

        pickup_time = convertTime12to24(pickup_time)

        if((subscription_id == '') || (pickup_date == '') || (pickup_time == '') || (address == '') ){
            alert('Please fill all fields!')
            return false
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/rescheduleHousekeeping') }}",
            data: {service_id:subscription_id, pickup_date:pickup_date, pickup_time:pickup_time, address:address },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                location.reload()
            }
        })



    })


    $('body').on('click','#storagereschedule',function(){

        var subscription_id = $(this).data('subscription_id')
        var dropoff_date = $('input[name="dropoff_date1"]').val()
        var dropoff_time = $('input[name="dropoff_time1"]').val()
        var address = $('input[name="dropoff_address1"]').val()

        var date = new Date(dropoff_date);
        var getDate = date.getDate();
        getDate = (String(getDate).length == 2) ? getDate : '0'+ getDate;
        var getMonth = date.getMonth() + 1;
        getMonth = (String(getMonth).length == 2) ? getMonth : '0'+ getMonth;
        var getYear = date.getFullYear();
        var newDate = getYear + '-' + getMonth + '-' + getDate;

        dropoff_date = newDate;

        dropoff_time = convertTime12to24(dropoff_time)

        if((subscription_id == '') || (dropoff_date == '') || (dropoff_time == '') || (address == '') ){
            alert('Please fill all fields!')
            return false
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/rescheduleStorage') }}",
            data: {service_id:subscription_id, dropoff_date:dropoff_date, dropoff_time:dropoff_time, address:address },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                location.reload()
            }
        })

    })

    $('body').on('click','#Save_Preferences' , function(){
        var rush_delivery = $('input[name="rush_delivery"]:checked').val()
        if(rush_delivery == 'on'){
            rush_delivery = '1';
        }else{
            rush_delivery = '2';
        }
        var leave_laundry = $('input[name="leave_laundry"]').val()
        var delivery_instructions = $('input[name="delivery_instructions"]').val()
        var agree = $('input[name="agree"]:checked').val()

        var tab = $('input[name="tabSelected"]').val();

        if(agree != 'on' && tab == '1'){
            alert('Please Accept terms first!');
            return false
        }

        var detergent = $('select[name="detergent"]').val()
        var starch = $('select[name="starch"]').val()
        var fabric_softner = $('input[name="fiber_softner"]:checked').val()
        if(fabric_softner == 'on'){
            fabric_softner = "1"
        }else{
            fabric_softner = "2"
        }
        var oxiclean = $('input[name="oxiclean"]:checked').val()
        if(oxiclean == 'on'){
            oxiclean = "1"
        }else{
            oxiclean = "0"
        }

        var vaccum = $('.vaccum:checked').val();
        if(vaccum == undefined){
            vaccum = "2"
        }
        var mop = $('.mop:checked').val();
        if(mop == undefined){
            mop = "2"
        }
        var cleaning_product = $('.cleaning_product:checked').val();
        if(cleaning_product == undefined){
            cleaning_product = "2"
        }
        var pets = $('.pets:checked').val();
        if(pets == undefined){
            pets = "2"
        }

        if(tab == '1'){
            var data = {rush_delivery:rush_delivery, leave_laundry:leave_laundry, delivery_instructions:delivery_instructions}
        }else{
            var data = {detergent:detergent, starch:starch, fabric_softner:fabric_softner, oxiclean:oxiclean, vaccum:vaccum, mop:mop ,cleaning_product:cleaning_product, pets:pets }
        }

        $.ajax({
            type: "post",
            url: "{{ url('api/prefference') }}",
            data: data,
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                alert(e.responseJSON.message)
                if(e.responseJSON.status == 200){
                    location.reload()
                }
            }
        })



    });

    $('#completeBooking').click(function(){
        var service = $('input[name="service"]').val()
        var plan_id = $('input[name="plan_id"]').val()
        var insurance = $('input[name="insurance"]').val()
        // alert(insurance)
        // return false
        var pickup_date = $('input[name="pickup_date"]').val()
        var dropoff_date = $('input[name="droppoff_date"]').val()
        var pickup_time = $('input[name="pickup_time"]').val()
        var dropoff_time = $('input[name="droppoff_time"]').val()
        var dorm_name = $('input[name="dorm_name"]').val()
        var frequency = $('select[name="frequency"]').val()
        var address = $('input[name="address"]').val()
        var addons = $('input[name="addons"]').val()
        var checkCartSession = "{{ \Session::get('service') }}";
        var same_as_signup = '0'
        var largeItem = ($('#largeItem:checked').val() == 'on') ? '1' : '0';

        if(service == 'Laundry'){
            if((service == '') || (plan_id == '') || (dropoff_date == '') || (dropoff_time == '') ||  (dorm_name == '' || (same_as_signup == '')  ) ){
                alert('Please fill all fields!');
            }

            var data = {service:service, plan_id:plan_id,insurance:insurance, dropoff_date:dropoff_date, dropoff_time:dropoff_time, dorm_name:dorm_name, same_as_signup:same_as_signup }

        }

        if(service == 'Housekeeping'){
            if((service == '') || (plan_id == '') || (pickup_date == '') || (pickup_time == '') ||  (address == '' && (same_as_signup == '') ) ||  (frequency == '') ){
                alert('Please fill all fields!');
            }

            var data = {service:service, plan_id:plan_id,insurance:insurance, pickup_date:pickup_date, pickup_time:pickup_time, address:address, same_as_signup:same_as_signup, addons:addons, frequency:frequency }
        }

        if(service == 'Storage'){
            if((service == '') || (plan_id == '') || (pickup_date == '') || (pickup_time == '') || (dropoff_date == '') || (dropoff_time == '') ||  (address == '' && (same_as_signup == '') ) ||  (largeItem == '') ){
                alert('Please fill all fields!');
            }

            var data = {service:service, plan_id:plan_id,insurance:insurance, pickup_date:pickup_date, pickup_time:pickup_time,dropoff_date:dropoff_date, dropoff_time:dropoff_time, address:address, same_as_signup:same_as_signup, addons:addons, largeItem:largeItem }
        }

        if(checkCartSession != ''){

            $.ajax({
                type: "post",
                url: "{{ url('api/editPlan') }}",
                data: data,
                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                complete: async function(e, xhr, settings){

                    if(e.responseJSON.status == 200){
                            await destroyCartsession
                            location.replace("{{ route('web.cart') }}");
                            return false;
                    }else{
                        alert(e.responseJSON.message)
                        return false;
                    }
                }

            })

        }else{

            $.ajax({
                type: "post",
                url: "{{ url('api/addToCart') }}",
                data: data,
                beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
                complete: function(e, xhr, settings){

                    if(e.responseJSON.status == 200){
                            location.replace("{{ route('web.cart') }}");
                            return false;
                    }else{
                        alert(e.responseJSON.message)
                        return false;
                    }

                }
            })

        }


    });

    $('.payout').click(function(){

        var cart_id = $('input[name="cart_id"]').val();
        var subtotal = $('input[name="total_amount"]').val();
        var total = $('input[name="total"]').val();
        var card_id = $('input[name="card_id"]').val();
        var token = $('input[name="card_token"]').val();
        var gratuity = $('input[name="gratiuty_amount"]').val();
        var coupon = $('input[name="coupon"]').val();
        var service_fee = $('input[name="service_fee"]').val();
        var tax = $('input[name="tax"]').val();

        $.ajax({
            type:"post",
            url:"{{ url('api/booking') }}",
            data: {cart_id:cart_id, subtotal:subtotal, total:total, card_id:card_id, token:token, gratuity:gratuity, coupon:coupon, tax:tax},
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){

                // console.log(e.responseJSON.body)

                if(e.responseJSON.status == 200){

                    var body = e.responseJSON.body

                    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    var transactionDate = body.transactionDate

                    var date = new Date(transactionDate);
                    var getDate = date.getDate();

                    getDate = (getDate >= 10 ) ? getDate : '0'+ getDate;
                    var getMonth = months[date.getMonth()] ;

                    var getYear = date.getFullYear();

                    transactionDate = getMonth+ ' ' + getDate + ', ' + getYear;
                    $('.transactionDate').text("Transaction date "+transactionDate)

                    // $('#invoiceforOrderid').html('Order ID: ' + )

                    if(body.billingAddress){
                        $('.billingAddress').html(body.billingAddress.address + "<br>" + body.billingAddress.city + ", " + body.billingAddress.state + "<br>" + body.billingAddress.zipcode )
                    }

                    // console.log(body);

                    body.items.forEach(function(item,index){

                        if(item.sevrice == 'Laundry'){
                            var desc = item.allDetais.weight + 'LBS'
                            var price = item.allDetais.price

                            if(body.insurance){
                                var insurancePrice = body.insurance.priceName
                            }else{
                                var insurancePrice = ''
                            }

                        }

                        if(item.sevrice == 'Housekeeping'){
                            var desc = 'Bedroom'
                            var price = $('input[name="totalHosuekeeping"]').val();
                            // console.log(price)
                        }

                        if(item.sevrice == 'Storage'){
                            var desc = item.allDetais.description
                            var price = item.allDetais.price
                        }

                        $('.tableData').append(`
                        <tr class="service_`+ item.sevrice +`">
                            <td style="color: black;">
                                `+ item.sevrice  +`
                            </td>

                            <td style="color: black;">
                                `+ desc +`
                            </td>

                            <td style="color: black;">
                                $`+ price +`
                            </td>
                        </tr>

                        `+ ((insurancePrice) ? '<tr class=""><td style="color: black;">Insurance</td><td style="color: black;"></td><td style="color: black;">'+ insurancePrice +'</td></tr>' : '')   +`

                        `)



                        if(item.addons.length > 0){
                            var selector = '.service_'+ item.sevrice
                            // console.log(selector)

                            item.addons.forEach(function(item1,index1){

                                $(selector).after(`
                                <tr>
                                    <td style="color: black;">
                                        `+ item1.name +`
                                    </td>

                                    <td style="color: black;">

                                    </td>

                                    <td style="color: black;">
                                        $`+ item1.price +`
                                    </td>
                                </tr>
                                `)

                            })

                        }

                    })

                    if(body.insurance){
                        var insurancePrice = body.insurance.priceName
                    }else{
                        var insurancePrice = ''
                    }

                    $('.tableData').append(`

                            <tr>
                            <td>
                                Service fee
                            </td>
                            <td>

                            </td>
                            <td>
                                $`+ $('input[name="service_fee"]').val() +`
                            </td>
                            </tr>

                            <tr>
                            <td>
                                Tax
                            </td>
                            <td>

                            </td>
                            <td>
                                $`+ $('input[name="tax"]').val() +`
                            </td>
                            </tr>

                            <tr>
                            <td>
                                Subtotal
                            </td>
                            <td>

                            </td>
                            <td>
                                $`+ $('input[name="total_amount"]').val() +`
                            </td>
                            </tr>

                            `+  ((insurancePrice) ? '<tr><td>Insurance</td><td></td><td>$'+ insurancePrice +'</td></tr>' : '' )  +`

                            <tr>
                            <td>
                                Gratuity
                            </td>
                            <td>

                            </td>
                            <td>
                                $`+ $('input[name="gratiuty_amount"]').val() +`
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Discount
                            </td>
                            <td>

                            </td>
                            <td>
                                $`+ (($('input[name="discount_amount"]').val()) ? $('input[name="discount_amount"]').val() : '0') +`
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Total
                            </td>
                            <td>

                            </td>
                            <td>
                                $`+ body.totalPrice +`
                            </td>
                        </tr>

                    `)

                    $('#Invoice').modal({backdrop: 'static', keyboard: false})
                    $('#Invoice').modal('show')

                    document.getElementById("printIt").onclick = function() {
                        printElement(document.getElementById("InvoicePrint"));
                        window.print();
                    }
                }else{
                    alert(e.responseJSON.message)
                }
            }
        })



    })

    $('#edit').click(async function(){

            var cart_id = $('input[name="cart_id_edit"]').val()
            var service = $('input[name="service_edit"]').val()
            var setSession = await setAddtoCartSession(service,cart_id)
            if(setSession == '1' && service == 'Laundry'){
                location.replace('{{ route("web.home") }}')
            }

            if(setSession == '1' && service == 'Housekeeping'){
                location.replace('{{ route("web.housekeeping") }}')
            }

            if(setSession == '1' && service == 'Storage'){
                location.replace('{{ route("web.storage") }}')
            }

        })

    $('#remove').click(function(){
        var cart_id = $('input[name="cart_id_edit"]').val()
        var url = "{{ url('api/removeCart/') }}" + '/' +cart_id

        $.ajax({
            type:"get",
            url: url,
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    location.reload()
                }
            }

        })
    });


    $('body').on('click', '#cancel_upgrade', function(){

        var id = $(this).data('id')
        $('input[name="cancel_id"]').val(id)

        $('#cancel_upgrade').modal('show')

    })

    $('.cancel_subscription').click(function(){

        var id = $('input[name="cancel_id"]').val();
        var url = "{{ url('web/cancel') }}" + '/' + id

        location.replace(url);


    });

    $('#contactus').click(function(){
        var first_name = $('input[name="first_name"]').val()
        var last_name = $('input[name="last_name"]').val()
        var school_name = $('input[name="school_name"]').val()
        var country_code = $('input[name="country_code"]').val()
        var contact = $('input[name="contact"]').val()
        var email = $('#email').val()
        if(!ValidateEmail(email)){
            return false
        }
        var message = $('#message').val()

        if( (first_name == '') || (last_name== '') || (school_name == '') || (country_code == '') || (contact == '') || (email == '') || (message == '') ){
            alert('Please fill out all fields')
        }

        $.ajax({
            type:"post",
            url: "{{ url('api/contactus') }}",
            data: {first_name:first_name, last_name:last_name, school_name:school_name, country_code:country_code,  contact:contact, email:email, message:message},
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    alert('Thanks for contacting us. We`ll get you shortly');
                    location.replace('{{ route("web.home")  }}')
                }else{
                    alert(e.responseJSON.message);
                }
            }

        })

    });

    $('.cancel').click(function(){

        var subscription_id = "{{ Request::segment('3') }}";
        var reason = $('select[name="reason"]').val();
        var description = $('textarea[name="description"]').val();

        if( (subscription_id == '') || (reason == '') || (description == '') ){
            alert('Please fill all fields')
            return false
        }

        var url = "{{ url('api/cancleSubscription') }}" + '/' + subscription_id
        $.ajax({
            type:"get",
            url: url,
            data: { reason:reason, description:description },
            beforeSend: function(xhr){xhr.setRequestHeader("Authorization", "Bearer {{ \Session::get('auth_token') }}");},
            complete: function(e, xhr, settings){
                if(e.responseJSON.status == 200){
                    alert('Your subscription cancelled successfully');
                    location.replace("{{ route('web.home') }}")
                }else{
                    alert(e.responseJSON.message)
                    location.reload();
                }
            }
        })

    })


})


</script>
