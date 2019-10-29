const toast = swal.mixin({
    toast: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 2000
});
function plusCart(id){
  // console.log(id);
    const productId = id ;
    //first check whether user is login otr not
    //if not login go to login page
    $.ajax({
        type:'POST'  ,
        url:'./api/AddCart.php' ,
        data:"product="+productId,
        beforeSend:function(){

        },
        success:(response)=>{
            console.log(response);
            var result = JSON.parse(response) ;
            if(result.error == true){
              const errorCode = result.errorCode ;
                if(errorCode == 101){
                const callback = result.callBackUrl ;
                     window.location.href='?v=login&callback='+callback;
                  }
              return ;
            }else if(result.error == false){
                toast({
                  type:'success',
                  text:"Cart updated"
                })
                setTimeout(()=>{
                  location.reload();
                },800);
            }
        }
    });
}
function removeCart(id){
  console.log(id);
  const formData = "id="+id;
  $.ajax({
      type:'POST' ,
      url:'./api/CartUpdate.php' ,
      data : formData ,
      beforeSend:function(){

      } ,
      success:function(response){
          var result  = JSON.parse(response) ;
          if(result.error == false){
            toast({
                type:'success' ,
                text:'cart updated'
            })  ;
            setTimeout(()=>{
                location.reload();
            } , 800) ;
          }
      }
  }) ;
}
function addCart(id){
  //  console.log(id);
    const productId = id ;
    //first check whether user is login otr not
    //if not login go to login page
    $.ajax({
        type:'POST'  ,
        url:'./api/AddCart.php' ,
        data:"product="+productId,
        beforeSend:function(){

        },
        success:(response)=>{
            console.log(response);
            var result = JSON.parse(response) ;
            if(result.error == true){
              const errorCode = result.errorCode ;
                if(errorCode == 101){
                const callback = result.callBackUrl ;
                     window.location.href='?v=login&callback='+callback;
                  }
              return ;
            }else if(result.error == false){
              cartCounter();
                toast({
                  type:'success',
                  text:result.msg
                }) ;
            }
        }
    });
}
function cartCounter(){
  $.ajax({
    type:'GET',
    url:'./api/CartCounter.php',
    beforeSend:function(){

    },
    success:(response)=>{
      console.log(response);
      const result = JSON.parse(response);
      if(result.error == false){
        const count = result.count;
        $('#cart_counter').text(count);
      }
    }
  })
}
$(document).ready(function(){
//console.log("ready");
cartCounter();
  $('#loginForm').on('submit' , (event)=>{
      event.preventDefault();
      var data = $('#loginForm').serialize();
      //console.log(data);
      $.ajax({
          type:'POST' ,
          data : data ,
          url:'./api/Login.php',
          beforeSend:()=>{

          },
          success:(response)=>{
            console.log(response);
          }
      });
  });
  $('#registerForm').on('submit' , (event)=>{
      event.preventDefault();
      var data   = $('#registerForm').serialize();
      // console.log(data);
      $.ajax({
          type:'POST' ,
          url:'./api/Register.php',
          data:data ,
          beforeSend:()=>{

          },
          success:(response)=>{
            // console.log(response);
            const result = JSON.parse(response);
            if(result.error == true){
              const msg = result.msg;
              // console.log(msg);
              swal({
                  title: "Error!",
                  text: msg,
                  type:'error'
              });
            }else if(result.error == false){
              const msg = result.msg;
              const user = result.email ;
              const hash = result.hash
              // swal({
              //   title :'success' ,
              //   text : msg ,
              //   icon:'success'
              // }) ;
              toast({
                type:'success',
                text :msg
              });
              setTimeout(function(){
                // alert("Hello");
                // localSt
                window.location.href=`?v=verifyOtp&user=${user}&email=${hash}`;
              }, 1000);
            }
          }
      });
  });
  $('#otpForm').on('submit',(event)=>{
      event.preventDefault();
      var data = $('#otpForm').serialize();
      // console.log(data);
      $.ajax({
          type:'POST' ,
          data : data,
          url:'./api/OtpVerify.php',
          beforeSend:()=>{

          },
          success:(response)=>{
            console.log(response);
            const json = JSON.parse(response);
            const msg = json.msg ;
            console.log(json);
            if(json.error == false){
              toast({
                  type:'success',
                  text:msg
              }) ;
              setTimeout(function(){
                window.location.href=`?v=home`;
              } , 1000);
            }else{
              toast({
                type:'error' ,
                text:msg
              }) ;
            }
          }
      });
  });
});
