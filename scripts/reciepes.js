$(document).ready(function () {

    let ReciepeNode = function (Rurl, Rname , Rtime , Rcontent,ID,editMode){
        this.url = Rurl;
        this.name =Rname;
        this.time =Rtime;
        this.content=Rcontent;
        this.ID =ID;
        this.edit = editMode;
    }
    const reciepeArray = new Array();

    $.getJSON('./json/reciepeList.json', function (data) {
        $.each(data, function(i , reciepe){
            const jsonItem = $.parseJSON(reciepe);
             console.log(jsonItem.permission);
             const id = jsonItem.id;
             const newProduct = new ReciepeNode(jsonItem.img,jsonItem.name,jsonItem.prep_time,jsonItem.description,jsonItem.id,jsonItem.permission);
             
             reciepeArray.push(newProduct);
             
          });
          const reciepeList = document.querySelector("#reciepe-dynamic-list");

          for (let index = 0; index < reciepeArray.length; index++) {
            const nextItem = reciepeArray[index];
            console.log(nextItem.name,nextItem.edit);
            var edit = "";
            if(nextItem.edit == 1){
                    edit = "edit";
            }
            else{
                edit ="";
            }
           reciepeList.innerHTML +=
                 `  <tr> <td id= "${nextItem.ID}" > <div class="d-flex "> <img src="${nextItem.url}"  title="user img"/><div class="ms-3">
                        <p class="fw-bold mb-1">
                            ${nextItem.name} 
                         </p> 
                        <p class="text-muted mb-0">
                            ${nextItem.time}</p> 
                        </div>
                        </div>
                    </td>
                    <td> 
                        <div class="d-grid gap-2">  
                    <button type="button" class="btn btn-outline-primary">
                         <a href="reciepe.php?reciepeId=${nextItem.ID}">
                          <i class="fa-solid fa-square-up-right"></i>
                          </a>
                         </button> 
                             <a class="mx-auto" href="updateReciepe.php?reciepeId=${nextItem.ID}"> ${edit}</a>
                          </div></td></tr>
          
           `;
                
       }
    });
  

 console.log(reciepeArray);

  //  using fetch
        fetch('json/reciepeList.json')
        .then(response => {
             if (!response.ok) {
                 throw new Error(`Error status: ${response.status}`);
             }
            return response.json();
        })
        .then(result => {
            
                for(var key in result){
                    if(result[key]){
                        let obj = JSON.parse(result[key]);
                        let newReciepe = new ReciepeNode(obj.img,obj.name,obj.prep_time,obj.description,obj.id);
                         reciepeArray.push(newReciepe);
                    }  
                }
                let reciepe = document.getElementById("reciepe-dynamic-list").children;
                
                for (let index = 0; index < reciepe.length; index++) {
          
                    reciepe[index].addEventListener("click",event=>{
                     const reciepeId = reciepe[index].children[0].attributes.ID.value;
                       let arr= reciepeArray[0];
                       console.log(arr);
                        let currentReciepe = findReciepe(reciepeId);
                        console.log(currentReciepe);
                        if(currentReciepe){
                            console.log("id: "+reciepeId);
                    
                            const nextPreview = ' <section id="reciepe-card-wrapper"><section id="reciepe-card"><img src='+ currentReciepe.url +' alt=""><section id="reciepe-details"><h1>'+ currentReciepe.name +'</h1> <p> '+ currentReciepe.time +'</p> </section><a href="reciepe.php?reciepeId='+currentReciepe.id+'" class="btn btn-outline-primary reciepe-view-button" >View  </a></section> </section> <section id="reciepe-content"><h2> Ingrediants</h2><p>'+ currentReciepe.content +' </p> </section>';
                            document.getElementById("reciepe-preview").innerHTML = nextPreview;
                        }else{
                        console.log("problem with preview");
                        }
                    });
                } 
            })
            .catch(err => console.log(err));

      


 
function findReciepe(id){
console.log(id);
    for(var i in reciepeArray){
        if(reciepeArray[i].ID == id){
            return reciepeArray[i];
        }
    }
}

});

// const applePie        = new ReciepeNode("images/ApplePie.png","Apple Pie","45 minutes",appleD,0);
// const lemonCurd       = new ReciepeNode("images/LemonCurd.png","Lemon Curd","25 minutes",lemonD,1);
// const sweetnedMilk    = new ReciepeNode("images/Panckes.png","Buckwheat Panckes","25 minutes",PancakeD,2);
// const spaghetti       = new ReciepeNode("images/pizza.png","Homemade Pizza","30 minutes",pizzaD,3);
// const quinoaSalad     = new ReciepeNode("images/QuinoaSalad.png","Quinoa Salad","50 minutes",quinoaD,4);
// const stuffedZucchini = new ReciepeNode("images/StuffedZucchini.png","Stuffed Zucchini","25 minutes",zucchiniD,5);
// const banufiPie       = new ReciepeNode("images/SteakReciepe.png","Steak ","15 minutes",steakD,6);

// let reciepeArray = [applePie, lemonCurd,sweetnedMilk,spaghetti,quinoaSalad,stuffedZucchini,banufiPie];

// document.getElementById("reciepe-preview").innerHTML = ' <section id="reciepe-card-wrapper"><section id="reciepe-card"><img src='+ reciepeArray[0].url +' alt=""><section id="reciepe-details"><h1>'+ reciepeArray[0].name +'</h1> <p> '+ reciepeArray[0].time +'</p> </section><button class="btn btn-outline-primary reciepe-view-button" >View  </button></section> </section> <section id="reciepe-content"><h2> Ingrediants</h2><p>'+ reciepeArray[0].content +' </p> </section>';

 
// });


