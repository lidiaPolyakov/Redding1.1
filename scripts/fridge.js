$(document).ready(()=>{

  let itemArray = new Array();

     let itemNode = function (Rurl, Rname , Rdate ,RdaysLeft, Ramount,ID){
                    this.url = Rurl;
                    this.name =Rname;
                    this.date =Rdate;
                    this.daysLeft=RdaysLeft;
                    this.amount = Ramount;
                    this.ID =ID;
                   };

 const productsJson = $.getJSON('./json/productList.json', function (data) {
   $.each(data, function(i , product){
     const jsonItem = $.parseJSON(product);
   
      const id = jsonItem.id;
      const newProduct = new itemNode(jsonItem.img,jsonItem.name,jsonItem.eDate,jsonItem.daysLeft,parseInt(jsonItem.amount),id);
      
      itemArray.push(newProduct);
      
   });
   
   for (let index = 0; index < itemArray.length; index++) {
    const nextItem = itemArray[index];
   // document.getElementById("ingrediant-list").innerHTML +='<section id='+ nextItem.ID +' class="product"> <a href="mainobject.html"> <img src=' +nextItem.url+ '><p>'+nextItem.name+'</p><p>'+nextItem.date+'</p><p>'+nextItem.daysLeft+'</p><input type="number" value="'+nextItem.amount+'" > </a> </section>'
      document.querySelector("#ingrediant-list").innerHTML +='<div id='+ nextItem.ID +' class="container "><div class="product row d-flex p-2 align-items-center justify-content-center"><div class="col-3 d-flex p-2 align-items-center">  <a href="mainobject.html"> <img src=' +nextItem.url+ ' alt=""> </a> </div><div class="col-3 ">'+itemArray[index].name+'</div><div  class="col-3 p-date">'+nextItem.date+'</div><div class="col-1">'+nextItem.daysLeft+'</div><div class="col-1"><form action="updateAmount.php" method="post" id="changeAmountForminput'+ nextItem.ID +'"><input type="number" style="width:50px" name="amount" value="'+String(nextItem.amount)+'" ><input type="hidden" name="prodId" value="'+String(nextItem.ID)+'"><input class="btn btn-outline-secondary pb-1" type="submit" for ="changeAmountForminput'+ nextItem.ID +'" formmethod="post" style="height: 1.75rem;" value="🔄" id="input'+ nextItem.ID +'" name="submit"></form></div></div></div>'  
}

let product = document.getElementById("ingrediant-list").children;

for (let index = 0; index < product.length; index++) {
     const element = product[index];

      element.addEventListener("mouseover",event=>{

         let itemId =element.attributes.ID.value;
         //console.log("item id: "+itemId);
         let nextIndex;
         for(i in itemArray){
            const jsonObj = itemArray[i];
            //console.log("json obj"+jsonObj.ID);
            if(itemId === jsonObj.ID){
            nextIndex=i;             
            }
         }
        
         document.getElementById("big-item").innerHTML = `  
         '<section id="item-options" class="d-flex justify-content-around"><h1 >${itemArray[nextIndex].name}</h1>
          <section>
            <a class="btn btn-primary" href="mainobject.php?productId=${itemId}'&amount=${itemArray[nextIndex].amount}&days=${itemArray[nextIndex].daysLeft}">
            <i class="fa-solid fa-pen-to-square"></i>
           </a> 
           <br>   
         </section>
        </section>
        <section class="text-center" id="big-selected" >
            <p> ${ itemArray[nextIndex].date }</p>
         </section>
         <section class="text-center"  id="big-selected">
             <a href="mainobject.php?productId=${itemId}&amount=${itemArray[nextIndex].amount}&days=${itemArray[nextIndex].daysLeft}">
                 <img  id="big-pic" src= ${itemArray[nextIndex].url} alt="selected-item">
                </a> 
                <br> 
                <input type="number" value= "${ itemArray[nextIndex].amount}"  style="width:50px">
        </section>' `

      }); 
}




let submitUpdates = new Array();
    let element;
    submitUpdates = document.querySelectorAll('.btn-outline-secondary');
    console.log(submitUpdates);
    //const deleteForm = document.querySelector("#")
    for (let index = 0; index < submitUpdates.length; index++){
         
        element= submitUpdates[index];
        
        element.addEventListener('click', (e)=>{
            e.preventDefault();
            console.log(e);
            updateAmount(e);
            
        });
    }



const updateAmount = async(e)=>{
  try{
    const event= e.target.attributes.ID.value;
    console.log(event);
    console.log("event "+event);
    const formId = `#changeAmountForm${event}`;
    const trId   = document.querySelector(`#input${event}`);
    const formElement = document.querySelector(formId);
   console.log(formElement);
    let response = await fetch('updateAmount.php/', {
        method:'POST',
        body: new FormData(formElement),
    });
    console.log(response.body);
    console.log("now")
    const result = await response.json();
    console.log(result); 
   
} catch (error) {
        
console.log(error);
}
}
 });
 

});
