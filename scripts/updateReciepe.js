$(document).ready(()=>{

    const submit            = document.querySelector("#updateReciepe");
    const updateReciepeForm = document.querySelector("#updateReciepeForm");
    const deleteBtn         = document.querySelector("#deleteReciepebtn");
    const deleteReciepeForm = document.querySelector("#deleteReciepe");
    //submit update
    submit.addEventListener('click', (e) =>{
        e.preventDefault();
        
        
        submit.attributes.value.value="Loading";

        updateReciepe();
        
    });
    //delete reciepe
    deleteBtn.addEventListener('click', (e) =>{
        e.preventDefault();
        console.log("yes");
        
        submit.attributes.value.value="Loading";

        deleteReciepe();
        
    });

    const  deleteReciepe = async () =>{
        submit.attributes.value.value+=".";
        try {
            let response = await fetch('reciepeDeleteAjax.php',{
                method: 'POST',
                body: new FormData(deleteReciepeForm),
            });
            submit.attributes.value.value+="."
            const result = await response.json();
            submit.attributes.value.value+="."
            console.log(result);
            console.log(result.reciepe_name);
            submit.attributes.value.value="Reciepe deleted!";
            submit.attributes.class.value="btn btn-success ml-1 col-2";

        }catch(error){
            console.log(error);
            submit.attributes.value.value="Sorry, Something Went Wrong";
            submit.attributes.class.value="btn btn-danger ml-1 col-2";
        }
    } 

    const updateReciepe = async () => {
        submit.attributes.value.value+=".";
        try {
            let response = await fetch('reciepeUpdateAjax.php',{
                method: 'POST',
                body: new FormData(updateReciepeForm),
            });
            submit.attributes.value.value+="."
            const result = await response.json();
            submit.attributes.value.value+="."
            console.log(result);
            console.log(result.reciepe_name);
            submit.attributes.value.value="Reciepe Updated!"
        }catch(error){
            console.log(error);
        }
    }

});