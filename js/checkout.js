$(document).ready(function(){
    $('#checkOutForm').on('submit' , (event)=>{
        event.preventDefault();
        var formData = $('#checkOutForm').serialize();
        // console.log(formData);
        $.ajax({
            type:'POST' ,
            data : formData ,
            url:'./api/Checkout.php',
            beforeSend:()=>{

            } ,
            success:(response)=>{
              console.log(response);
            }
        });
    });
});
