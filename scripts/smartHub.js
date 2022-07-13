

 $(document).ready(function() {

     var chart = new CanvasJS.Chart("chartContainer", {     
         animationEnabled: true,
         title: {
             text: "How Much Food Redding Helped You Save",
           
            
         },
         data: [{
             type: "pie",
             startAngle: 240,
             yValueFormatString: "##0.00\"%\"",
             indexLabel: "{label} {y}",
             dataPoints: [
                 {y: 78.91, label: "Consumed"},
                 {y: 21.26, label: "Wasted"}
             ]
         }]
     });
     chart.render();

     //AJAX FOR SHOPPING LIST
     // - create

     const submit = document.querySelector('#submit');
     const form   = document.querySelector('#form');
     const items  = document.querySelector('#grocery-list-table');
     const input  = document.querySelector('#new-item-input');
     const loader  = document.querySelector('#loader');

     submit.addEventListener('click', (e)=>{
         e.preventDefault();
         console.log(1);
         loader.style.display = "block";
         console.log(2);
         saveItem();
        
     });

    
    
     const saveItem = async() =>{
         try{
             console.log("try");
             let response = await fetch('addTheItem.php', {
                 method:'POST',
                 body: new FormData(form),
             });
             console.log("beofre");
             const result = await response.json();   
            
             const node = `<tr class="item${result.itemId}"><td> <div class="d-flex align-items-center"> <input type="checkbox" class="btn btn-outline-primary"><div class="ms-3"> <p class="fw-bold mb-1">${result.itemName}</p>                   </div>  </div> </td> <td><form action="" method="post" id="delete-item-form${result.itemId}"> <button type="submit" for="delete-item-form${result.itemId}"  class="btn btn-outline-dark opacity-50"><i class="fa-solid fa-xmark p-2 event${result.itemId}" id="${result.itemId}"></i>  </button> <input type="hidden" name="item_id" value="${result.itemId}"> </form> </td> </tr>`; 
             items.innerHTML += node;   
             const newListener = document.querySelector(`i.event${result.itemId}`);
             console.log(newListener);
             loader.style.display = "none";
             input.value=" ";   
             console.log("end try");
             newListener.addEventListener('click', (e)=>{
                 e.preventDefault();
                 deleteItem(e);
             });
         } catch (error) {
                // console.log(Error(error.toString()));
                 //loader.style.display = "none";
                console.log(error);
                 loader.innerHTML= '<button type="button" class="btn btn-outline-danger mt-1">Sorry, something went wrong</button>';
        }
       
     };

     //Delete 
    
     let deleteBtns = new Array();
    let element;
     deleteBtns = document.querySelectorAll('button.btn-outline-dark');
     
     
     for (let index = 0; index < deleteBtns.length; index++){
         
         element= deleteBtns[index];
        
            element.addEventListener('click', (e)=>{
             e.preventDefault();
             console.log(e);
             loader.style.display = "block";
            
             deleteItem(e);
            
         });
     }
    
   
    
     const deleteItem = async(e) =>{
         try{
             const event= e.target.attributes.ID.value;
            const formId = `#delete-item-form${event}`;
             const trId   = document.querySelector(`#item${event}`);
             const formElement = document.querySelector(formId);
             let response = await fetch('deleteShoppingItem.php', {
                 method:'POST',
                 body: new FormData(formElement),
            });
             console.log("beofre");
             const result = await response.json();
             console.log(result); 
            
             const yes = '<button type="button" class="btn btn-outline-success">Item Deleted</button> '; 
             loader.innerHTML= yes;
             //trId.style.display ="none";
             setTimeout(2000);
             loader.style.display = "none";
             items.innerHTML += result.retVal;    
             console.log("end try");
             location.reload();
         } catch (error) {
                
                console.log(error);
                 loader.innerHTML= '<button type="button" class="btn btn-outline-danger mt-1">Sorry, something went wrong</button>';
                 setTimeout(4000);
                 loader.style.display = "none";
         }
    };


});

