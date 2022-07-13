$(document).ready(()=>{
console.log(":)")
const facts = new Array();

facts.push("In 2007, 1.8 million tons of e-waste ended up in landfills");
facts.push("Nearly half of the food in the U.S. goes to waste—approximately 3,000 pounds per second");
facts.push(" Only about 5% of food is diverted from landfill");
facts.push("The U.S. produces approximately 34 million tons of food waste each year");
facts.push("Food scraps make up almost 12% of municipal solid waste generated in the U.S.");
facts.push("In 2015, about 137.7 million tons of MSW were landfilled. Food was the largest component at about 22%");



function getRandomInt(max) {
    return Math.floor(Math.random() * facts.length);
  }

  factsNode = document.querySelector("#facts");
  factsNode.innerHTML = facts[getRandomInt()];

const submit = document.querySelector("#deleteMainObject");
const form   = document.querySelector("#deleteMainProductForm");

submit.addEventListener('click', (e)=>{
  e.preventDefault();
  console.log("haooening");
  deleteMainObject();
});

const deleteMainObject = async () =>{
  try {
        let response = await fetch('deleteMain.php', {
          method: 'POST',
          body: new FormData(form),
        });
        console.log("json");
        console.log(response.status)
        const result = await response.json();
        
  }catch(error){
                console.log(error);
  }
}

});