
function CalculateBmi(){
  var height = $('#height').val() ;
  var weight = $('#weight').val() ;
  var selectWeight = document.getElementById('weightUnit').value;
  // console.log(height + "" + weight);
  // console.log(selectWeight);
  if(weight<=0 || weight == "" ){
    swal({
      type:'error' ,
      text:'Error Invalid Weight'
    });
    return ;
  }else if(height<=0 || height == ""){
    swal({
      type:'error' ,
      text:'Error Invalid Height'
    });
    return ;
  }else{
    //calcalutae
    if(selectWeight == 'kg'){
      console.log("Kg type");
      var bmi = parseFloat(weight) / (parseFloat(height) * parseFloat(height));
        swal({
            title: "Result",
            text: "Your BMI: "+bmi,
            type: "success",
          });
    }else if(selectWeight == 'lb'){
      console.log("lb type");
      var bmi = (parseFloat(weight) / (parseFloat(height) * parseFloat(height))) * 703;
       swal({
           title: "Result",
           text: "Your BMI: "+bmi,
           type: "success",
         });
    }
  }
}

function weightChange(){
  var selectWeight = document.getElementById('weightUnit').value;
  if(selectWeight == 'kg'){
      document.getElementById('heightUnit').selectedIndex = '0';
  }else if(selectWeight == 'lb'){
    document.getElementById('heightUnit').selectedIndex = '1';
  }
}
function heightChange(){
  var selectHeight = document.getElementById('heightUnit').value;
  if(selectHeight == 'mt'){
      document.getElementById('weightUnit').selectedIndex = '0';
  }else if(selectHeight == 'in'){
    document.getElementById('weightUnit').selectedIndex = '1';
  }
}
